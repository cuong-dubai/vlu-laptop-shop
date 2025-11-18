<div class="wrap-content">
    <div class="title-main">
        <h2><?= (!empty($titleCate)) ? $titleCate : @$titleMain ?></h2>
    </div>
    <div class="row">
        <?php
        foreach ($allNews as $key => $value) { ?>
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <a href="<?=$value['slug']?>">
                    <div class="card news-card border-0">
                        <div class="card-img-top overflow-hidden">
                            <img src="<?= UPLOAD_PRODUCT_L . $value['photo'] ?>" width="400" height="250"
                                onerror="this.src='assets/images/noimage.png'" class="" alt="<?= $value['name'] ?>">
                        </div>
                        <div class="card-body px-0 pt-2">
                            <h6 class="card-title mb-0">
                                <?= $value['name'] ?>
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
        <?php }
        ?>

    </div>
</div>