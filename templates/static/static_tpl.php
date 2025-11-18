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
</div>