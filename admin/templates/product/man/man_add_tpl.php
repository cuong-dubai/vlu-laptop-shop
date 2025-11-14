
<?php 

if ($act == "add") $labelAct = "Thêm mới";
else if ($act == "edit") $labelAct = "Chỉnh sửa";
else if ($act == "copy")  $labelAct = "Sao chép";

$linkMan = "index.php?com=product&act=man&type=" . $type;
if ($act == 'add') $linkFilter = "index.php?com=product&act=add&type=" . $type;
else if ($act == 'edit') $linkFilter = "index.php?com=product&act=edit&type=" . $type . "&id=" . $id;
if ($act == "copy") $linkSave = "index.php?com=product&act=save_copy&type=" . $type;
else $linkSave = "index.php?com=product&act=save&type=" . $type;
?>

<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><?= $labelAct ?> <?= $config['product'][$type]['title_main'] ?></li>
            </ol>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?= $linkSave ?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i
                    class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i
                    class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i
                    class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>



        <div class="row">
            <div class="col-xl-8">
                <?php
                if (isset($config['product'][$type]['slug']) && $config['product'][$type]['slug'] == true) {
                    $slugchange = ($act == 'edit') ? 1 : 0;
                    $copy = ($act != 'copy') ? 0 : 1;
                    include TEMPLATE . LAYOUT . "slug.php";
                }
                ?>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung <?= $config['product'][$type]['title_main'] ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body card-article">
                                <div class="form-group">
                                    <label for="name">Tiêu đề:</label>
                                    <input type="text" class="form-control for-seo text-sm" name="data[name]"
                                        id="namevi" placeholder="Tiêu đề"
                                        value="<?= (!empty($flash->has('name'))) ? $flash->get('name') : @$item['name'] ?>"
                                        required>
                                </div>
                                <?php if (isset($config['product'][$type]['desc']) && $config['product'][$type]['desc'] == true) { ?>
                                    <div class="form-group">
                                        <label for="desc">Mô tả:</label>
                                        <textarea
                                            class="form-control for-seo text-sm"
                                            name="data[desc]" id="desc" rows="5"
                                            placeholder="Mô tả"><?= $func->decodeHtmlChars($flash->get('desc')) ?: $func->decodeHtmlChars(@$item['desc']) ?></textarea>
                                    </div>
                                <?php } ?>
                                <?php if (isset($config['product'][$type]['content']) && $config['product'][$type]['content'] == true) { ?>
                                    <div class="form-group">
                                        <label for="content">Nội dung:</label>
                                        <textarea
                                            class="form-control for-seo text-sm <?= (isset($config['product'][$type]['content_cke']) && $config['product'][$type]['content_cke'] == true) ? 'form-control-ckeditor' : '' ?>"
                                            name="data[content]" id="content" rows="5"
                                            placeholder="Nội dung"><?= $func->decodeHtmlChars($flash->get('content')) ?: $func->decodeHtmlChars(@$item['content']) ?></textarea>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <?php if (
                    (isset($config['product'][$type]['dropdown']) && $config['product'][$type]['dropdown'] == true)
                ) { ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Danh mục <?= $config['product'][$type]['title_main'] ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group-category row">
                                <?php if (isset($config['product'][$type]['dropdown']) && $config['product'][$type]['dropdown'] == true) { ?>
                                    <?php if (isset($config['product'][$type]['list']) && $config['product'][$type]['list'] == true) { ?>
                                        <div class="form-group col-xl-6 col-sm-4">
                                            <label class="d-block" for="id_list">Danh mục cấp 1:</label>
                                            
                                        </div>
                                    <?php } ?>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if (isset($config['product'][$type]['images']) && $config['product'][$type]['images'] == true) { ?>
                    <div class="card card-primary card-outline text-sm">
                        <div class="card-header">
                            <h3 class="card-title">Hình ảnh <?= $config['product'][$type]['title_main'] ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            /* Photo detail */
                            $photoDetail = array();
                            $photoDetail['upload'] = '';
                            $photoDetail['image'] = (!empty($item) && $act != 'copy') ? UPLOAD_PRODUCT.$item['photo'] : '';
                            $photoDetail['dimension'] = "Width: " . $config['product'][$type]['width'] . " px - Height: " . $config['product'][$type]['height'] . " px (" . $config['product'][$type]['img_type'] . ")";
                            
                            /* Image */
                            include TEMPLATE . LAYOUT . "image.php";
                            ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thông tin <?= $config['product'][$type]['title_main'] ?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <?php $status_array = (!empty($item['status'])) ? explode(',', $item['status']) : array(); ?>
                    <?php if ($_GET['act'] == 'add') { ?>
                        <?php if (isset($config['product'][$type]['check'])) {
                            foreach ($config['product'][$type]['check'] as $key => $value) { ?>
                                <div class="form-group d-inline-block mb-2 mr-2">
                                    <label for="<?= $key ?>-checkbox"
                                        class="d-inline-block align-middle mb-0 mr-2"><?= $value ?>:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        <input type="checkbox" class="custom-control-input <?= $key ?>-checkbox"
                                            name="status[<?= $key ?>]" id="<?= $key ?>-checkbox" <?= ($key == 'hienthi') ? 'checked' : '' ?> value="<?= $key ?>">
                                        <label for="<?= $key ?>-checkbox" class="custom-control-label"></label>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    <?php } else { ?>
                        <?php if (isset($config['product'][$type]['check'])) {
                            foreach ($config['product'][$type]['check'] as $key => $value) { ?>
                                <div class="form-group d-inline-block mb-2 mr-2">
                                    <label for="<?= $key ?>-checkbox"
                                        class="d-inline-block align-middle mb-0 mr-2"><?= $value ?>:</label>
                                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                                        <input type="checkbox" class="custom-control-input <?= $key ?>-checkbox"
                                            name="status[<?= $key ?>]" id="<?= $key ?>-checkbox" <?= (empty($status_array) && empty($item['id']) ? 'checked' : in_array($key, $status_array)) ? 'checked' : '' ?>
                                            value="<?= $key ?>">
                                        <label for="<?= $key ?>-checkbox" class="custom-control-label"></label>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                    <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm"
                        min="0" name="data[numb]" id="numb" placeholder="Số thứ tự"
                        value="<?= isset($item['numb']) ? $item['numb'] : 1 ?>">
                </div>
                <div class="row">
                    <?php if (isset($config['product'][$type]['code']) && $config['product'][$type]['code'] == true) { ?>
                        <div class="form-group col-md-4">
                            <label class="d-block" for="code">Mã sản phẩm:</label>
                            <input type="text" class="form-control text-sm" name="data[code]" id="code"
                                placeholder="Mã sản phẩm"
                                value="<?= (!empty($flash->has('code'))) ? $flash->get('code') : @$item['code'] ?>">
                        </div>
                    <?php } ?>
                    <?php if (isset($config['product'][$type]['regular_price']) && $config['product'][$type]['regular_price'] == true) { ?>
                        <div class="form-group col-md-4">
                            <label class="d-block" for="regular_price">Giá bán:</label>
                            <div class="input-group">
                                <input type="text" class="form-control format-price regular_price text-sm"
                                    name="data[regular_price]" id="regular_price" placeholder="Giá bán"
                                    value="<?= (!empty($flash->has('regular_price'))) ? $flash->get('regular_price') : @$item['regular_price'] ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text"><strong>VNĐ</strong></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($config['product'][$type]['sale_price']) && $config['product'][$type]['sale_price'] == true) { ?>
                        <div class="form-group col-md-4">
                            <label class="d-block" for="sale_price">Giá mới:</label>
                            <div class="input-group">
                                <input type="text" class="form-control format-price sale_price text-sm"
                                    name="data[sale_price]" id="sale_price" placeholder="Giá mới"
                                    value="<?= (!empty($flash->has('sale_price'))) ? $flash->get('sale_price') : @$item['sale_price'] ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text"><strong>VNĐ</strong></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($config['product'][$type]['discount']) && $config['product'][$type]['discount'] == true) { ?>
                        <div class="form-group col-md-4">
                            <label class="d-block" for="discount">Chiết khấu:</label>
                            <div class="input-group">
                                <input type="text" class="form-control discount text-sm" name="data[discount]" id="discount"
                                    placeholder="Chiết khấu"
                                    value="<?= (!empty($flash->has('discount'))) ? $flash->get('discount') : @$item['discount'] ?>"
                                    maxlength="3" readonly>
                                <div class="input-group-append">
                                    <div class="input-group-text"><strong>%</strong></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>


        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i
                    class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i
                    class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i
                    class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?= (isset($item['id']) && $item['id'] > 0) ? $item['id'] : '' ?>">
        </div>
    </form>
</section>