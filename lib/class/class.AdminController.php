<?php

class AdminController
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * @var Functions
     */
    protected $func;

    /**
     * @var User
     */
    protected $userModel;

    /**
     * Tên key session dành cho admin.
     *
     * @var string
     */
    protected $sessionKey = 'loginAdmin';

    /**
     * Khởi tạo AdminController.
     *
     * @param Database  $db
     * @param Functions $func
     */
    public function __construct(Database $db, Functions $func)
    {
        $this->db        = $db;
        $this->func      = $func;
        $this->userModel = new User($db);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Đồng bộ với biến global $loginAdmin nếu hệ thống admin cũ có sử dụng
        global $loginAdmin;
        $loginAdmin = $this->sessionKey;
    }

    /**
     * Xử lý đăng nhập admin.
     *
     * @param string $username
     * @param string $password
     * @return bool  true nếu đăng nhập thành công, ngược lại false.
     */
    public function login(string $username, string $password): bool
    {
        $user = $this->userModel->authenticate($username, $password);
        if (!$user) {
            return false;
        }

        // Tạo token mới cho phiên đăng nhập
        $loginSession = $this->generateRandomToken();
        $userToken    = $this->generateRandomToken();

        // Cập nhật vào database
        $this->userModel->updateLoginSession((int)$user['id'], $loginSession, $userToken);

        // Lưu thông tin vào session
        $_SESSION[$this->sessionKey] = [
            'id'            => (int)$user['id'],
            'username'      => $user['username'],
            'role'          => (int)$user['role'],
            'login_session' => $loginSession,
            'user_token'    => $userToken,
            'active'        => true,
        ];

        return true;
    }

    /**
     * Đăng xuất admin.
     */
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION[$this->sessionKey])) {
            unset($_SESSION[$this->sessionKey]);
        }
    }

    /**
     * Kiểm tra xem admin đã đăng nhập hợp lệ hay chưa.
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            empty($_SESSION[$this->sessionKey]['id']) ||
            empty($_SESSION[$this->sessionKey]['login_session'])
        ) {
            return false;
        }

        $sessionData = $_SESSION[$this->sessionKey];
        $userId      = (int)$sessionData['id'];

        $user = $this->userModel->getUserById($userId);
        if (!$user) {
            return false;
        }

        // So khớp login_session và trạng thái user
        if (
            $user['login_session'] !== $sessionData['login_session'] ||
            $user['status'] !== 'hienthi' ||
            (int)$user['role'] !== 1
        ) {
            return false;
        }

        return true;
    }

    /**
     * Hàm tiện ích tạo token ngẫu nhiên.
     *
     * @param int $length
     * @return string
     */
    protected function generateRandomToken(int $length = 32): string
    {
        if ($this->func instanceof Functions && method_exists($this->func, 'stringRandom')) {
            return $this->func->stringRandom($length);
        }

        return bin2hex(random_bytes((int)($length / 2)));
    }
}


