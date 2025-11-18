<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!defined('SOURCES'))
    die("Error");

switch ($act) {
    case "man":
        viewNews();
        $template = "news/mans";
        break;
    case "add":
        $template = "news/man_add";
        break;
    case "edit":
        editNews();
        $template = "news/man_add";
        break;
    case "save":
        saveNews();
        break;
    case "delete":
        deleteNews();
        break;
    default:
        $template = "404";
        break;
}

/* View news list */
function viewNews()
{
    global $d, $func, $curPage, $items, $paging;
    
    $where = "";
    if (isset($_REQUEST['keyword'])) {
        $keyword = htmlspecialchars($_REQUEST['keyword']);
        $where = " and (name LIKE '%$keyword%' OR slug LIKE '%$keyword%')";
    }
    
    $perPage = 10;
    $startpoint = ($curPage * $perPage) - $perPage;
    $limit = " limit " . $startpoint . "," . $perPage;
    $sql = "select * from #_news where 1=1 $where order by date_created desc, id desc $limit";
    $items = $d->rawQuery($sql);
    $sqlNum = "select count(*) as 'num' from #_news where 1=1 $where";
    $count = $d->rawQueryOne($sqlNum);
    $total = (!empty($count)) ? $count['num'] : 0;
    $url = "index.php?com=news&act=man";
    if (isset($_REQUEST['keyword'])) {
        $url .= "&keyword=" . htmlspecialchars($_REQUEST['keyword']);
    }
    $paging = $func->pagination($total, $perPage, $curPage, $url);
}

/* Edit news */
function editNews()
{
    global $d, $func, $curPage, $item;
    
    if (!empty($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
    } else {
        $id = 0;
    }
    
    if (empty($id)) {
        $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&p=" . $curPage, false);
    } else {
        $item = $d->rawQueryOne("select * from #_news where id = ? limit 0,1", array($id));
        if (empty($item)) {
            $func->transfer("Dữ liệu không có thực", "index.php?com=news&act=man&p=" . $curPage, false);
        }
    }
}

/* Save news */
function saveNews()
{
    global $d, $func, $flash, $curPage, $configBase;
    
    $newsAdminController = new NewsAdminController($d, $func);
    
    if (empty($_POST)) {
        $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&p=" . $curPage, false);
    }
    
    $id = (!empty($_POST['id'])) ? (int)$_POST['id'] : 0;
    $data = (!empty($_POST['data'])) ? $_POST['data'] : null;
    
    if (!$data) {
        $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&p=" . $curPage, false);
    }
    
    // Xử lý dữ liệu
    foreach ($data as $column => $value) {
        if (strpos($column, 'content') !== false || strpos($column, 'desc') !== false) {
            $data[$column] = htmlspecialchars($func->sanitize($value, 'iframe'));
        } else {
            $data[$column] = htmlspecialchars($func->sanitize($value));
        }
    }
    
    // Xử lý slug
    if (!empty($_POST['slug'])) {
        $data['slug'] = $func->changeTitle(htmlspecialchars($_POST['slug']));
    } else {
        $data['slug'] = (!empty($data['name'])) ? $func->changeTitle($data['name']) : '';
    }
    
    // Xử lý status
    if (isset($_POST['status'])) {
        $status = '';
        foreach ($_POST['status'] as $attr_value) {
            if ($attr_value != "") {
                $status .= $attr_value . ',';
            }
        }
        $data['status'] = (!empty($status)) ? rtrim($status, ",") : "";
    } else {
        $data['status'] = "";
    }
    
    // Xử lý type
    $data['type'] = 'tin-tuc';
    
    // Xử lý upload ảnh
    if ($func->hasFile("file")) {
        $file_name = $func->uploadName($_FILES["file"]["name"]);
        if ($photo = $func->uploadImage("file", "jpg,png,gif,jpeg,webp", UPLOAD_PRODUCT, $file_name)) {
            if ($id > 0) {
                // Xóa ảnh cũ nếu có
                $row = $d->rawQueryOne("select id, photo from #_news where id = ? limit 0,1", array($id));
                if (!empty($row) && !empty($row['photo'])) {
                    $func->deleteFile(UPLOAD_PRODUCT . $row['photo']);
                }
            }
            $data['photo'] = $photo;
        }
    }
    
    // Validate
    if (empty($data['name'])) {
        $flash->set('message', base64_encode(json_encode([
            'status' => 'danger',
            'messages' => ['Tiêu đề không được trống']
        ])));
        foreach ($data as $k => $v) {
            $flash->set($k, $v);
        }
        if ($id > 0) {
            $func->redirect($configBase . ADMIN . "/index.php?com=news&act=edit&id=" . $id);
        } else {
            $func->redirect($configBase . ADMIN . "/index.php?com=news&act=add");
        }
        return;
    }
    
    // Lưu dữ liệu
    $result = $newsAdminController->saveNews($data, $id);
    
    if ($result['success']) {
        $savehere = (isset($_POST['save-here'])) ? true : false;
        if ($savehere && $result['id']) {
            $func->transfer($result['message'], "index.php?com=news&act=edit&id=" . $result['id']);
        } else {
            $func->transfer($result['message'], "index.php?com=news&act=man&p=" . $curPage);
        }
    } else {
        $flash->set('message', base64_encode(json_encode([
            'status' => 'danger',
            'messages' => [$result['message']]
        ])));
        foreach ($data as $k => $v) {
            $flash->set($k, $v);
        }
        if ($id > 0) {
            $func->redirect($configBase . ADMIN . "/index.php?com=news&act=edit&id=" . $id);
        } else {
            $func->redirect($configBase . ADMIN . "/index.php?com=news&act=add");
        }
    }
}

/* Delete news */
function deleteNews()
{
    global $d, $func, $curPage;
    
    $newsAdminController = new NewsAdminController($d, $func);
    
    $id = (!empty($_GET['id'])) ? (int)$_GET['id'] : 0;
    
    if ($id) {
        // Xóa ảnh trước khi xóa tin tức
        $row = $d->rawQueryOne("select id, photo from #_news where id = ? limit 0,1", array($id));
        if (!empty($row) && !empty($row['photo'])) {
            $func->deleteFile(UPLOAD_PRODUCT . $row['photo']);
        }
        
        $result = $newsAdminController->deleteNews($id);
        if ($result['success']) {
            $func->transfer($result['message'], "index.php?com=news&act=man&p=" . $curPage);
        } else {
            $func->transfer($result['message'], "index.php?com=news&act=man&p=" . $curPage, false);
        }
    } elseif (isset($_GET['listid'])) {
        $listid = explode(",", $_GET['listid']);
        $successCount = 0;
        
        for ($i = 0; $i < count($listid); $i++) {
            $id = (int)htmlspecialchars($listid[$i]);
            if ($id > 0) {
                // Xóa ảnh trước khi xóa tin tức
                $row = $d->rawQueryOne("select id, photo from #_news where id = ? limit 0,1", array($id));
                if (!empty($row) && !empty($row['photo'])) {
                    $func->deleteFile(UPLOAD_PRODUCT . $row['photo']);
                }
                
                $result = $newsAdminController->deleteNews($id);
                if ($result['success']) {
                    $successCount++;
                }
            }
        }
        
        if ($successCount > 0) {
            $func->transfer("Xóa dữ liệu thành công", "index.php?com=news&act=man&p=" . $curPage);
        } else {
            $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man&p=" . $curPage, false);
        }
    } else {
        $func->transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&p=" . $curPage, false);
    }
}

