<?php

class Brand
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * Khởi tạo model thương hiệu sản phẩm.
     *
     * @param Database|null $db
     */
    public function __construct(?Database $db = null)
    {
        if ($db instanceof Database) {
            $this->db = $db;
        } else {
            $this->db = Database::getInstance();
        }
    }

    /**
     * Lấy tất cả thương hiệu (bảng brand) đang hiển thị cho type = 'san-pham'.
     *
     * @return array
     */
    public function getAllBrands(): array
    {
        $this->db->where('status', '%hienthi%', 'LIKE');
        $this->db->where('type', 'san-pham');
        $this->db->orderBy('numb', 'ASC');
        $this->db->orderBy('date_created', 'DESC');

        return $this->db->get('brand');
    }

    /**
     * Lấy thông tin 1 thương hiệu theo ID.
     *
     * @param int $id
     * @return array|false
     */
    public function getBrandById(int $id)
    {
        $this->db->where('id', $id);
        $this->db->where('status', '%hienthi%', 'LIKE');

        return $this->db->getOne('brand');
    }

    /**
     * Lấy thông tin 1 thương hiệu theo slug.
     *
     * @param string $slug
     * @return array|false
     */
    public function getBrandBySlug(string $slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('status', '%hienthi%', 'LIKE');

        return $this->db->getOne('brand');
    }

    /**
     * Tạo mới thương hiệu.
     *
     * @param array $data
     * @return int|bool  Trả về ID vừa tạo hoặc false nếu thất bại.
     */
    public function createBrand(array $data)
    {
        return $this->db->insert('brand', $data);
    }

    /**
     * Cập nhật thương hiệu theo ID.
     *
     * @param int   $id
     * @param array $data
     * @return bool
     */
    public function updateBrand(int $id, array $data): bool
    {
        $this->db->where('id', $id);
        return $this->db->update('brand', $data);
    }

    /**
     * Xoá thương hiệu theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBrand(int $id): bool
    {
        $this->db->where('id', $id);
        return (bool)$this->db->delete('brand');
    }
}


