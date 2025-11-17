<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
    :root{
        --maincolor: #000000;
    }
</style>
<?php 
$css -> set("bootstrap/bootstrap.css");
$css -> set("fontawesome611/all.css");
$css -> set("slick/slick-theme.css");
$css -> set("slick/slick.css");
$css -> set("css/style.css");
echo $css->get();
?>