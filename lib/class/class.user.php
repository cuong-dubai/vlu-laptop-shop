<?php

class User
{
    /**
     * @var Database
     */
    protected $db;

    /**
     * Khởi tạo model User.
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
     * Lấy thông tin user theo ID.
     *
     * @param int $id
     * @return array|false
     */
    public function getUserById(int $id)
    {
        $this->db->where('id', $id);
        return $this->db->getOne('user');
    }

    /**
     * Lấy thông tin user theo username.
     *
     * @param string $username
     * @return array|false
     */
    public function getUserByUsername(string $username)
    {
        $this->db->where('username', $username);
        return $this->db->getOne('user');
    }

    /**
     * Xác thực tài khoản bằng username + password (MD5).
     * Chỉ cho phép user có status = 'hienthi' và role = 1 (admin).
     *
     * @param string $username
     * @param string $password
     * @return array|false  Trả về thông tin user nếu hợp lệ, ngược lại false.
     */
    public function authenticate(string $username, string $password)
    {
        $this->db->where('username', $username);
        $this->db->where('status', 'hienthi');
        $this->db->where('role', 1);

        $user = $this->db->getOne('user');
        if (!$user) {
            return false;
        }

        // Xác thực bằng MD5 (theo yêu cầu)
        $hashedPassword = md5($password);
        if ($user['password'] !== $hashedPassword) {
            return false;
        }

        return $user;
    }

    /**
     * Cập nhật session login cho user trong DB.
     *
     * @param int    $userId
     * @param string $loginSession
     * @param string $userToken
     * @return bool
     */
    public function updateLoginSession(int $userId, string $loginSession, string $userToken): bool
    {
        $data = [
            'login_session' => $loginSession,
            'user_token'    => $userToken,
            'lastlogin'     => (string)time(),
        ];

        $this->db->where('id', $userId);
        return $this->db->update('user', $data);
    }
}


