<?php

session_start();
define('LIB', '../../lib/');

require_once LIB . "config.php";
require_once LIB . 'autoload.php';
new AutoLoad();
$d = new Database($config['database']);
$func = new Functions($d);

$username = (!empty($_POST['username'])) ? $_POST['username'] : '';
$password = (!empty($_POST['password'])) ? $_POST['password'] : '';
$error = "";
$success = "";
$login_failed = false;

if ($error == '') {
    /* Kiểm tra thông tin đăng nhập */
    if ($username == '' && $password == '') {
        $error = "Chưa nhập tên đăng nhập và mật khẩu";
    } else if ($username == '') {
        $error = "Chưa nhập tên đăng nhập";
    } else if ($password == '') {
        $error = "Chưa nhập mật khẩu";
    } else {
        /* Kiểm tra đăng nhập */
        $row = $d->rawQueryOne("select * from user where username = ? and find_in_set('hienthi',status) limit 0,1", array($username));

        if ($row['password'] == $func->encryptPassword($config['website']['secret'], $password, $config['website']['salt'])) {
            $autoLog = true;
        } else {
            $autoLog = false;
        }

        if (!empty($row['id'])) {
            if ($autoLog == true) {
                $timenow = time();
                $id_user = $row['id']; 
                $token = md5(time());
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                $sessionhash = md5(sha1($row['password'] . $row['username']));
                $d->rawQuery("update #_user set login_session = ?, lastlogin = ?, user_token = ? where id = ?", array($sessionhash, $timenow, $token, $id_user));
                $d->rawQuery("update #_user set login_session = ?, lastlogin = ? where id = ?", array($sessionhash, $timenow, $id_user));
                /* Tạo Session login */
                $_SESSION[$loginAdmin]['active'] = true;
                $_SESSION[$loginAdmin]['id'] = $row['id'];
                $_SESSION[$loginAdmin]['username'] = $row['username'];
                $_SESSION[$loginAdmin]['fullname'] = $row['fullname'];
                $_SESSION[$loginAdmin]['phone'] = $row['phone'];
                $_SESSION[$loginAdmin]['email'] = $row['email'];
                $_SESSION[$loginAdmin]['role'] = $row['role'];
                $_SESSION[$loginAdmin]['secret_key'] = $row['secret_key'];
                $_SESSION[$loginAdmin]['token'] = $sessionhash;
                $_SESSION[$loginAdmin]['password'] = $row['password'];
                $_SESSION[$loginAdmin]['login_session'] = $sessionhash;
                $_SESSION[$loginAdmin]['login_token'] = $token;

                /* Tạo Session Token Website */
                $_SESSION[TOKEN] = true;

                /* Cập nhật quyền của user đăng nhập */
                $secret_key = $_SESSION[$loginAdmin]['token'];
                $d->rawQuery("update user set secret_key = ? where id = ?", array($secret_key, $row['id']));

                $success = "Đăng nhập thành công";
            } else {
                $login_failed = true;
                $error = "Mật khẩu không chính xác";
            }
        } else {
            $login_failed = true;
            $error = "Tên đăng nhập không tồn tại";
        }

        /* Xử lý khi đăng nhập thất bại */
        if ($login_failed) {
            $remain_attempt = $config['login']['attempt'];
            $error = 'Sai thông tin. Còn ' . $remain_attempt . ' lần thử';
        }
    }
}

$data = array('success' => $success, 'error' => $error);
echo json_encode($data);
