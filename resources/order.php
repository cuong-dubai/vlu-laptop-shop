
<?php
if (!defined('SOURCES')) {
    die("Error");
}

$productModel = new Product($d);
$cartHelper   = new CartHelper($productModel);
$orderModel   = new OrderModel($d);

if (!empty($_POST['checkout_submit'])) {
    processCheckout();
}

$cartData = $cartHelper->getCart();
$cartItems = $cartData['items'];
$cartTotals = [
    'qty'   => (int)($cartData['total_qty'] ?? 0),
    'price' => (float)($cartData['total_price'] ?? 0),
];

$checkoutFormData = [
    'fullname'        => '',
    'email'           => '',
    'phone'           => '',
    'address'         => '',
    'note'            => '',
    'payment_method'  => 'cod',
    'shipping_method' => 'standard',
];

if ($flash->has('checkout_form')) {
    $checkoutFormData = array_merge($checkoutFormData, $flash->get('checkout_form'));
}

if (!empty($_POST['cart_action'])) {
    handleCartActions($_POST['cart_action']);
}

function processCheckout(): void
{
    global $cartHelper, $orderModel, $flash, $func, $configBase, $loginMember, $d;

    $cart = $cartHelper->getCart();
    if (empty($cart['items'])) {
        $func->transfer("Giỏ hàng của bạn đang trống.", $configBase . "gio-hang", false);
    }

    $formData = [
        'fullname'        => trim($_POST['fullname'] ?? ''),
        'email'           => trim($_POST['email'] ?? ''),
        'phone'           => trim($_POST['phone'] ?? ''),
        'address'         => trim($_POST['address'] ?? ''),
        'note'            => trim(strip_tags($_POST['note'] ?? '')),
        'payment_method'  => trim($_POST['payment_method'] ?? 'cod'),
        'shipping_method' => trim($_POST['shipping_method'] ?? 'standard'),
    ];

    $allowedPayments = ['cod', 'bank'];
    $allowedShipping = ['standard', 'express'];

    if (!in_array($formData['payment_method'], $allowedPayments, true)) {
        $formData['payment_method'] = 'cod';
    }
    if (!in_array($formData['shipping_method'], $allowedShipping, true)) {
        $formData['shipping_method'] = 'standard';
    }

    $errors = [];
    $sanitizedPhone = $func->parsePhone($formData['phone']);

    if ($formData['fullname'] === '') {
        $errors[] = 'Vui lòng nhập họ tên người nhận.';
    }

    if ($formData['phone'] === '') {
        $errors[] = 'Vui lòng nhập số điện thoại.';
    } elseif (!$func->isPhone($sanitizedPhone)) {
        $errors[] = 'Số điện thoại không hợp lệ.';
    }

    if ($formData['address'] === '') {
        $errors[] = 'Vui lòng nhập địa chỉ giao hàng.';
    }

    if ($formData['email'] !== '' && !$func->isEmail($formData['email'])) {
        $errors[] = 'Email không hợp lệ.';
    }

    if (!empty($errors)) {
        handleCheckoutError($errors, $formData);
        return;
    }

    $customerId = !empty($_SESSION[$loginMember]['id']) ? (int)$_SESSION[$loginMember]['id'] : null;
    $orderCode  = generateOrderCode();

    try {
        $d->startTransaction();

        $orderData = [
            'code'            => $orderCode,
            'user_id'         => $customerId,
            'fullname'        => $formData['fullname'],
            'email'           => $formData['email'],
            'phone'           => $sanitizedPhone ?: $formData['phone'],
            'address'         => $formData['address'],
            'note'            => $formData['note'],
            'payment_method'  => $formData['payment_method'],
            'shipping_method' => $formData['shipping_method'],
            'total_qty'       => $cart['total_qty'],
            'total_price'     => $cart['total_price'],
            'status'          => 'pending',
        ];

        $orderId = $orderModel->createOrder($orderData);
        if (!$orderId) {
            throw new RuntimeException('Không thể tạo đơn hàng.');
        }

        foreach ($cart['items'] as $item) {
            $detailData = [
                'order_id'     => $orderId,
                'product_id'   => $item['id'],
                'product_name' => $item['name'],
                'product_slug' => $item['slug'],
                'photo'        => $item['photo'],
                'price'        => $item['price'],
                'qty'          => $item['qty'],
                'total_price'  => $item['price'] * $item['qty'],
            ];

            if (!$orderModel->createOrderDetail($detailData)) {
                throw new RuntimeException('Không thể lưu chi tiết đơn hàng.');
            }
        }

        $d->commit();
    } catch (Throwable $e) {
        $d->rollback();
        error_log('[Checkout] ' . $e->getMessage());
        handleCheckoutError(['Hệ thống đang bận, vui lòng thử lại sau.'], $formData);
        return;
    }

    $cartHelper->clear();
    $func->transfer("Đặt hàng thành công. Mã đơn hàng: {$orderCode}", $configBase);
}

function handleCartActions(string $action): void
{
    global $cartHelper, $func, $configBase;

    if ($action === 'clear_cart') {
        $cartHelper->clear();
        $func->redirect($configBase . "gio-hang");
        return;
    }

    if ($action === 'remove_item') {
        $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

        if ($productId > 0) {
            $cartHelper->remove($productId);
        }

        $func->redirect($configBase . "gio-hang");
    }
}

function handleCheckoutError(array $messages, array $formData): void
{
    global $flash, $func, $configBase;

    $flash->set('checkout_form', $formData);
    $flash->set('message', base64_encode(json_encode([
        'status'   => 'danger',
        'messages' => $messages,
    ])));

    $func->redirect($configBase . "gio-hang");
}

function generateOrderCode(): string
{
    global $func;

    return 'ORD' . strtoupper($func->stringRandom(8));
}

