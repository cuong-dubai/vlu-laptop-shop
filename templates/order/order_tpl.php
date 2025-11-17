<div class="wrap-content">
    <div class="title-main">
        <h2><?= (!empty($titleCate)) ? $titleCate : @$titleMain ?></h2>
    </div>

    <?php if (empty($cartItems)): ?>
        <p style="padding:20px;">Giỏ hàng của bạn đang trống.</p>
        <p style="padding:0 20px;"><a href="san-pham" style="color:#007bff;">← Tiếp tục mua sắm</a></p>
    <?php else: ?>
        <div style="margin-bottom:15px;">
            <a href="gio-hang?clear=1" 
               onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')" 
               style="color:#dc3545;text-decoration:none;">
                🗑️ Xóa giỏ hàng
            </a>
        </div>
        <div class="cart-table" style="margin-bottom:30px;">
            <table border="1" cellpadding="8" cellspacing="0" width="100%" style="border-collapse:collapse;">
                <thead>
                    <tr style="background:#f5f5f5;">
                        <th width="80">Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th width="120">Đơn giá</th>
                        <th width="80">Số lượng</th>
                        <th width="120">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($cartItems as $item):
                        $price     = (float)($item['price'] ?? 0);
                        $qty       = (int)($item['qty'] ?? 1);
                        $lineTotal = $price * $qty;
                        $total    += $lineTotal;

                        $photoPath = (!empty($item['photo'])) 
                            ? UPLOAD_PRODUCT_L . $item['photo'] 
                            : 'extensions/images/noimage.png';
                        ?>
                        <tr>
                            <td style="text-align:center;">
                                <img src="<?= $photoPath ?>" 
                                     alt="<?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>" 
                                     width="60" 
                                     onerror="this.src='extensions/images/noimage.png'">
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></strong><br>
                                <?php if (!empty($item['slug'])): ?>
                                    <a href="<?= $item['slug'] ?>" style="font-size:12px;color:#999;">Xem chi tiết</a>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:right;">
                                <?php if ($price > 0): ?>
                                    <?= number_format($price, 0, ',', '.') ?>₫
                                <?php else: ?>
                                    <em style="color:#999;">Liên hệ</em>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center;">
                                <?= $qty ?>
                            </td>
                            <td style="text-align:right;">
                                <strong><?= number_format($lineTotal, 0, ',', '.') ?>₫</strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr style="background:#f9f9f9;font-weight:bold;">
                        <th colspan="4" style="text-align:right;padding:10px;">Tổng cộng:</th>
                        <th style="text-align:right;padding:10px;color:#c00;">
                            <?= number_format($total, 0, ',', '.') ?>₫
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <form method="post" action="gio-hang" class="cart-checkout-form">
            <h3 style="margin-bottom:12px;">Thông tin khách hàng</h3>
            <div style="margin-bottom:10px;">
                <label><strong>Họ tên <span style="color:red;">*</span></strong></label><br>
                <input type="text" name="customer_name" required style="width:100%;max-width:400px;padding:6px;">
            </div>
            <div style="margin-bottom:10px;">
                <label><strong>Số điện thoại <span style="color:red;">*</span></strong></label><br>
                <input type="text" name="phone" required style="width:100%;max-width:400px;padding:6px;">
            </div>
            <div style="margin-bottom:10px;">
                <label><strong>Địa chỉ nhận hàng <span style="color:red;">*</span></strong></label><br>
                <textarea name="address" required rows="3" style="width:100%;max-width:600px;padding:6px;"></textarea>
            </div>

            <div style="margin-top:20px;">
                <button type="submit" name="processCheckout" value="1" style="padding:10px 30px;background:#28a745;color:#fff;border:none;cursor:pointer;font-size:16px;">
                    Đặt hàng
                </button>
            </div>
        </form>
    <?php endif; ?>
</div>