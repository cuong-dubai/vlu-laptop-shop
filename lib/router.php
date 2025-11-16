<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('TEMPLATE', './templates/');

/* Router */

$router->setBasePath($config['database']['url']);

$router->map('GET', ADMIN . '/', function () {

    global $func, $config;

    $func->redirect($config['database']['url'] . ADMIN . "/index.php");

    exit;

});

$router->map('GET', ADMIN, function () {

    global $func, $config;

    $func->redirect($config['database']['url'] . ADMIN . "/index.php");

    exit;

});

$router->map('GET|POST', '', 'index', 'home');

$router->map('GET|POST', 'index.php', 'index', 'index');

$router->map('GET|POST', 'sitemap.xml', 'sitemap', 'sitemap');

$router->map('GET|POST', '[a:com]', 'allpage', 'show');

$router->map('GET|POST', '[a:com]/[a:lang]/', 'allpagelang', 'lang');

$router->map('GET|POST', '[a:com]/[a:action]', 'account', 'account');

$router->map('GET|POST', '[a:com]/[a:lock]', 'lock', 'lock');

$match = $router->match();

/* Router check */

// Khởi tạo các biến mặc định
$com = '';
$source = '';
$template = '';



if (is_array($match)) {

    if (is_callable($match['target'])) {

        call_user_func_array($match['target'], $match['params']);

    } else {

        $com = (!empty($match['params']['com'])) ? htmlspecialchars($match['params']['com']) : htmlspecialchars($match['target']);

        $getPage = !empty($_GET['p']) ? htmlspecialchars($_GET['p']) : 1;

    }

} else {

    header('HTTP/1.0 404 Not Found', true, 404);

    include("404.php");

    exit;

}


/* Tối ưu link */
$requick = array(
    /* Sản phẩm */
    array("tbl" => "categories", "field" => "idl", "source" => "product", "com" => "san-pham", "type" => "san-pham"),
    array("tbl" => "brand", "field" => "idb", "source" => "product", "com" => "thuong-hieu", "type" => "san-pham"),
    array("tbl" => "product", "field" => "id", "source" => "product", "com" => "san-pham", "type" => "san-pham", "menu" => true),

);



/* Find data */
if (!empty($com) && !in_array($com, ['tim-kiem', 'account'])) {
    foreach ($requick as $k => $v) {
        $urlTbl = (!empty($v['tbl'])) ? $v['tbl'] : '';
        $urlTblTag = (!empty($v['tbltag'])) ? $v['tbltag'] : '';
        $urlType = (!empty($v['type'])) ? $v['type'] : '';
        $urlField = (!empty($v['field'])) ? $v['field'] : '';
        $urlCom = (!empty($v['com'])) ? $v['com'] : '';

        if (!empty($urlTbl) && !in_array($urlTbl, ['static', 'photo'])) {
            $row = $d->rawQueryOne("select id from #_$urlTbl where slug = ? and type = ? and find_in_set('hienthi',status) limit 0,1", array($com, $urlType));

            if (!empty($row['id'])) {
                $_GET[$urlField] = $row['id'];
                $com = $urlCom;
                break;
            }
        }
    }
}



switch ($com) {
    case "san-pham":
        $source = "product";
        $type = $com;
        $titleMain = "Sản phẩm";
        $template = "product/product";
        break;

    case '':
    case 'trang-chu':
    case 'index':

        $source = "index";

        $template = "index/index";


        break;



    default:

        header('HTTP/1.0 404 Not Found', true, 404);

        include("404.php");

        exit();

}
/* Require datas for all page */
require_once SOURCES . "allpage.php";
/* Include sources */
if (!empty($source)) {
    include SOURCES . $source . ".php";
}
if (empty($template)) {

    header('HTTP/1.0 404 Not Found', true, 404);

    include("404.php");

    exit();

}
