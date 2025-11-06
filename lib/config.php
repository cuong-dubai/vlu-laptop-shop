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
    )
);
$http = 'http://';
$configUrl = $config['database']['server-name'] . $config['database']['url'];
$configBase = $http . $configUrl;


define('ROOT', str_replace(basename(__DIR__), '', __DIR__));
define('ASSET', $http . $configUrl);
define('ADMIN', 'dashboard');