<?php

/**
 * Model xử lý dữ liệu đơn hàng và chi tiết đơn hàng.
 */
class OrderModel
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * Tên bảng lưu thông tin đơn hàng.
     *
     * @var string
     */
    protected $orderTable;

    /**
     * Tên bảng lưu chi tiết đơn hàng.
     *
     * @var string
     */
    protected $orderDetailTable;

    /**
     * Khởi tạo OrderModel.
     *
     * @param Database|null $db
     * @param string        $orderTable
     * @param string        $orderDetailTable
     */
    public function __construct(?Database $db = null, string $orderTable = 'orders', string $orderDetailTable = 'order_detail')
    {
        $this->db               = $db instanceof Database ? $db : Database::getInstance();
        $this->orderTable       = $orderTable;
        $this->orderDetailTable = $orderDetailTable;
    }

    /**
     * Tạo mới đơn hàng chính.
     *
     * @param array $data
     * @return int|string|bool  ID vừa tạo hoặc false nếu thất bại
     */
    public function createOrder(array $data)
    {
        if (empty($data)) {
            return false;
        }

        $now = time();
        $data['date_created'] = $data['date_created'] ?? $now;
        $data['date_updated'] = $data['date_updated'] ?? $now;

        return $this->db->insert($this->orderTable, $data);
    }

    /**
     * Tạo mới một dòng chi tiết đơn hàng.
     *
     * @param array $data Phải chứa khoá order_id, product_id, quantity...
     * @return int|string|bool
     */
    public function createOrderDetail(array $data)
    {
        if (empty($data) || empty($data['order_id'])) {
            return false;
        }

        $data['date_created'] = $data['date_created'] ?? time();

        return $this->db->insert($this->orderDetailTable, $data);
    }

    /**
     * Đọc danh sách đơn hàng (hoặc 1 đơn hàng) với các điều kiện tuỳ chọn.
     *
     * $conditions hỗ trợ hai dạng:
     *  - ['status' => 'pending', 'user_id' => 1]
     *  - [
     *        ['field' => 'status', 'value' => 'pending', 'operator' => '='],
     *        ['field' => 'total_amount', 'value' => 10000000, 'operator' => '>=']
     *    ]
     *
     * $options hỗ trợ:
     *  - single: bool            -> lấy 1 dòng (mặc định false)
     *  - with_details: bool      -> đính kèm chi tiết đơn hàng
     *  - columns: string|array   -> chọn cột cần lấy
     *  - order_by: ['field' => 'DESC', ...]
     *  - limit: int|array        -> tham số thứ 2 của Database::get
     *  - paginate: ['page' => 1, 'limit' => 20]
     *  - total_count: bool       -> bật SQL_CALC_FOUND_ROWS
     *
     * @param array $conditions
     * @param array $options
     * @return array
     */
    public function read(array $conditions = [], array $options = []): array
    {
        $single       = (bool)($options['single'] ?? false);
        $withDetails  = (bool)($options['with_details'] ?? false);
        $columns      = $options['columns'] ?? '*';
        $orderBy      = $options['order_by'] ?? [];
        $limit        = $options['limit'] ?? null;
        $paginateOpts = $options['paginate'] ?? [];

        $this->applyConditions($conditions);

        if (is_array($orderBy)) {
            foreach ($orderBy as $field => $direction) {
                $this->db->orderBy($field, $direction);
            }
        }

        if (!empty($options['total_count'])) {
            $this->db->withTotalCount();
        }

        if (!$single && is_array($paginateOpts) && !empty($paginateOpts)) {
            $page  = max(1, (int)($paginateOpts['page'] ?? 1));
            $perPage = max(1, (int)($paginateOpts['limit'] ?? 20));
            $this->db->setPageLimit($perPage);
            $orders = $this->db->paginate($this->orderTable, $page, $columns);
        } else {
            if ($single) {
                $orders = $this->db->getOne($this->orderTable, $columns) ?: [];
            } else {
                $orders = $this->db->get($this->orderTable, $limit, $columns);
            }
        }

        if (empty($orders)) {
            return $single ? [] : [];
        }

        if ($withDetails) {
            $orders = $this->attachOrderDetails($orders, $single);
        }

        return $orders;
    }

    /**
     * Cập nhật thông tin đơn hàng.
     *
     * @param int   $orderId
     * @param array $data
     * @return bool
     */
    public function update(int $orderId, array $data): bool
    {
        if ($orderId <= 0 || empty($data)) {
            return false;
        }

        $data['date_updated'] = $data['date_updated'] ?? time();

        $this->db->where('id', $orderId);
        return (bool)$this->db->update($this->orderTable, $data);
    }

    /**
     * Lấy danh sách chi tiết theo ID đơn hàng.
     *
     * @param int $orderId
     * @return array
     */
    public function getOrderDetails(int $orderId): array
    {
        if ($orderId <= 0) {
            return [];
        }

        $this->db->where('order_id', $orderId);
        return $this->db->get($this->orderDetailTable);
    }

    /**
     * Gắn dữ liệu chi tiết vào kết quả đơn hàng.
     *
     * @param array $orders
     * @param bool  $single
     * @return array
     */
    protected function attachOrderDetails(array $orders, bool $single): array
    {
        if (empty($orders)) {
            return $orders;
        }

        if ($single) {
            $orderId = (int)($orders['id'] ?? 0);
            $orders['details'] = $this->getOrderDetails($orderId);
            return $orders;
        }

        $orderIds = array_filter(array_unique(array_map(function ($row) {
            return $row['id'] ?? null;
        }, $orders)));

        if (empty($orderIds)) {
            return $orders;
        }

        $this->db->where('order_id', $orderIds, 'IN');
        $details = $this->db->get($this->orderDetailTable);

        if (empty($details)) {
            foreach ($orders as &$order) {
                $order['details'] = [];
            }
            return $orders;
        }

        $grouped = [];
        foreach ($details as $detail) {
            $grouped[$detail['order_id']][] = $detail;
        }

        foreach ($orders as &$order) {
            $orderId = $order['id'] ?? null;
            $order['details'] = $orderId !== null ? ($grouped[$orderId] ?? []) : [];
        }

        return $orders;
    }

    /**
     * Áp dụng điều kiện where cho query hiện tại.
     *
     * @param array $conditions
     * @return void
     */
    protected function applyConditions(array $conditions): void
    {
        if (empty($conditions)) {
            return;
        }

        foreach ($conditions as $key => $condition) {
            if (is_array($condition) && isset($condition['field'])) {
                $field    = $condition['field'];
                $value    = $condition['value'] ?? null;
                $operator = $condition['operator'] ?? '=';
                $cond     = $condition['cond'] ?? 'AND';

                $this->db->where($field, $value, $operator, $cond);
                continue;
            }

            if (is_array($condition) && isset($condition['value']) && !isset($condition['field']) && is_string($key)) {
                $value    = $condition['value'];
                $operator = $condition['operator'] ?? '=';
                $cond     = $condition['cond'] ?? 'AND';

                $this->db->where($key, $value, $operator, $cond);
                continue;
            }

            if (is_array($condition) && is_string($key)) {
                $value    = $condition[0] ?? null;
                $operator = $condition[1] ?? '=';
                $cond     = $condition[2] ?? 'AND';

                $this->db->where($key, $value, $operator, $cond);
                continue;
            }

            if (is_string($key)) {
                $this->db->where($key, $condition);
            }
        }
    }
}

