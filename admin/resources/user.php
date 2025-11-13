<?php
if (!defined('SOURCES')) die("Error");

switch ($act) {
        /* Admins */
    case "login":
        if (!empty($_SESSION[$loginAdmin]['active'])) $func->transfer("Trang không tồn tại", "index.php", false);
        else $template = "user/login";
        break;
    case "logout":
        logout();
        break;

    default:
        $template = "404";
}


/* Logout admin */
function logout()
{
    global $d, $func, $loginAdmin;

    /* Hủy bỏ quyền */
    $data_update_permission['secret_key'] = '';
    $d->where('id', $_SESSION[$loginAdmin]['id']);
    $d->update('user', $data_update_permission);

    /* Hủy bỏ login */
    if (!empty($_SESSION[TOKEN])) unset($_SESSION[TOKEN]);
    unset($_SESSION[$loginAdmin]);
    $func->redirect("index.php?com=user&act=login");
}
