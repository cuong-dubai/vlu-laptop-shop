<?php

class Product
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * Khởi tạo model sản phẩm.
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
     * Lấy danh sách tất cả sản phẩm đang hiển thị.
     * - Chỉ lấy sản phẩm có status chứa 'hienthi'
     * - Chỉ lấy sản phẩm type = 'san-pham'
     * - Sắp xếp theo trường 'numb' tăng dần, sau đó theo 'date_created' mới nhất
     *
     * @return array
     */
    public function getAllProducts(): array
    {
        $this->db->where('status', '%hienthi%', 'LIKE');
        $this->db->where('type', 'san-pham');
        $this->db->orderBy('numb', 'ASC');
        $this->db->orderBy('date_created', 'DESC');

        return $this->db->get('product');
    }

    /**
     * Lấy chi tiết một sản phẩm theo ID.
     *
     * @param int $id
     * @return array|false
     */
    public function getProductById(int $id)
    {
        $this->db->where('id', $id);
        $this->db->where('status', '%hienthi%', 'LIKE');

        return $this->db->getOne('product');
    }

    /**
     * Lấy chi tiết một sản phẩm theo slug.
     *
     * @param string $slug
     * @return array|false
     */
    public function getProductBySlug(string $slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('status', '%hienthi%', 'LIKE');

        return $this->db->getOne('product');
    }

    /**
     * Lấy danh sách sản phẩm theo bộ lọc (danh mục, thương hiệu) và phân trang.
     *
     * @param int|null $categoryId  id_list trong bảng product (categories)
     * @param int|null $brandId     id_brand trong bảng product (brand)
     * @param int      $page        Trang hiện tại (bắt đầu từ 1)
     * @param int      $limit       Số sản phẩm mỗi trang
     * @return array
     */
    public function getProductsByFilter(?int $categoryId = null, ?int $brandId = null, int $page = 1, int $limit = 12): array
    {
        if ($categoryId !== null) {
            $this->db->where('id_list', $categoryId);
        }

        if ($brandId !== null) {
            $this->db->where('id_brand', $brandId);
        }

        $this->db->where('status', '%hienthi%', 'LIKE');
        $this->db->where('type', 'san-pham');

        $this->db->setPageLimit($limit);
        $products = $this->db->paginate('product', $page);

        return $products;
    }

    /**
     * Tạo mới sản phẩm.
     *
     * @param array $data
     * @return int|bool  Trả về ID vừa tạo hoặc false nếu thất bại.
     */
    public function createProduct(array $data)
    {
        return $this->db->insert('product', $data);
    }

    /**
     * Cập nhật sản phẩm theo ID.
     *
     * @param int   $id
     * @param array $data
     * @return bool
     */
    public function updateProduct(int $id, array $data): bool
    {
        $this->db->where('id', $id);
        return $this->db->update('product', $data);
    }

    /**
     * Xoá sản phẩm theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteProduct(int $id): bool
    {
        $this->db->where('id', $id);
        return (bool)$this->db->delete('product');
    }

    /**
     * Lấy danh sách sản phẩm cho frontend với phân trang,
     * kết hợp các điều kiện theo type, id_list, loại trừ một id cụ thể.
     *
     * Hàm này được thiết kế để thay thế các truy vấn thô trong resources/product.php.
     *
     * @param string   $type       Giá trị cột type trong bảng product (ví dụ: 'san-pham')
     * @param int|null $excludeId  Nếu khác null sẽ loại trừ sản phẩm có id này
     * @param int|null $listId     Lọc theo id_list nếu có
     * @param int      $page       Trang hiện tại (bắt đầu từ 1)
     * @param int      $limit      Số sản phẩm mỗi trang
     * @param int      $total      (tham chiếu) tổng số bản ghi tìm được
     * @return array               Danh sách sản phẩm theo trang
     */
    public function getPagedProductsForFrontend(string $type, ?int $excludeId, ?int $listId, int $page, int $limit, int &$total = 0): array
    {
        if ($excludeId !== null) {
            $this->db->where('id', $excludeId, '!=');
        }

        if ($listId !== null) {
            $this->db->where('id_list', $listId);
        }

        $this->db->where('type', $type);
        $this->db->where('status', '%hienthi%', 'LIKE');

        // Sắp xếp giống truy vấn cũ: order by numb, id desc
        $this->db->orderBy('numb', 'ASC');
        $this->db->orderBy('id', 'DESC');

        $this->db->setPageLimit($limit);
        $this->db->withTotalCount();

        $products = $this->db->paginate('product', $page);
        $total    = (int)$this->db->totalCount;

        return $products;
    }
}

