<?php
global $lang, $type;
$langSuffix = isset($lang) ? $lang : '';
$contentField = 'content' . $langSuffix;
$currentType = isset($type) ? $type : '';
?>
<div class="wrap-content">
    <div class="title-main">
        <h2><?= (!empty($titleCate)) ? $titleCate : @$titleMain ?></h2>
    </div>

    <?php if (!empty($static[$contentField])) { ?>
        <div class="static-content mt-3">
            <?= $func->decodeHtmlChars($static[$contentField]) ?>
        </div>
    <?php } ?>

    <?php if ($currentType === 'gioi-thieu') { ?>
        <div class="project-info mt-4">
            <p><strong>Đồ án của nhóm 06</strong></p>
            <p>Môn: Lập trình ứng dụng web</p>
            <p>Giảng viên hướng dẫn: Thầy Trần Công Thanh</p>
        </div>
    <?php } ?>

    <?php if ($currentType === 'lien-he') { ?>
        <div class="team-info mt-4">
            <p><strong>Người làm 1:</strong> Cường</p>
            <p><strong>Email : :</strong> Cường</p>
            <p><strong>Người làm 2:</strong> Huy</p>
            <p>Email: Huy.2274802010328@vanlanguni.vn</p>
        </div>
    <?php } ?>

    <?php if ($currentType === 'blog') { ?>
        <div class="news-links mt-4">
            <h3 class="mb-3">Các Tin tức Laptop</h3>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <a href="https://vnexpress.net/tag/laptop-5258" target="_blank" rel="noopener noreferrer" class="text-primary">
                        https://vnexpress.net/tag/laptop-5258
                    </a>
                </li>
                <li class="mb-2">
                    <a href="https://www.thegioididong.com/tin-tuc/laptop/1269" target="_blank" rel="noopener noreferrer" class="text-primary">
                        https://www.thegioididong.com/tin-tuc/laptop/1269
                    </a>
                </li>
            </ul>
        </div>
    <?php } ?>
</div>