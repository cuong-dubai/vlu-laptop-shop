<div class="wrap-content py-4 bg-light mt-4">
    <div class="container">
        <?php if (!empty($newsDetail)) { ?>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <article class="news-detail">
                        <h1 class="font-weight-bold mb-3"><?= htmlspecialchars($newsDetail['name'] ?? '') ?></h1>
                        
                        <div class="news-meta mb-3 text-muted">
                            <small>
                                <i class="far fa-calendar mr-1"></i>
                                <?= !empty($newsDetail['date_created']) ? date('d/m/Y H:i', $newsDetail['date_created']) : '' ?>
                            </small>
                        </div>

                        <?php if (!empty($newsDetail['photo'])) { ?>
                            <div class="news-image mb-4">
                                <img src="<?= UPLOAD_PRODUCT_L . $newsDetail['photo'] ?>" 
                                     class="img-fluid rounded" 
                                     alt="<?= htmlspecialchars($newsDetail['name'] ?? '') ?>"
                                     onerror="this.src='extensions/images/noimage.png'">
                            </div>
                        <?php } ?>

                        <?php if (!empty($newsDetail['desc'])) { ?>
                            <div class="news-excerpt mb-4">
                                <p class="lead text-muted"><?= htmlspecialchars($newsDetail['desc']) ?></p>
                            </div>
                        <?php } ?>

                        <?php if (!empty($newsDetail['content'])) { ?>
                            <div class="news-content">
                                <?= $func->decodeHtmlChars($newsDetail['content']) ?>
                            </div>
                        <?php } ?>

                        <div class="news-footer mt-4 pt-3 border-top">
                            <a href="<?= $configBase ?>blog" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Quay lại danh sách tin tức
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning">
                <h4>Bài viết không tồn tại</h4>
                <p>Bài viết bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
                <a href="<?= $configBase ?>blog" class="btn btn-primary">Quay lại danh sách tin tức</a>
            </div>
        <?php } ?>
    </div>
</div>

