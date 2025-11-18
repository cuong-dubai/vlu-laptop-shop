<div class="wrap-content py-4 bg-light">
    <div class="container">
        <div class="title-main mb-4">
            <h2><?= (!empty($titleCate)) ? $titleCate : @$titleMain ?></h2>
        </div>

        <?php if (!empty($flash)) {
            echo $flash->getMessages('frontend');
        } ?>

        <?php if (empty($cartItems)) { ?>
            <div class="alert alert-info">
                Giỏ hàng của bạn đang trống. <a href="<?= $configBase ?>">Tiếp tục mua sắm</a>.
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-lg-7">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white">
                            <strong>Sản phẩm trong giỏ (<?= count($cartItems) ?>)</strong>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cartItems as $item) { ?>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= UPLOAD_PRODUCT_L . $item['photo'] ?>" width="70" height="70"
                                                        class="rounded border mr-3"
                                                        onerror="this.src='extensions/images/noimage.png'" alt="<?= htmlspecialchars($item['name']) ?>">
                                                    <div>
                                                        <a class="font-weight-bold text-dark d-block"
                                                            href="san-pham/<?= htmlspecialchars($item['slug']) ?>">
                                                            <?= htmlspecialchars($item['name']) ?>
                                                        </a>
                                                        <small class="text-muted">Mã: #<?= htmlspecialchars($item['id']) ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <?= number_format((float)$item['price'], 0, ',', '.') ?>đ
                                            </td>
                                            <td class="align-middle"><?= (int)$item['qty'] ?></td>
                                            <td class="align-middle">
                                                <?= number_format((float)$item['price'] * (int)$item['qty'], 0, ',', '.') ?>đ
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-white">
                            <strong>Thông tin người nhận</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" class="checkout-form">
                                <input type="hidden" name="checkout_submit" value="1">

                                <div class="form-group">
                                    <label for="checkoutFullname">Họ và tên *</label>
                                    <input type="text" class="form-control" id="checkoutFullname" name="fullname"
                                        value="<?= htmlspecialchars($checkoutFormData['fullname'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="checkoutPhone">Số điện thoại *</label>
                                    <input type="text" class="form-control" id="checkoutPhone" name="phone"
                                        value="<?= htmlspecialchars($checkoutFormData['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="checkoutEmail">Email</label>
                                    <input type="email" class="form-control" id="checkoutEmail" name="email"
                                        value="<?= htmlspecialchars($checkoutFormData['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="checkoutAddress">Địa chỉ giao hàng *</label>
                                    <textarea class="form-control" id="checkoutAddress" name="address" rows="2" required><?= htmlspecialchars($checkoutFormData['address'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="checkoutNote">Ghi chú</label>
                                    <textarea class="form-control" id="checkoutNote" name="note" rows="2"><?= htmlspecialchars($checkoutFormData['note'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="d-block">Phương thức thanh toán</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="paymentCOD" name="payment_method" value="cod"
                                            <?= (($checkoutFormData['payment_method'] ?? 'cod') === 'cod') ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="paymentCOD">Thanh toán khi nhận hàng (COD)</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="paymentBank" name="payment_method" value="bank"
                                            <?= (($checkoutFormData['payment_method'] ?? '') === 'bank') ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="paymentBank">Chuyển khoản ngân hàng</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="d-block">Hình thức giao hàng</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="shippingStandard" name="shipping_method" value="standard"
                                            <?= (($checkoutFormData['shipping_method'] ?? 'standard') === 'standard') ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="shippingStandard">Tiêu chuẩn</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="shippingExpress" name="shipping_method" value="express"
                                            <?= (($checkoutFormData['shipping_method'] ?? '') === 'express') ? 'checked' : '' ?>>
                                        <label class="custom-control-label" for="shippingExpress">Hoả tốc</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                                    Hoàn tất đặt hàng
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <strong>Tóm tắt đơn hàng</strong>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Số lượng sản phẩm</span>
                                <span class="font-weight-bold"><?= $cartTotals['qty'] ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Tổng tiền hàng</span>
                                <span><?= number_format($cartTotals['price'], 0, ',', '.') ?>đ</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">Thành tiền</span>
                                <span class="font-weight-bold text-danger h5 mb-0">
                                    <?= number_format($cartTotals['price'], 0, ',', '.') ?>đ
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>