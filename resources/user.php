<?php
if (!defined('SOURCES')) die("Error");

$action = htmlspecialchars($match['params']['action']);
$userModel = new User($d);

switch ($action) {
    case 'dang-nhap':
        $titleMain = "Đăng nhập";
        $template = "account/login";
        // Nếu đã đăng nhập rồi thì chuyển về trang chủ
        if (!empty($_SESSION[$loginMember]['active'])) {
            $func->redirect($configBase);
        }
        if (!empty($_POST['login-user'])) {
            loginMember();
        }
        break;

    case 'dang-ky':
        $titleMain = "Đăng ký";
        $template = "account/registration";
        // Nếu đã đăng nhập rồi thì chuyển về trang chủ
        if (!empty($_SESSION[$loginMember]['active'])) {
            $func->redirect($configBase);
        }
        if (!empty($_POST['registration-user'])) {
            signupMember();
        }
        break;

    case 'dang-xuat':
        logoutMember();
        break;

    default:
        header('HTTP/1.0 404 Not Found', true, 404);
        include("404.php");
        exit();
}

/**
 * Xử lý đăng nhập user
 */
function loginMember()
{
    global $d, $func, $flash, $configBase, $loginMember, $userModel, $config;

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $flash->set('Vui lòng nhập đầy đủ tài khoản và mật khẩu', 'danger', 'frontend');
        $func->redirect($configBase . 'account/dang-nhap');
    }

    // Authenticate user
    $user = $userModel->authenticate($username, $password);

    if (!$user) {
        $flash->set('Tài khoản hoặc mật khẩu không chính xác', 'danger', 'frontend');
        $func->redirect($configBase . 'account/dang-nhap');
    }

    // Tạo session và token
    $loginSession = $func->stringRandom(32);
    $userToken = $func->stringRandom(32);

    $userModel->updateLoginSession((int)$user['id'], $loginSession, $userToken);

    // Lưu session
    $_SESSION[$loginMember] = [
        'active' => true,
        'id' => $user['id'],
        'username' => $user['username'],
        'fullname' => $user['fullname'],
        'email' => $user['email'],
        'phone' => $user['phone'],
        'login_session' => $loginSession,
        'user_token' => $userToken,
    ];

    $flash->set('Đăng nhập thành công!', 'success', 'frontend');
    $func->redirect($configBase);
}

/**
 * Xử lý đăng ký user mới
 */
function signupMember()
{
    global $d, $func, $flash, $configBase, $userModel, $config;

    $fullname = trim($_POST['fullname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $repassword = trim($_POST['repassword'] ?? '');
    $gender = (int)($_POST['gender'] ?? 0);
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    // Validate
    if (empty($fullname) || empty($username) || empty($password) || empty($email) || empty($phone)) {
        $flash->set('Vui lòng nhập đầy đủ thông tin', 'danger', 'frontend');
        $flash->set('fullname', $fullname);
        $flash->set('username', $username);
        $flash->set('email', $email);
        $flash->set('phone', $phone);
        $flash->set('gender', $gender);
        $func->redirect($configBase . 'account/dang-ky');
    }

    if ($password !== $repassword) {
        $flash->set('Mật khẩu nhập lại không khớp', 'danger', 'frontend');
        $flash->set('fullname', $fullname);
        $flash->set('username', $username);
        $flash->set('email', $email);
        $flash->set('phone', $phone);
        $flash->set('gender', $gender);
        $func->redirect($configBase . 'account/dang-ky');
    }

    // Kiểm tra username đã tồn tại chưa
    $existingUser = $userModel->getUserByUsername($username);
    if ($existingUser) {
        $flash->set('Tài khoản đã tồn tại, vui lòng chọn tên khác', 'danger', 'frontend');
        $flash->set('fullname', $fullname);
        $flash->set('email', $email);
        $flash->set('phone', $phone);
        $flash->set('gender', $gender);
        $func->redirect($configBase . 'account/dang-ky');
    }

    // Mã hóa mật khẩu
    $hashedPassword = $func->encryptPassword($config['website']['secret'], $password, $config['website']['salt']);

    // Tạo user mới
    $userId = $d->rawQuery("INSERT INTO `user` (username, password, fullname, email, phone, gender, status, role) VALUES (?, ?, ?, ?, ?, ?, 'hienthi', 0)", [
        $username,
        $hashedPassword,
        $fullname,
        $email,
        $phone,
        $gender
    ]);

    if ($userId) {
        $flash->set('Đăng ký thành công! Vui lòng đăng nhập.', 'success', 'frontend');
        $func->redirect($configBase . 'account/dang-nhap');
    } else {
        $flash->set('Có lỗi xảy ra, vui lòng thử lại', 'danger', 'frontend');
        $func->redirect($configBase . 'account/dang-ky');
    }
}

/**
 * Xử lý đăng xuất
 */
function logoutMember()
{
    global $func, $configBase, $loginMember;

    unset($_SESSION[$loginMember]);
    $func->redirect($configBase);
}