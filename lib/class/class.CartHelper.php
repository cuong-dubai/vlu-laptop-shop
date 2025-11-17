<?php

class CartHelper
{
    /**
     * Tên key trong $_SESSION để lưu giỏ hàng.
     *
     * @var string
     */
    protected $sessionKey = 'cart';

    /**
     * @var Product|null
     */
    protected $productModel;

    /**
     * Khởi tạo CartHelper.
     * Có thể truyền Product model để CartHelper tự lấy thông tin sản phẩm khi thêm vào giỏ.
     *
     * @param Product|null $productModel
     */
    public function __construct(Product $productModel = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->productModel = $productModel;
        $this->initCart();
    }

    /**
     * Khởi tạo cấu trúc giỏ hàng trong session nếu chưa có.
     *
     * Cấu trúc:
     * $_SESSION['cart'] = [
     *     'items'       => [ productId => [...], ... ],
     *     'total_qty'   => int,
     *     'total_price' => float,
     * ];
     *
     * @return void
     */
    protected function initCart(): void
    {
        if (!isset($_SESSION[$this->sessionKey]) || !is_array($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = [
                'items'       => [],
                'total_qty'   => 0,
                'total_price' => 0,
            ];
            return;
        }

        // Đảm bảo luôn có đủ các key chính
        if (!isset($_SESSION[$this->sessionKey]['items']) || !is_array($_SESSION[$this->sessionKey]['items'])) {
            $_SESSION[$this->sessionKey]['items'] = [];
        }
        if (!isset($_SESSION[$this->sessionKey]['total_qty'])) {
            $_SESSION[$this->sessionKey]['total_qty'] = 0;
        }
        if (!isset($_SESSION[$this->sessionKey]['total_price'])) {
            $_SESSION[$this->sessionKey]['total_price'] = 0;
        }
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     * Nếu đã tồn tại thì cộng dồn số lượng.
     *
     * @param int $productId
     * @param int $qty
     * @return array  Trả về giỏ hàng sau khi cập nhật.
     */
    public function add(int $productId, int $qty = 1): array
    {
        if ($qty < 1) {
            $qty = 1;
        }

        if (!$this->productModel instanceof Product) {
            throw new RuntimeException('CartHelper: productModel chưa được cung cấp');
        }

        $product = $this->productModel->getProductById($productId);
        if (!$product) {
            throw new RuntimeException('Sản phẩm không tồn tại');
        }

        $cart = &$_SESSION[$this->sessionKey];

        // chọn giá bán: ưu tiên sale_price nếu > 0, nếu không dùng regular_price
        $price = (float)$product['sale_price'];
        if ($price <= 0) {
            $price = (float)$product['regular_price'];
        }

        if (isset($cart['items'][$productId])) {
            $cart['items'][$productId]['qty'] += $qty;
        } else {
            $cart['items'][$productId] = [
                'id'    => (int)$product['id'],
                'name'  => $product['name'],
                'slug'  => $product['slug'],
                'photo' => $product['photo'],
                'price' => $price,
                'qty'   => $qty,
            ];
        }

        $this->recalculateTotals();

        return $cart;
    }

    /**
     * Cập nhật số lượng cho 1 sản phẩm trong giỏ.
     * Nếu qty <= 0 thì xoá sản phẩm khỏi giỏ.
     *
     * @param int $productId
     * @param int $qty
     * @return array
     */
    public function update(int $productId, int $qty): array
    {
        $cart = &$_SESSION[$this->sessionKey];

        if (!isset($cart['items'][$productId])) {
            return $cart;
        }

        if ($qty <= 0) {
            unset($cart['items'][$productId]);
        } else {
            $cart['items'][$productId]['qty'] = $qty;
        }

        $this->recalculateTotals();

        return $cart;
    }

    /**
     * Xoá 1 sản phẩm khỏi giỏ.
     *
     * @param int $productId
     * @return array
     */
    public function remove(int $productId): array
    {
        $cart = &$_SESSION[$this->sessionKey];

        if (isset($cart['items'][$productId])) {
            unset($cart['items'][$productId]);
            $this->recalculateTotals();
        }

        return $cart;
    }

    /**
     * Xoá toàn bộ giỏ hàng.
     *
     * @return void
     */
    public function clear(): void
    {
        $_SESSION[$this->sessionKey] = [
            'items'       => [],
            'total_qty'   => 0,
            'total_price' => 0,
        ];
    }

    /**
     * Tính lại tổng số lượng và tổng tiền.
     *
     * @return void
     */
    protected function recalculateTotals(): void
    {
        $cart = &$_SESSION[$this->sessionKey];

        $totalQty   = 0;
        $totalPrice = 0;

        foreach ($cart['items'] as $item) {
            $totalQty   += (int)$item['qty'];
            $totalPrice += (float)$item['price'] * (int)$item['qty'];
        }

        $cart['total_qty']   = $totalQty;
        $cart['total_price'] = $totalPrice;
    }

    /**
     * Lấy toàn bộ giỏ hàng.
     *
     * @return array
     */
    public function getCart(): array
    {
        $this->initCart();
        return $_SESSION[$this->sessionKey];
    }

    /**
     * Lấy danh sách item trong giỏ.
     *
     * @return array
     */
    public function getItems(): array
    {
        $this->initCart();
        return $_SESSION[$this->sessionKey]['items'];
    }

    /**
     * Tổng số lượng sản phẩm trong giỏ.
     *
     * @return int
     */
    public function getTotalQty(): int
    {
        $this->initCart();
        return (int)$_SESSION[$this->sessionKey]['total_qty'];
    }

    /**
     * Tổng tiền giỏ hàng.
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        $this->initCart();
        return (float)$_SESSION[$this->sessionKey]['total_price'];
    }
}


