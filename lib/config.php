<?php
if (!defined('LIB'))
    die("Error");

/* Timezone */
date_default_timezone_set('Asia/Ho_Chi_Minh');


/* Cấu hình chung */
$config = array(
    'author' => array(
        'name' => 'VLU LAPTOP SHOP',
        'email' => '',
        'timefinish' => '05/11/2025'
    ),
    'website' => array(
        'lang-doc' => 'vi',
        'lang' => array(
            'vi'=> 'Tiếng việt',
        ),
        'secret' => 'vlu',
        'salt' => 'promax',
    ),
    'database' => array(
        'server-name' => $_SERVER["SERVER_NAME"],
        'url' => '/vlu-laptop-shop/',
        'type' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'vlu_laptop_shop',
        'port' => 3306,
        'prefix' => '',
        'charset' => 'utf8mb4'
    ),
    'login' => array(
        'admin' => 'LoginAdmin',
        'member' => 'LoginMember',
        'attempt' => 5,
        'delay' => 15
    ),
);
$http = 'http://';
$port = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443 ? ':' . $_SERVER['SERVER_PORT'] : '';
$serverName = $config['database']['server-name'] . $port;
$configUrl = $serverName . $config['database']['url'];
$configBase = $http . $configUrl;


define('TOKEN', md5($config['database']['url']));
$loginAdmin = $config['login']['admin'];


define('ROOT', str_replace(basename(__DIR__), '', __DIR__));
define('ASSET', $http . $configUrl);
define('ADMIN', 'admin');

// var_dump(ROOT);
/* Cấu hình upload */
require_once LIB . "constant.php";