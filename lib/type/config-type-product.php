<?php 
/* Sản phẩm */
$nametype = "san-pham";
$config['product'][$nametype]['title_main'] = "Sản Phẩm";
$config['product'][$nametype]['dropdown'] = true;
$config['product'][$nametype]['list'] = true;
$config['product'][$nametype]['brand'] = true;
$config['product'][$nametype]['slug'] = true;
$config['product'][$nametype]['images'] = true;
$config['product'][$nametype]['desc'] = true;
$config['product'][$nametype]['content'] = true;
$config['product'][$nametype]['code'] = false;
$config['product'][$nametype]['regular_price'] = true;
$config['product'][$nametype]['sale_price'] = true;
$config['product'][$nametype]['discount'] = true;
$config['product'][$nametype]['show_images'] = true;
$config['product'][$nametype]['check'] = array("hienthi" => "Hiển thị");
$config['product'][$nametype]['width'] = 300;
$config['product'][$nametype]['height'] = 300;
$config['product'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif';

/* Sản phẩm (List) */
$config['product'][$nametype]['title_main_list'] = "danh mục sản phẩm";
$config['product'][$nametype]['images_list'] = false;
$config['product'][$nametype]['show_images_list'] = false;
$config['product'][$nametype]['slug_list'] = true;
$config['product'][$nametype]['check_list'] = array("hienthi" => "Hiển thị");
$config['product'][$nametype]['check_all_list'] = false;
$config['product'][$nametype]['desc_list'] = false;
$config['product'][$nametype]['seo_list'] = true;
$config['product'][$nametype]['width_list'] = 300;
$config['product'][$nametype]['height_list'] = 200;
$config['product'][$nametype]['thumb_list'] = '100x100x1';
$config['product'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif';



$config['product'][$nametype]['title_main_brand'] = "Hãng sản phẩm";
$config['product'][$nametype]['images_brand'] = false;
$config['product'][$nametype]['show_images_brand'] = false;
$config['product'][$nametype]['slug_brand'] = true;
$config['product'][$nametype]['check_brand'] = array("hienthi" => "Hiển thị");
$config['product'][$nametype]['width_brand'] = 150;
$config['product'][$nametype]['height_brand'] = 150;
$config['product'][$nametype]['thumb_brand'] = '100x100x1';
$config['product'][$nametype]['img_type_brand'] = '.jpg|.gif|.png|.jpeg|.gif';