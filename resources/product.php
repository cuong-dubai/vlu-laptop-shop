<?php
if (!defined('SOURCES'))
    die("Error");
@$id = htmlspecialchars($_GET['id']);
@$idl = htmlspecialchars($_GET['idl']);
@$idb = htmlspecialchars($_GET['idb']);
$order_by = 'numb,id desc';
if ($id != '') {
    /* Lấy sản phẩm detail */
    $rowDetail = $d->rawQueryOne("select type, *, desc$lang, content$lang, code, view, id_brand, id_list, id_cat, id_item, id_sub, photo, options, discount, sale_price, regular_price from #_product where id = ? and type = ? and find_in_set('hienthi',status) limit 0,1", array($id, $type));

    /* Lấy cấp 1 */
    $productList = $d->rawQueryOne("select * from #_categories where id = ? and type = ? and find_in_set('hienthi',status) limit 0,1", array($rowDetail['id_list'], $type));

    /* Lấy thương hiệu */
    //$productBrand = $d->rawQueryOne("select name$lang, slugvi, slugen, id from #_product_brand where id = ? and type = ? and find_in_set('hienthi',status)", array($rowDetail['id_brand'], $type));
   
    /* Lấy sản phẩm cùng loại */
    $where = "";
    $where = "id <> ? and id_list = ? and type = ? and find_in_set('hienthi',status)";
    $params = array($id, $rowDetail['id_list'], $type);
    $curPage = $getPage;
    $perPage = 12;
    $startpoint = ($curPage * $perPage) - $perPage;
    $limit = " limit " . $startpoint . "," . $perPage;
    $sql = "select * from #_product where $where order by $order_by $limit";
    $product = $d->rawQuery($sql, $params);
    $sqlNum = "select count(*) as 'num' from #_product where $where order by numb,id desc";
    $count = $d->rawQueryOne($sqlNum, $params);
    $total = (!empty($count)) ? $count['num'] : 0;
    $url = $func->getCurrentPageURL();
    $paging = $func->pagination($total, $perPage, $curPage, $url);
    
} else if ($idl != '') {
    /* Lấy cấp 1 detail */
    $productList = $d->rawQueryOne("select * from #_categories where id = ? and type = ? limit 0,1", array($idl, $type));
    /* SEO */
    $titleCate = $productList['name'];
   
    /* Lấy sản phẩm */
    $where = "";
    $where = "id_list = ? and type = ? and find_in_set('hienthi',status)";
    $params = array($idl, $type);
    $curPage = $getPage;
    $perPage = 12;
    $startpoint = ($curPage * $perPage) - $perPage;
    $limit = " limit " . $startpoint . "," . $perPage;
    $sql = "select * from #_product where $where order by $order_by $limit";
    $product = $d->rawQuery($sql, $params);
    $sqlNum = "select count(*) as 'num' from #_product where $where order by numb,id desc";
    $count = $d->rawQueryOne($sqlNum, $params);
    $total = (!empty($count)) ? $count['num'] : 0;
    $url = $func->getCurrentPageURL();
    $paging = $func->pagination($total, $perPage, $curPage, $url);
    
} else {
  
    /* Lấy tất cả sản phẩm */
    $where = "";
    $where = "type = ? and find_in_set('hienthi',status)";
    $params = array($type);
    $curPage = $getPage;
    $perPage = 12;
    $startpoint = ($curPage * $perPage) - $perPage;
    $limit = " limit " . $startpoint . "," . $perPage;
    $sql = "select * from #_product where $where order by $order_by $limit";
    $product = $d->rawQuery($sql, $params);
    $sqlNum = "select count(*) as 'num' from #_product where $where order by numb,id desc";
    $count = $d->rawQueryOne($sqlNum, $params);
    $total = (!empty($count)) ? $count['num'] : 0;
    $url = $func->getCurrentPageURL();
    $paging = $func->pagination($total, $perPage, $curPage, $url);
    
}