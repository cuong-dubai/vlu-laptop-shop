<?php
$linkMan = "index.php?com=product&act=man_list&type=" . $type;
$linkSave = "index.php?com=product&act=save_list&type=" . $type;

if ((isset($config['product'][$type]['images_list']) && $config['product'][$type]['images_list'] == true)) {
    $colLeft = "col-xl-8";
    $colRight = "col-xl-4";
} else {
    $colLeft = "col-12";
    $colRight = "d-none";
}
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết <?= $config['product'][$type]['title_main_list'] ?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?= $linkSave ?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check" disabled><i
                    class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i
                    class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>

        <?= $flash->getMessages('admin') ?>

        <div class="row">
            <div class="<?= $colLeft ?>">
                <?php
                if (isset($config['product'][$type]['slug_list']) && $config['product'][$type]['slug_list'] == true) {
                    $slugchange = ($act == 'edit_list') ? 1 : 0;
                    include TEMPLATE . LAYOUT . "slug.php";
                }
                ?>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung <?= $config['product'][$type]['title_main_list'] ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <?php $status_array = (!empty($item['status'])) ? explode(',', $item['status']) : array(); ?>
                            <?php if (isset($config['product'][$type]['check_list'])) {
                                foreach ($config['product'][$type]['check_list'] as $key => $value) { ?>
                                    <div class="form-group d-inline-block mb-2 mr-2">
                                        <label for="<?= $key ?>-checkbox"
                                            class="d-inline-block align-middle mb-0 mr-2"><?= $value ?>:</label>
                                        <div class="custom-control custom-checkbox d-inline-block align-middle">
                                            <input type="checkbox" class="custom-control-input <?= $key ?>-checkbox"
                                                name="status[<?= $key ?>]" id="<?= $key ?>-checkbox" <?= (empty($status_array) && empty($item['id']) ? 'checked' : in_array($key, $status_array)) ? 'checked' : '' ?> value="<?= $key ?>">
                                            <label for="<?= $key ?>-checkbox" class="custom-control-label"></label>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                        <div class="form-group">
                            <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                            <input type="number"
                                class="form-control form-control-mini d-inline-block align-middle text-sm" min="0"
                                name="data[numb]" id="numb" placeholder="Số thứ tự"
                                value="<?= isset($item['numb']) ? $item['numb'] : 1 ?>">
                        </div>
                        <div class="card card-primary card-outline card-outline-tabs">
                     
                            <div class="card-body card-article">
                                <div class="form-group">
                                    <label for="name">Tên danh mục:</label>
                                    <input type="text" class="form-control for-seo text-sm" name="data[name]"
                                        id="namevi" placeholder="Tên danh mục"
                                        value="<?= (!empty($flash->has('name'))) ? $flash->get('name') : @$item['name'] ?>"
                                        required>
                                </div>
                                <?php if (isset($config['product'][$type]['desc_list']) && $config['product'][$type]['desc_list'] == true) { ?>
                                    <div class="form-group">
                                        <label for="desc">Mô tả:</label>
                                        <textarea
                                            class="form-control for-seo text-sm"
                                            name="data[desc]" id="desc" rows="5"
                                            placeholder="Mô tả"><?= $func->decodeHtmlChars($flash->get('desc')) ?: $func->decodeHtmlChars(@$item['desc']) ?></textarea>
                                    </div>
                                <?php } ?>
                                <?php if (isset($config['product'][$type]['content_list']) && $config['product'][$type]['content_list'] == true) { ?>
                                    <div class="form-group">
                                        <label for="content">Nội dung:</label>
                                        <textarea
                                            class="form-control for-seo text-sm"
                                            name="data[content]" id="content" rows="5"
                                            placeholder="Nội dung"><?= $func->decodeHtmlChars($flash->get('content')) ?: $func->decodeHtmlChars(@$item['content']) ?></textarea>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="<?= $colRight ?>">
                <?php if (isset($config['product'][$type]['images_list']) && $config['product'][$type]['images_list'] == true) { ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình ảnh <?= $config['product'][$type]['title_main_list'] ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            /* Photo detail */
                            $photoDetail = array();
                            $photoDetail['upload'] = UPLOAD_PRODUCT_L;
                            $photoDetail['image'] = (!empty($item)) ? UPLOAD_PRODUCT_L.$item['photo'] : '';
                            $photoDetail['dimension'] = "Width: " . $config['product'][$type]['width_list'] . " px - Height: " . $config['product'][$type]['height_list'] . " px (" . $config['product'][$type]['img_type_list'] . ")";

                            /* Image */
                            include TEMPLATE . LAYOUT . "image.php";
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check" disabled><i
                    class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i
                    class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?= (isset($item['id']) && $item['id'] > 0) ? $item['id'] : '' ?>">
        </div>
    </form>
</section>