<section id="ProductBestSeller">
    <div class="wrap-content">
        <div class="ProductBestSeller__Wrap">
            <div class="title-main title-white">
                <h2>SẢN PHẨM BÁN CHẠY <img src="assets/images/sale.gif" width="32" height="32" alt="Sale"></h2>
            </div>
            <div class="ProductBestSeller__list">
                <?php
                echo $func->GetProducts($productBestSeller);
                ?>
            </div>
        </div>
    </div>
</section>