<!DOCTYPE html>

<html lang="<?= $config['website']['lang-doc'] ?>">
    <head>
        <?php 
            include TEMPLATE . LAYOUT . "head.php";
            include TEMPLATE . LAYOUT . "css.php"; 
        ?>
    </head>
    <body>
        <div>
            <?php 
                include TEMPLATE . LAYOUT . "header.php";
            ?>
            <div class="w-clear">

                <?php include TEMPLATE . $template . "_tpl.php"; ?>

            </div>
            <?php 
                include TEMPLATE . LAYOUT . "footer.php";
            ?>
        </div>
    </body>
</html>