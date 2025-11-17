<div class="wrap-content py-4 bg-light mt-4">
    <div class="container">

        <div class="row">

            <!-- IMAGE -->
            <div class="col-md-5 mb-4">
                <div class="product-image text-center p-3 border rounded" style="border-color:#000000;">
                    <img src="<?= UPLOAD_PRODUCT_L . $rowDetail['photo'] ?>" width="450" height="450"
                        onerror="this.src='extensions/images/noimage.png'" class="rounded img-preview" alt="">
                </div>
            </div>

            <!-- INFO -->
            <div class="col-md-7">

                <h2 class="font-weight-bold mb-3 title-product-detail" style="color:#000000;"><?= $rowDetail['name'] ?>
                </h2>
                <p class="mb-2" style="color:#000000;">
                    <i class="fas fa-tags mr-1"></i>
                    Danh mục: <strong><?= $productList['name'] ?></strong>
                </p>
                <p class="mb-2" style="color:#000000;">
                    <i class="fas fa-store mr-1"></i>
                    Thương hiệu: <strong><?= $productBrand['name'] ?></strong>
                </p>

                <?php if ($rowDetail['discount'] != 0) { ?>
                    <h4 class="font-weight-bold mb-3 priceDetail_product" style="color:#000000;">
                        <?= $func -> formatMoney($rowDetail['sale_price']) ?>
                        <small class="text-muted">
                            <del><?= $func -> formatMoney($rowDetail['regular_price']) ?></del>
                            
                        </small>
                    </h4>
                <?php } else { ?>
                    <h4 class="font-weight-bold mb-3 priceDetail_product" style="color:#000000;">
                       <?= $func -> formatMoney($rowDetail['regular_price']) ?>
                    </h4>
                <?php } ?>

                <p class="text-dark mb-3">
                    <?= $rowDetail['desc'] ?>
                </p>

                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-center mb-3">✔</span>
                        <span class="text-dark">Bảo hành 12 tháng</span>
                    </li>

                    <li class="d-flex align-items-center mb-3">✔</span>
                        <span class="text-dark">Đổi trả trong 7 ngày</span>
                    </li>

                    <li class="d-flex align-items-center ">✔</span>
                        <span class="text-dark">Giao hàng nhanh</span>
                    </li>
                </ul>


                <div class="cart-pro-detail">
                    <a class="btn btn-success addcart  mr-2" data-id="<?= $rowDetail['id'] ?>" data-action="addnow">
                        <i class="fas fa-shopping-bag mr-1"></i>
                        <span>Thêm vào giỏ hàng</span>
                    </a>
                    <a class="btn btn-dark addcart " data-id="<?= $rowDetail['id'] ?>" data-action="buynow">
                        <i class="fas fa-shopping-bag mr-1"></i>
                        <span>Mua ngay</span>
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>
<div class="wrap-content">
    <div class="title-main">
        <h2>Sản phẩm liên quan</h2>
    </div>
    <div class="list-product">
        <?php echo $func->GetProducts($product) ?>
    </div>
</div>