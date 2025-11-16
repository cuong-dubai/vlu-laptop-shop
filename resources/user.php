<?php
if (!defined('SOURCES')) die("Error");

$action = htmlspecialchars($match['params']['action']);

switch ($action) {
    case 'dang-nhap':
        $titleMain = "dang-nhap";
        $template = "account/login";
        if (!empty($_SESSION[$loginMember]['active'])) $func->transfer("Trang không tồn tại", $configBase, false);
        if (!empty($_POST['login-user'])) loginMember();
        break;

    case 'dang-ky':
        $titleMain = "dang-ky";
        $template = "account/registration";
        if (!empty($_SESSION[$loginMember]['active'])) $func->transfer("Trang không tồn tại", $configBase, false);
        if (!empty($_POST['registration-user'])) signupMember();
        break;

    default:
        header('HTTP/1.0 404 Not Found', true, 404);
        include("404.php");
        exit();
}

function loginMember()
{
   
}

function signupMember()
{
    
}