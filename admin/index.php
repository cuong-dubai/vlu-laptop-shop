<?php

session_start();

define('LIB', '../lib/');

define('SOURCES', './resources/');

define('TEMPLATE', './templates/');

define('LAYOUT', 'layout/');




require_once LIB . "config.php";

require_once LIB . 'autoload.php';

new AutoLoad();

$d = new Database($config['database']);

$func = new Functions($d);
require_once LIB . "requick.php";
?>

<!DOCTYPE html>

<html lang="vi">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="extensions/images/logo2.png" rel="shortcut icon" type="image/x-icon" />

    <title>VLU LAPTOP SHOP - Admin Dashboard</title>

    <?php include TEMPLATE . LAYOUT . "css.php";

?>

</head>



<body class="<?php /*sidebar-fixed*/ ?>">

    <div class="container-scroller">

        <!-- Wrapper -->

        <?php if (isset($_SESSION[$loginAdmin]['active']) && ($_SESSION[$loginAdmin]['active'] == true)) { ?>

            <?php include TEMPLATE . LAYOUT . "header.php"; ?>

            <div class="container-fluid page-body-wrapper">

                <?php include TEMPLATE . LAYOUT . "menu.php"; ?>

                <div class="main-panel">

                    <div class="content-wrapper">

                        <?php include TEMPLATE . $template . "_tpl.php"; ?>

                    </div>

                    <?php include TEMPLATE . LAYOUT . "footer.php"; ?>

                </div>

            </div>

        <?php } else {

            include TEMPLATE . "user/login_tpl.php";

        } ?>

    </div>

    <!-- Js all -->

    <?php include TEMPLATE . LAYOUT . "js.php"; ?>

</body>



</html>