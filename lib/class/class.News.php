<?php

/**
 * Model xử lý dữ liệu tin tức/bài viết.
 */
class News
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * Tên bảng lưu tin tức.
     *
     * @var string
     */
    protected $tableName;

    /**
     * Khởi tạo News model.
     *
     * @param Database|null $db
     * @param string         $tableName
     */
    public function __construct(?Database $db = null, string $tableName = 'news')
    {
        if ($db instanceof Database) {
            $this->db = $db;
        } else {
            $this->db = Database::getInstance();
        }
        $this->tableName = $tableName;
    }

    /**
     * Lấy danh sách bài viết (cho trang Admin và trang chủ).
     *
     * @param int|null $limit Số lượng bài viết cần lấy (null = lấy tất cả)
     * @return array
     */
    public function readAll(?int $limit = null): array
    {
        $this->db->orderBy('date_created', 'DESC');
        $this->db->orderBy('id', 'DESC');

        if ($limit !== null && $limit > 0) {
            return $this->db->get($this->tableName, $limit);
        }

        return $this->db->get($this->tableName);
    }

    /**
     * Lấy chi tiết bài viết.
     *
     * @param int $id
     * @return array|false
     */
    public function readOneById(int $id)
    {
        if ($id <= 0) {
            return false;
        }

        $this->db->where('id', $id);
        return $this->db->getOne($this->tableName);
    }

    /**
     * Thêm bài viết mới.
     *
     * @param array $data
     * @return int|string|bool  ID vừa tạo hoặc false nếu thất bại
     */
    public function createNews(array $data)
    {
        if (empty($data)) {
            return false;
        }

        $now = time();
        $data['date_created'] = $data['date_created'] ?? $now;
        $data['date_updated'] = $data['date_updated'] ?? $now;

        return $this->db->insert($this->tableName, $data);
    }

    /**
     * Cập nhật bài viết.
     *
     * @param int   $id
     * @param array $data
     * @return bool
     */
    public function updateNews(int $id, array $data): bool
    {
        if ($id <= 0 || empty($data)) {
            return false;
        }

        $data['date_updated'] = $data['date_updated'] ?? time();

        $this->db->where('id', $id);
        return (bool)$this->db->update($this->tableName, $data);
    }

    /**
     * Xóa bài viết.
     *
     * @param int $id
     * @return bool
     */
    public function deleteNews(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        $this->db->where('id', $id);
        return (bool)$this->db->delete($this->tableName);
    }
}

