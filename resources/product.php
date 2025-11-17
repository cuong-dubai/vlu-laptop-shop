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