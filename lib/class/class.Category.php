<?php

class Category
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * Khởi tạo model danh mục sản phẩm.
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
     * Lấy tất cả danh mục (bảng categories) đang hiển thị cho type = 'san-pham'.
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        $this->db->where('status', '%hienthi%', 'LIKE');
        $this->db->where('type', 'san-pham');
        $this->db->orderBy('numb', 'ASC');
        $this->db->orderBy('date_created', 'DESC');

        return $this->db->get('categories');
    }

    /**
     * Lấy thông tin 1 danh mục theo ID.
     *
     * @param int $id
     * @return array|false
     */
    public function getCategoryById(int $id)
    {
        $this->db->where('id', $id);
        $this->db->where('status', '%hienthi%', 'LIKE');

        return $this->db->getOne('categories');
    }

    /**
     * Lấy thông tin 1 danh mục theo slug.
     *
     * @param string $slug
     * @return array|false
     */
    public function getCategoryBySlug(string $slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('status', '%hienthi%', 'LIKE');

        return $this->db->getOne('categories');
    }

    /**
     * Tạo mới danh mục.
     *
     * @param array $data
     * @return int|bool  Trả về ID vừa tạo hoặc false nếu thất bại.
     */
    public function createCategory(array $data)
    {
        return $this->db->insert('categories', $data);
    }

    /**
     * Cập nhật danh mục theo ID.
     *
     * @param int   $id
     * @param array $data
     * @return bool
     */
    public function updateCategory(int $id, array $data): bool
    {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }

    /**
     * Xoá danh mục theo ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id): bool
    {
        $this->db->where('id', $id);
        return (bool)$this->db->delete('categories');
    }
}


