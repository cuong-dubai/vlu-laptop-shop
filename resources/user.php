<?php
<<<<<<< HEAD
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

=======
if (!defined('SOURCES'))
    die("Error");

$action = htmlspecialchars($match['params']['action']);

switch ($action) {
    case 'dang-nhap':
        $titleMain = "dang-nhap";
        $template = "account/login";
        if (!empty($_SESSION[$loginMember]['active']))
            $func->transfer("Trang không tồn tại", $configBase, false);
        if (!empty($_POST['login-user']))
            loginMember();
        break;

    case 'dang-ky':
        $titleMain = "dang-ky";
        $template = "account/registration";
        if (!empty($_SESSION[$loginMember]['active']))
            $func->transfer("Trang không tồn tại", $configBase, false);
        if (!empty($_POST['registration-user']))
            signupMember();
        break;
 case 'thong-tin':
        $titleMain = "Cập nhật thông tin";
        $template = "account/info";
        if (empty($_SESSION[$loginMember]['active'])) $func->transfer("Trang không tồn tại", $configBase, false);
        infoMember();
        break;
    case 'dang-xuat':
        if (empty($_SESSION[$loginMember]['active']))
            $func->transfer("Trang không tồn tại", $configBase, false);
        logoutMember();
>>>>>>> main
    default:
        header('HTTP/1.0 404 Not Found', true, 404);
        include("404.php");
        exit();
}

<<<<<<< HEAD
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
=======

function infoMember()
{
    global $d, $func, $flash, $rowDetail, $configBase, $loginMember;

    $iduser = $_SESSION[$loginMember]['id'];

    if ($iduser) {
        $rowDetail = $d->rawQueryOne("select fullname, username, gender, birthday, email, phone, address from #_customers where id = ? limit 0,1", array($iduser));

        if (!empty($_POST['info-user'])) {
            $message = '';
            $response = array();
            $old_password = (!empty($_POST['old-password'])) ? $_POST['old-password'] : '';
            $old_passwordMD5 = md5($old_password);
            $new_password = (!empty($_POST['new-password'])) ? $_POST['new-password'] : '';
            $new_passwordMD5 = md5($new_password);
            $new_password_confirm = (!empty($_POST['new-password-confirm'])) ? $_POST['new-password-confirm'] : '';
            $fullname = (!empty($_POST['fullname'])) ? htmlspecialchars($_POST['fullname']) : '';
            $email = (!empty($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
            $phone = (!empty($_POST['phone'])) ? htmlspecialchars($_POST['phone']) : 0;
            $address = (!empty($_POST['address'])) ? htmlspecialchars($_POST['address']) : '';
            $gender = (!empty($_POST['gender'])) ? htmlspecialchars($_POST['gender']) : 0;
            $birthday = (!empty($_POST['birthday'])) ? htmlspecialchars($_POST['birthday']) : '';

            /* Valid data */
            if (empty($fullname)) {
                $response['messages'][] = 'Họ tên không được trống';
            }

            if (!empty($old_password)) {
                $isWrongPass = false;
                $row = $d->rawQueryOne("select id from #_customers where id = ? and password = ? limit 0,1", array($iduser, $old_passwordMD5));

                if (empty($row['id'])) {
                    $isWrongPass = true;
                    $response['messages'][] = 'Mật khẩu cũ không chính xác';
                } else if (empty($new_password)) {
                    $isWrongPass = true;
                    $response['messages'][] = 'Mật khẩu mới không được trống';
                } else if (!empty($new_password) && empty($new_password_confirm)) {
                    $isWrongPass = true;
                    $response['messages'][] = 'Xác nhận mật khẩu mới không được trống';
                } else if ($new_password != $new_password_confirm) {
                    $isWrongPass = true;
                    $response['messages'][] = 'Mật khẩu mới và xác nhận mật khẩu mới không chính xác';
                }
            }

            if (empty($gender)) {
                $response['messages'][] = 'Chưa chọn giới tính';
            }

            if (empty($birthday)) {
                $response['messages'][] = 'Ngày sinh không được trống';
            }

            if (!empty($birthday) && !$func->isDate($birthday)) {
                $response['messages'][] = 'Ngày sinh không hợp lệ';
            }

            if (empty($email)) {
                $response['messages'][] = 'Email không được trống';
            }

            if (!empty($email)) {
                if (!$func->isEmail($email)) {
                    $response['messages'][] = 'Email không hợp lệ';
                }

                if ($func->checkAccount($email, 'email', 'member', $iduser)) {
                    $response['messages'][] = 'Email đã tồn tại';
                }
            }

            if (!empty($phone) && !$func->isPhone($phone)) {
                $response['messages'][] = 'Số điện thoại không hợp lệ';
            }

            if (empty($address)) {
                $response['messages'][] = 'Địa chỉ không được trống';
            }

            if (!empty($response)) {
                /* Flash data */
                $flash->set('fullname', $fullname);
                $flash->set('gender', $gender);
                $flash->set('birthday', $birthday);
                $flash->set('email', $email);
                $flash->set('phone', $phone);
                $flash->set('address', $address);

                /* Errors */
                $response['status'] = 'danger';
                $message = base64_encode(json_encode($response));
                $flash->set('message', $message);
                $func->redirect($configBase . "account/thong-tin");
            }

            if (!empty($old_password) && empty($isWrongPass)) {
                $data['password'] = $new_passwordMD5;
            }

            $data['fullname'] = $fullname;
            $data['email'] = $email;
            $data['phone'] = $phone;
            $data['address'] = $address;
            $data['gender'] = $gender;
            $data['birthday'] = strtotime(str_replace("/", "-", $birthday));

            $d->where('id', $iduser);
            if ($d->update('customers', $data)) {
                if ($old_password) {
                    unset($_SESSION[$loginMember]);
                    setcookie('login_member_id', "", -1, '/');
                    setcookie('login_member_session', "", -1, '/');
                    $func->transfer("Cập nhật thông tin thành công", $configBase . "account/dang-nhap");
                } else {
                    $func->transfer("Cập nhật thông tin thành công", $configBase . "account/thong-tin");
                }
            } else {
                $func->transfer("Cập nhật thông tin thất bại", $configBase . "account/thong-tin", false);
            }
        }
    } else {
        $func->transfer("Trang không tồn tại", $configBase, false);
    }
}

function loginMember()
{
    global $d, $func, $flash, $loginMember, $configBase;

    /* Data */
    $username = (!empty($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
    $password = (!empty($_POST['password'])) ? $_POST['password'] : '';
    $passwordMD5 = md5($password);
    $remember = (!empty($_POST['remember-user'])) ? htmlspecialchars($_POST['remember-user']) : false;

    /* Valid data */
    if (empty($username)) {
        $response['messages'][] = 'Tên đăng nhập không được trống';
    }

    if (empty($password)) {
        $response['messages'][] = 'Mật khẩu không được trống';
    }

    if (!empty($response)) {
        $response['status'] = 'danger';
        $message = base64_encode(json_encode($response));
        $flash->set("message", $message);
        $func->redirect($configBase . "account/dang-nhap");
    }

    $row = $d->rawQueryOne("select id, password, username, phone, address, email, fullname from #_customers where username = ? and find_in_set('hienthi',status) limit 0,1", array($username));

    if (!empty($row)) {
        if ($row['password'] == $passwordMD5) {
            /* Tạo login session */
            $id_user = $row['id'];
            $lastlogin = time();
            $login_session = md5($row['password'] . $lastlogin);
            $d->rawQuery("update #_customers set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));

            /* Lưu session login */
            $_SESSION[$loginMember]['active'] = true;
            $_SESSION[$loginMember]['id'] = $row['id'];
            $_SESSION[$loginMember]['username'] = $row['username'];
            $_SESSION[$loginMember]['phone'] = $row['phone'];
            $_SESSION[$loginMember]['address'] = $row['address'];
            $_SESSION[$loginMember]['email'] = $row['email'];
            $_SESSION[$loginMember]['fullname'] = $row['fullname'];
            $_SESSION[$loginMember]['login_session'] = $login_session;

            /* Nhớ mật khẩu */
            setcookie('login_member_id', "", -1, '/');
            setcookie('login_member_session', "", -1, '/');
            if ($remember) {
                $time_expiry = time() + 3600 * 24;
                setcookie('login_member_id', $row['id'], $time_expiry, '/');
                setcookie('login_member_session', $login_session, $time_expiry, '/');
            }

            $func->transfer("Đăng nhập thành công", $configBase);
        } else {
            $response['messages'][] = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
        }
    } else {
        $response['messages'][] = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
    }

    /* Response error */
    if (!empty($response)) {
        $response['status'] = 'danger';
        $message = base64_encode(json_encode($response));
        $flash->set("message", $message);
        $func->redirect($configBase . "account/dang-nhap");
    }
}

function signupMember()
{
    global $d, $func, $flash, $configBase;

    /* Data */
    $message = '';
    $response = array();
    $username = (!empty($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
    $password = (!empty($_POST['password'])) ? $_POST['password'] : '';
    $repassword = (!empty($_POST['repassword'])) ? $_POST['repassword'] : '';
    $fullname = (!empty($_POST['fullname'])) ? htmlspecialchars($_POST['fullname']) : '';
    $email = (!empty($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
    $phone = (!empty($_POST['phone'])) ? htmlspecialchars($_POST['phone']) : 0;
    $gender = (!empty($_POST['gender'])) ? htmlspecialchars($_POST['gender']) : 0;

    /* Valid data */
    if (empty($fullname)) {
        $response['messages'][] = 'Họ tên không được trống';
    }

    if (empty($username)) {
        $response['messages'][] = 'Tài khoản không được trống';
    }

    if (!empty($username)) {
        if (!$func->isAlphaNum($username)) {
            $response['messages'][] = 'Tài khoản chỉ được nhập chữ thường và số (chữ thường không dấu, ghi liền nhau, không khoảng trắng)';
        }

        if ($func->checkAccount($username, 'username', 'customers')) {
            $response['messages'][] = 'Tài khoản đã tồn tại';
        }
    }

    if (empty($password)) {
        $response['messages'][] = 'Mật khẩu không được trống';
    }

    if (!empty($password) && empty($repassword)) {
        $response['messages'][] = 'Xác nhận mật khẩu không được trống';
    }

    if (!empty($password) && !empty($repassword) && !$func->isMatch($password, $repassword)) {
        $response['messages'][] = 'Mật khẩu không trùng khớp';
    }

    if (empty($gender)) {
        $response['messages'][] = 'Chưa chọn giới tính';
    }

    if (empty($email)) {
        $response['messages'][] = 'Email không được trống';
    }

    if (!empty($email)) {
        if (!$func->isEmail($email)) {
            $response['messages'][] = 'Email không hợp lệ';
        }

        if ($func->checkAccount($email, 'email', 'customers')) {
            $response['messages'][] = 'Email đã tồn tại';
        }
    }

    if (!empty($phone) && !$func->isPhone($phone)) {
        $response['messages'][] = 'Số điện thoại không hợp lệ';
    }

    if (!empty($response)) {
        /* Flash data */
        $flash->set('fullname', $fullname);
        $flash->set('username', $username);
        $flash->set('gender', $gender);
        $flash->set('email', $email);
        $flash->set('phone', $phone);

        /* Errors */
        $response['status'] = 'danger';
        $message = base64_encode(json_encode($response));
        $flash->set('message', $message);
        $func->redirect($configBase . "account/dang-ky");
    }

    /* Save data */
    $data['fullname'] = $fullname;
    $data['username'] = $username;
    $data['password'] = md5($password);
    $data['email'] = $email;
    $data['phone'] = $phone;
    $data['gender'] = $gender;
    $data['status'] = 'hienthi';

    if ($d->insert('customers', $data)) {
        $func->transfer("Đăng ký thành viên thành công.", $configBase . "account/dang-nhap");
    } else {
        $func->transfer("Đăng ký thành viên thất bại. Vui lòng thử lại sau.", $configBase, false);
    }
}
function logoutMember()
{
    global $d, $func, $loginMember, $configBase;

    unset($_SESSION[$loginMember]);
    setcookie('login_member_id', "", -1, '/');
    setcookie('login_member_session', "", -1, '/');

>>>>>>> main
    $func->redirect($configBase);
}