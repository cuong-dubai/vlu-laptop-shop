<?php 
// Option 1: Load CSS trực tiếp từ file style.css
// echo '<link href="' . ASSET . 'assets/css/style.css?v=' . time() . '" rel="stylesheet">';

// Option 2: Include trực tiếp CSS từ style.php (đảm bảo CSS luôn được load)
echo '<style>';
include TEMPLATE . LAYOUT . 'style.php';
echo '</style>';
?>