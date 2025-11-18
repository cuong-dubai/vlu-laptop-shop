<?php
$linkMan = $linkFilter = "index.php?com=news&act=man";
$linkAdd = "index.php?com=news&act=add";
$linkEdit = "index.php?com=news&act=edit";
$linkDelete = "index.php?com=news&act=delete";
?>
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý tin tức</li>
            </ol>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
        <a class="btn btn-sm bg-gradient-primary text-white" href="<?= $linkAdd ?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?= $linkDelete ?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <div class="form-inline form-search d-inline-block align-middle ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?= (isset($_GET['keyword'])) ? $_GET['keyword'] : '' ?>" onkeypress="doEnter(event,'keyword','<?= $linkMan ?>')">
                <div class="input-group-append bg-primary rounded-right">
                    <button class="btn btn-navbar text-white" type="button" onclick="onSearch('keyword','<?= $linkMan ?>')">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách tin tức</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="align-middle" width="5%">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label for="selectall-checkbox" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="align-middle text-center" width="10%">STT</th>
                        <th class="align-middle">Hình</th>
                        <th class="align-middle" style="width:30%">Tiêu đề</th>
                        <th class="align-middle">Mô tả</th>
                        <th class="align-middle text-center">Hiển thị</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                </thead>
                <?php if (empty($items)) { ?>
                    <tbody>
                        <tr>
                            <td colspan="100" class="text-center">Không có dữ liệu</td>
                        </tr>
                    </tbody>
                <?php } else { ?>
                    <tbody>
                        <?php for ($i = 0; $i < count($items); $i++) { ?>
                            <tr>
                                <td class="align-middle">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?= $items[$i]['id'] ?>" value="<?= $items[$i]['id'] ?>">
                                        <label for="select-checkbox-<?= $items[$i]['id'] ?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input type="number" class="form-control form-control-mini m-auto update-numb" min="0" value="<?= $items[$i]['numb'] ?>" data-id="<?= $items[$i]['id'] ?>" data-table="news">
                                </td>
                                <td class="align-middle">
                                    <a href="<?= $linkEdit ?>&id=<?= $items[$i]['id'] ?>" title="<?= $items[$i]['name'] ?>">
                                        <img src="<?= UPLOAD_PRODUCT . $items[$i]['photo'] ?>" onerror="this.src='extensions/images/noimage.png'" class="rounded img-preview" alt="" width="50" height="50">
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark text-break" href="<?= $linkEdit ?>&id=<?= $items[$i]['id'] ?>" title="<?= $items[$i]['name'] ?>"><?= $items[$i]['name'] ?></a>
                                </td>
                                <td class="align-middle">
                                    <span class="text-break"><?= mb_substr($items[$i]['desc'] ?? '', 0, 100) ?><?= (mb_strlen($items[$i]['desc'] ?? '') > 100) ? '...' : '' ?></span>
                                </td>
                                <?php $status_array = (!empty($items[$i]['status'])) ? explode(',', $items[$i]['status']) : array(); ?>
                                <td class="align-middle text-center">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-hienthi-<?= $items[$i]['id'] ?>" data-table="news" data-id="<?= $items[$i]['id'] ?>" data-attr="hienthi" <?= (in_array('hienthi', $status_array)) ? 'checked' : '' ?>>
                                        <label for="show-checkbox-hienthi-<?= $items[$i]['id'] ?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <a class="text-primary mr-2" href="<?= $linkEdit ?>&id=<?= $items[$i]['id'] ?>" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="text-danger" id="delete-item" data-url="<?= $linkDelete ?>&id=<?= $items[$i]['id'] ?>" title="Xóa">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
        <div class="card-footer text-sm">
            <?= $paging ?>
        </div>
    </div>
</section>

