<?php

/**
 * Controller quản trị bài viết/tin tức trong Admin.
 */
class NewsAdminController
{
    /**
     * @var News
     */
    protected $newsModel;

    /**
     * @var Database
     */
    protected $db;

    /**
     * @var Functions
     */
    protected $func;

    /**
     * Khởi tạo NewsAdminController.
     *
     * @param Database  $db
     * @param Functions $func
     */
    public function __construct(Database $db, Functions $func)
    {
        $this->db         = $db;
        $this->func       = $func;
        $this->newsModel  = new News($db);
    }

    /**
     * Hiển thị danh sách bài viết trong Admin.
     *
     * @param int|null $limit Số lượng bài viết cần lấy (null = lấy tất cả)
     * @return array Danh sách bài viết
     */
    public function manageNews(?int $limit = null): array
    {
        return $this->newsModel->readAll($limit);
    }

    /**
     * Xử lý POST request cho cả Thêm và Sửa (Create và Update).
     *
     * @param array $data Dữ liệu từ POST
     * @param int   $id   ID bài viết (nếu có = update, nếu không = create)
     * @return array Kết quả: ['success' => bool, 'message' => string, 'id' => int|null]
     */
    public function saveNews(array $data, int $id = 0): array
    {
        $result = [
            'success' => false,
            'message' => '',
            'id'      => null,
        ];

        if (empty($data)) {
            $result['message'] = 'Không nhận được dữ liệu';
            return $result;
        }

        // Xử lý dữ liệu
        $processedData = $this->processNewsData($data);

        if ($id > 0) {
            // Update
            $success = $this->newsModel->updateNews($id, $processedData);
            if ($success) {
                $result['success'] = true;
                $result['message'] = 'Cập nhật bài viết thành công';
                $result['id']      = $id;
            } else {
                $result['message'] = 'Cập nhật bài viết thất bại';
            }
        } else {
            // Create
            $newId = $this->newsModel->createNews($processedData);
            if ($newId) {
                $result['success'] = true;
                $result['message'] = 'Thêm bài viết thành công';
                $result['id']      = $newId;
            } else {
                $result['message'] = 'Thêm bài viết thất bại';
            }
        }

        return $result;
    }

    /**
     * Xử lý xóa bài viết.
     *
     * @param int $id ID bài viết cần xóa
     * @return array Kết quả: ['success' => bool, 'message' => string]
     */
    public function deleteNews(int $id): array
    {
        $result = [
            'success' => false,
            'message' => '',
        ];

        if ($id <= 0) {
            $result['message'] = 'ID không hợp lệ';
            return $result;
        }

        // Kiểm tra bài viết có tồn tại không
        $news = $this->newsModel->readOneById($id);
        if (!$news) {
            $result['message'] = 'Bài viết không tồn tại';
            return $result;
        }

        // Xóa bài viết
        $success = $this->newsModel->deleteNews($id);
        if ($success) {
            $result['success'] = true;
            $result['message'] = 'Xóa bài viết thành công';
        } else {
            $result['message'] = 'Xóa bài viết thất bại';
        }

        return $result;
    }

    /**
     * Xử lý và làm sạch dữ liệu bài viết trước khi lưu.
     *
     * @param array $data
     * @return array
     */
    protected function processNewsData(array $data): array
    {
        $processed = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Xử lý mảng (ví dụ: status)
                $processed[$key] = $value;
            } else {
                // Xử lý content và desc - cho phép HTML/iframe
                if (strpos($key, 'content') !== false || strpos($key, 'desc') !== false) {
                    $processed[$key] = htmlspecialchars($this->func->sanitize($value, 'iframe'));
                } else {
                    $processed[$key] = htmlspecialchars($this->func->sanitize($value));
                }
            }
        }

        // Xử lý slug nếu có
        if (isset($data['slug']) && !empty($data['slug'])) {
            $processed['slug'] = $this->func->changeTitle(htmlspecialchars($data['slug']));
        } elseif (isset($data['name']) && !empty($data['name'])) {
            $processed['slug'] = $this->func->changeTitle($data['name']);
        }

        // Xử lý status nếu có
        if (isset($data['status'])) {
            if (is_array($data['status'])) {
                $status = '';
                foreach ($data['status'] as $attr_value) {
                    if ($attr_value != "") {
                        $status .= $attr_value . ',';
                    }
                }
                $processed['status'] = (!empty($status)) ? rtrim($status, ",") : "";
            } else {
                $processed['status'] = $data['status'];
            }
        }

        // Xử lý type
        if (isset($data['type'])) {
            $processed['type'] = htmlspecialchars($data['type']);
        } else {
            $processed['type'] = 'tin-tuc'; // Mặc định
        }

        return $processed;
    }
}

