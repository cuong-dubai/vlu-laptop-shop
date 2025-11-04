<?php
if (!defined('LIB'))
    die("Error");

/* Timezone */
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* Cấu hình coder */
define('VNDTS_CODE', '127724');
define('VNDTS_STAFF', '');

/* Cấu hình chung */
$config = array(
    'author' => array(
        'name' => 'VLU LAPTOP SHOP',
        'email' => '',
        'timefinish' => '05/11/2025'
    ),
    'database' => array(
        'server-name' => $_SERVER["SERVER_NAME"],
        'url' => '/vlu_laptop_shop/',
        'type' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'vlu_laptop_shop',
        'port' => 3306,
        'prefix' => 'table_',
        'charset' => 'utf8mb4'
    )
);

