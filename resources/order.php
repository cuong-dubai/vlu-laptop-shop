<?php
if (!defined('SOURCES')) {
    die("Error");
}

/* Khởi tạo các model cần thiết cho giỏ hàng & đặt hàng */
$productModel = new Product($d);
$cartHelper   = new CartHelper($productModel);
$orderModel   = new OrderModel($d);

// Dữ liệu giỏ hàng cho template (nếu cần hiển thị)
$cart      = $cartHelper->getCart();
$cartItems = $cart['items'];

// Xử lý xóa giỏ hàng
if (isset($_GET['clear'])) {
    $cartHelper->clear();
    $func->redirect($configBase . 'gio-hang');
}

// Nếu có submit form checkout thì xử lý
if (!empty($_POST['processCheckout'])) {
    processCheckout();
}

/**
 * Xử lý checkout: chuyển giỏ hàng thành đơn hàng & chi tiết đơn hàng.
 *
 * Sử dụng:
 *  - CartHelper: lấy danh sách sản phẩm trong giỏ, tổng tiền, xoá giỏ sau khi đặt
 *  - OrderModel: lưu vào bảng `order` và `order_detail`
 *  - Product model (nếu sau này cần kiểm tra lại giá, tồn kho,...)
 */
function processCheckout()
{
    global $func, $configBase, $cartHelper, $orderModel;

    // Lấy thông tin từ form
    $customerName = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
    $phone        = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address      = isset($_POST['address']) ? trim($_POST['address']) : '';

    // Lấy giỏ hàng hiện tại
    $cart      = $cartHelper->getCart();
    $cartItems = $cart['items'];
    $total     = $cart['total_price'];

    // Validate đơn giản
    if (empty($cartItems)) {
        $func->transfer("Giỏ hàng của bạn đang trống", $configBase . "gio-hang", false);
    }

    if ($customerName === '' || $phone === '' || $address === '') {
        $func->transfer("Vui lòng nhập đầy đủ Họ tên, Số điện thoại và Địa chỉ nhận hàng", $configBase . "gio-hang", false);
    }

    // Tạo đơn hàng chính
    $orderData = [
        'customer_name' => $customerName,
        'phone'         => $phone,
        'address'       => $address,
        'total_price'   => $total,
        'status'        => 1, // 1 = mới tạo / chờ xử lý
        'date_created'  => time(),
        'date_updated'  => 0,
    ];

    $orderId = $orderModel->createOrder($orderData);

    if (!$orderId) {
        $func->transfer("Không thể tạo đơn hàng, vui lòng thử lại sau", $configBase . "gio-hang", false);
    }

    // Lưu chi tiết đơn hàng
    foreach ($cartItems as $item) {
        $detailData = [
            'id_order'   => (int)$orderId,
            'id_product' => (int)$item['id'],
            'price'      => (float)$item['price'],
            'quantity'   => (int)$item['qty'],
        ];
        $orderModel->createOrderDetail($detailData);
    }

    // Xoá giỏ hàng sau khi đặt thành công
    $cartHelper->clear();

    // Điều hướng về trang cảm ơn hoặc trang chủ
    $func->transfer("Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.", $configBase, true);
}


