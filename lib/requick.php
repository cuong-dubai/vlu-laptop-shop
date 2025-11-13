<?php
/* Request data */
$com = (!empty($_REQUEST['com'])) ? htmlspecialchars($_REQUEST['com']) : '';
$act = (!empty($_REQUEST['act'])) ? htmlspecialchars($_REQUEST['act']) : '';
$type = (!empty($_REQUEST['type'])) ? htmlspecialchars($_REQUEST['type']) : '';
$kind = (!empty($_REQUEST['kind'])) ? htmlspecialchars($_REQUEST['kind']) : '';
$val = (!empty($_REQUEST['val'])) ? htmlspecialchars($_REQUEST['val']) : '';
$variant = (!empty($_GET['variant'])) ? htmlspecialchars($_GET['variant']) : '';
$id_parent = (!empty($_REQUEST['id_parent'])) ? htmlspecialchars($_REQUEST['id_parent']) : '';
$id = (!empty($_REQUEST['id'])) ? htmlspecialchars($_REQUEST['id']) : '';
$curPage = (!empty($_GET['p'])) ? htmlspecialchars($_GET['p']) : 1;
if (!empty($kind)) $dfgallery = ($kind == 'man_list') ? 'gallery_list' : 'gallery';
else $dfgallery = '';

/* Kiểm tra 2 máy đăng nhập cùng 1 tài khoản */
if (!empty($_SESSION[$loginAdmin]['active'])) {
    $id_user = (int)$_SESSION[$loginAdmin]['id'];
    $timenow = time();

    $row = $d->rawQueryOne("select username, password, lastlogin, user_token from #_user WHERE id = ? limit 0,1", array($id_user));

    $sessionhash = md5(sha1($row['password'] . $row['username']));

    if ($_SESSION[$loginAdmin]['login_session'] != $sessionhash || ($timenow - $row['lastlogin']) > 3600 || !isset($_SESSION[TOKEN])) {
        if (!empty($_SESSION[TOKEN])) unset($_SESSION[TOKEN]);
        unset($_SESSION[$loginAdmin]);
        $func->redirect("index.php?com=user&act=login");
    }

    if ($_SESSION[$loginAdmin]['login_token'] !== $row['user_token']) $alertlogin = 'Có người đang đăng nhập tài khoản của bạn.';
    else $alertlogin = '';

    $token = md5(time());
    $_SESSION[$loginAdmin]['login_token'] = $token;

    /* Cập nhật lại thời gian hoạt động và token */
    $d->rawQuery("update #_user set lastlogin = ?, user_token = ? where id = ?", array($timenow, $token, $id_user));
}



/* Kiểm tra đăng nhập */
if ($func->checkLoginAdmin() == false && $act != "login") {
    $func->redirect("index.php?com=user&act=login");
}


/* Include sources */
if (file_exists(SOURCES . $com . '.php')) include SOURCES . $com . ".php";
else $template = "index";
