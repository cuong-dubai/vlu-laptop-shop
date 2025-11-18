<?php
if ($act == "add")
    $labelAct = "Thêm mới";
else if ($act == "edit")
    $labelAct = "Chỉnh sửa";

$linkMan = "index.php?com=news&act=man";
if ($act == 'add')
    $linkFilter = "index.php?com=news&act=add";
else if ($act == 'edit')
    $linkFilter = "index.php?com=news&act=edit&id=" . $id;
$linkSave = "index.php?com=news&act=save";
?>

<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><?= $labelAct ?> tin tức</li>
            </ol>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?= $linkSave ?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>

        <?= $flash->getMessages('admin') ?>

        <div class="row">
            <div class="col-xl-8">
                <?php
                $slugchange = ($act == 'edit') ? 1 : 0;
                include TEMPLATE . LAYOUT . "slug.php";
                ?>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung tin tức</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body card-article">
                                <div class="form-group">
                                    <label for="name">Tiêu đề: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control for-seo text-sm" name="data[name]" id="name" placeholder="Tiêu đề" value="<?= (!empty($flash->has('name'))) ? $flash->get('name') : @$item['name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="desc">Mô tả:</label>
                                    <textarea class="form-control for-seo text-sm" name="data[desc]" id="desc" rows="5" placeholder="Mô tả ngắn"><?= $func->decodeHtmlChars($flash->get('desc')) ?: $func->decodeHtmlChars(@$item['desc']) ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung:</label>
                                    <textarea class="form-control for-seo text-sm form-control-ckeditor" name="data[content]" id="content" rows="10" placeholder="Nội dung chi tiết"><?= $func->decodeHtmlChars($flash->get('content')) ?: $func->decodeHtmlChars(@$item['content']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $photoDetail = array();
                        $photoDetail['upload'] = '';
                        $photoDetail['image'] = (!empty($item) && $act != 'copy') ? UPLOAD_PRODUCT . $item['photo'] : '';
                        $photoDetail['dimension'] = "Width: 800 px - Height: 600 px (jpg, png, gif)";
                        include TEMPLATE . LAYOUT . "image.php";
                        ?>
                    </div>
                </div>

                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin tin tức</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <?php $status_array = (!empty($item['status'])) ? explode(',', $item['status']) : array(); ?>
                            <div class="form-group d-inline-block mb-2 mr-2">
                                <label for="hienthi-checkbox" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                                <div class="custom-control custom-checkbox d-inline-block align-middle">
                                    <input type="checkbox" class="custom-control-input hienthi-checkbox" name="status[hienthi]" id="hienthi-checkbox" <?= (empty($status_array) && empty($item['id']) ? 'checked' : in_array('hienthi', $status_array)) ? 'checked' : '' ?> value="hienthi">
                                    <label for="hienthi-checkbox" class="custom-control-label"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                            <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="data[numb]" id="numb" placeholder="Số thứ tự" value="<?= isset($item['numb']) ? $item['numb'] : 1 ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?= (isset($item['id']) && $item['id'] > 0) ? $item['id'] : '' ?>">
        </div>
    </form>
</section>

