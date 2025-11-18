<?php
require_once LIB . 'type/config-type-product.php';


/* Quản lý tài khoản */
$config['user']['active'] = true;

// Bật module user admin để trang đăng nhập/đổi mật khẩu hoạt động bình thường
$config['user']['admin'] = true;
$config['user']['check_admin'] = array("hienthi" => "Kích hoạt");
$config['user']['member'] = false;

$config['user']['admin'] = false;
$config['user']['check_admin'] = array("hienthi" => "Kích hoạt");
$config['user']['member'] = true;

$config['user']['birthday'] = false;
$config['user']['check_member'] = array("hienthi" => "Kích hoạt");

?>