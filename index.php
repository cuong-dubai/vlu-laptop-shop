<?php
session_start();
define('LIB', './lib/');
define('LAYOUT', 'layout/');

require_once LIB . "config.php";
require_once LIB . 'autoload.php';
new AutoLoad();
$d = new Database($config['database']);


$router = new AltoRouter();


$func = new Functions($d);
$css = new CssMinify(true, $func);




require_once LIB . "router.php";
include TEMPLATE . "index.php";


?>