<?php

/**
 * AJAX: Thêm sản phẩm vào giỏ hàng.
 *
 * Nhận dữ liệu POST:
 * - product_id (int)
 * - qty        (int, optional, mặc định = 1)
 *
 * Trả về JSON:
 * {
 *   "success": true|false,
 *   "message": "Thông báo",
 *   "cart": {
 *      "items": {...},
 *      "total_qty": 0,
 *      "total_price": 0
 *   }
 * }
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');

if (!defined('LIB')) {
    define('LIB', '../lib/');
}

require_once LIB . 'config.php';
require_once LIB . 'config-type.php';
require_once LIB . 'autoload.php';
new AutoLoad();

$response = [
    'success' => false,
    'message' => '',
    'cart'    => null,
];

try {
    $d            = new Database($config['database']);
    $productModel = new Product($d);
    $cartHelper   = new CartHelper($productModel);

    $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $qty       = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;

    if ($productId <= 0) {
        throw new RuntimeException('Mã sản phẩm không hợp lệ');
    }

    if ($qty <= 0) {
        $qty = 1;
    }

    $cart = $cartHelper->add($productId, $qty);

    $response['success'] = true;
    $response['message'] = 'Đã thêm sản phẩm vào giỏ hàng';
    $response['cart']    = $cart;
} catch (RuntimeException $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Có lỗi xảy ra, vui lòng thử lại sau.';
}

echo json_encode($response);
exit;


