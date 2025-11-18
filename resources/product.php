<?php

if (!defined('SOURCES')) {
    die("Error");
}

/* Khởi tạo các Model frontend */
$productModel  = new Product($d);
$categoryModel = new Category($d);

@$id  = htmlspecialchars($_GET['id']);
@$idl = htmlspecialchars($_GET['idl']);
@$idb = htmlspecialchars($_GET['idb']); // hiện chưa dùng brand filter

$curPage = $getPage;
$perPage = 12;

if ($id != '') {
    /* Lấy sản phẩm detail bằng Model */
    $rowDetail = $productModel->getProductById((int)$id);

    if (empty($rowDetail) || $rowDetail['type'] != $type) {
        $func->transfer("Sản phẩm không tồn tại", "index.php", false);
    }

    /* Lấy cấp 1 (danh mục) bằng Model */
    $productList = $categoryModel->getCategoryById((int)$rowDetail['id_list']);

    /* Lấy sản phẩm cùng loại (cùng id_list, khác id hiện tại) bằng Model + phân trang */
    $total   = 0;
    $product = $productModel->getPagedProductsForFrontend($type, (int)$id, (int)$rowDetail['id_list'], $curPage, $perPage, $total);

    $url    = $func->getCurrentPageURL();
    $paging = $func->pagination($total, $perPage, $curPage, $url);

} else if ($idl != '') {
    /* Lấy cấp 1 detail bằng Model */
    $productList = $categoryModel->getCategoryById((int)$idl);

    if (empty($productList)) {
        $func->transfer("Danh mục không tồn tại", "index.php", false);
    }

    /* SEO */
    $titleCate = $productList['name'];

    /* Lấy sản phẩm thuộc danh mục này với phân trang bằng Model */
    $total   = 0;
    $product = $productModel->getPagedProductsForFrontend($type, null, (int)$idl, $curPage, $perPage, $total);

    $url    = $func->getCurrentPageURL();
    $paging = $func->pagination($total, $perPage, $curPage, $url);

} else {
    /* Lấy tất cả sản phẩm type hiện tại với phân trang bằng Model */
    $total   = 0;
    $product = $productModel->getPagedProductsForFrontend($type, null, null, $curPage, $perPage, $total);

    $url    = $func->getCurrentPageURL();
    $paging = $func->pagination($total, $perPage, $curPage, $url);
}
if (!defined('SOURCES'))
    die("Error");
@$id = htmlspecialchars($_GET['id']);
@$idl = htmlspecialchars($_GET['idl']);
@$idb = htmlspecialchars($_GET['idb']);
$order_by = 'numb,id desc';
if ($id != '') {
    /* Lấy sản phẩm detail */
    $rowDetail = $d->rawQueryOne("select * from #_product where id = ? and type = ? and find_in_set('hienthi',status) limit 0,1", array($id, $type));

    /* Lấy cấp 1 */
    $productList = $d->rawQueryOne("select * from #_categories where id = ? and type = ? and find_in_set('hienthi',status) limit 0,1", array($rowDetail['id_list'], $type));

    /* Lấy thương hiệu */
    $productBrand = $d->rawQueryOne("select name,slug,id from #_brand where id = ? and type = ? and find_in_set('hienthi',status)", array($rowDetail['id_brand'], $type));

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