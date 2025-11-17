<?php

class OrderModel
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * Khởi tạo OrderModel.
     *
     * Có thể truyền sẵn instance Database ($d) từ ngoài vào,
     * hoặc nếu không truyền thì dùng singleton Database::getInstance().
     *
     * @param Database|null $db
     */
    public function __construct(Database $db = null)
    {
        if ($db instanceof Database) {
            $this->db = $db;
        } else {
            $this->db = Database::getInstance();
        }
    }

    /**
     * Tạo mới đơn hàng (bảng `order`).
     *
     * Yêu cầu:
     *  - $data là mảng [cột => giá trị] khớp với cấu trúc bảng `order`
     *    (customer_name, phone, address, total_price, status, date_created, date_updated).
     *  - Hàm sẽ tự bổ sung date_created nếu chưa có.
     *
     * @param array $data
     * @return int|bool  Trả về ID đơn hàng vừa tạo, hoặc false nếu thất bại.
     */
    public function createOrder(array $data)
    {
        if (empty($data['date_created'])) {
            $data['date_created'] = time();
        }

        // Dùng rawQuery vì 'order' là reserved keyword trong MySQL
        $columns = array_keys($data);
        $values = array_values($data);
        
        $columnsStr = '`' . implode('`, `', $columns) . '`';
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        
        $sql = "INSERT INTO `order` ({$columnsStr}) VALUES ({$placeholders})";
        
        $this->db->rawQuery($sql, $values);
        
        return $this->db->pdo()->lastInsertId();
    }

    /**
     * Tạo mới chi tiết đơn hàng (bảng order_detail).
     *
     * Yêu cầu:
     *  - $data là mảng [cột => giá trị] khớp với cấu trúc bảng order_detail
     *    (thường gồm: id_order, id_product, price, quantity).
     *
     * @param array $data
     * @return int|bool  Trả về ID chi tiết đơn hàng vừa tạo, hoặc false nếu thất bại.
     */
    public function createOrderDetail(array $data)
    {
        return $this->db->insert('order_detail', $data);
    }
}


