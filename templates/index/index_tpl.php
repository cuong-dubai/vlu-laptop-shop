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
<section id="Product__Categories">
    <div class="wrap-content">
        <?php
        foreach ($categories as $key => $value) {
            $productForList = $d->rawQuery("select * from #_product where type = ? and id_list = ? and find_in_set('hienthi',status) order by numb,id desc", array('san-pham', $value['id']));
            ?>
            <div class="Product__Categories__Wrap">
                <div class="title__categories">
                    <h2><?= $value['name' . $lang] ?></h2>
                    <a href="<?= $value['slug'] ?>" class="view__all__btn">Xem tất cả</a>
                </div>
                <div class="ProductList__list">
                    <?php
                    echo $func->GetProducts($productForList);
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<section id="Post">
    <div class="Post__Wrap">
        <div class="wrap-content">
            <div class="Post__nav">
                <h2>Tin công nghệ</h2>
                <a href="tin-cong-nghe" class="view__all__post">Xem tất cả <svg xmlns="http://www.w3.org/2000/svg" width="14"
                        height="7" viewBox="0 0 14 7" fill="none">
                        <path
                            d="M12.1123 4.06465C12.0096 4.06465 11.9449 4.06465 11.8806 4.06465C8.1634 4.06465 4.44655 4.06465 0.729393 4.06433C0.651301 4.06433 0.572897 4.06659 0.49543 4.05884C0.209302 4.03143 -0.00216976 3.78857 1.68015e-05 3.49475C0.00220337 3.20093 0.215862 2.96356 0.504176 2.93872C0.576645 2.93259 0.649739 2.93453 0.722521 2.93453C4.43437 2.93421 8.14622 2.93453 11.8581 2.93453C11.9293 2.93453 12.0002 2.93453 12.0714 2.93453C12.0858 2.91389 12.0998 2.89324 12.1142 2.8726C12.0636 2.83842 12.0058 2.81165 11.9637 2.76843C11.383 2.17434 10.8038 1.57896 10.226 0.981971C10.037 0.786522 9.99543 0.529148 10.1085 0.303059C10.2216 0.0776153 10.4506 -0.0446211 10.697 0.0150457C10.7979 0.0395575 10.9054 0.0966442 10.9788 0.17147C11.9318 1.1413 12.8811 2.115 13.8266 3.09256C14.0734 3.34768 14.0531 3.67698 13.7891 3.94886C13.0001 4.76098 12.2092 5.57148 11.4192 6.38263C11.2789 6.52679 11.1409 6.67322 10.9981 6.81449C10.7542 7.05606 10.4212 7.06154 10.2041 6.8319C9.98606 6.60098 9.99575 6.25587 10.2325 6.01108C10.8101 5.41409 11.3898 4.81903 11.9687 4.22301C12.0077 4.18269 12.0439 4.14012 12.1123 4.06465Z"
                            fill="white" />
                    </svg></a>
            </div>
            <div class="Post__List">
                <?php if (!empty($latestNews)) { ?>
                    <?php foreach ($latestNews as $news) { ?>
                        <div class="post-item mb-3 p-3 border rounded">
                            <h4 class="mb-2">
                                <a href="blog/<?= htmlspecialchars($news['slug'] ?? '') ?>" class="text-dark text-decoration-none">
                                    <?= htmlspecialchars($news['name'] ?? '') ?>
                                </a>
                            </h4>
                            <?php if (!empty($news['desc'])) { ?>
                                <p class="text-muted mb-2"><?= htmlspecialchars(mb_substr($news['desc'], 0, 150)) ?>...</p>
                            <?php } ?>
                            <small class="text-muted">
                                <?= !empty($news['date_created']) ? date('d/m/Y', $news['date_created']) : '' ?>
                            </small>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-muted">Chưa có tin tức nào.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>