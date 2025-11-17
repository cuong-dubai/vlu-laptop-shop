<?php

class Functions
{
    private $d;
    private $hash;

    function __construct($d)
    {
        $this->d = $d;
    }
    public function stringRandom($sokytu = 10)
    {
        $str = '';

        if ($sokytu > 0) {
            $chuoi = 'ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789';
            $chuoiLength = strlen($chuoi);
            for ($i = 0; $i < $sokytu; $i++) {
                $vitri = mt_rand(0, $chuoiLength - 1);
                $str = $str . substr($chuoi, $vitri, 1);
            }
        }

        return $str;
    }
    public function checkSlug($data = array())
    {
        $result = 'valid';
        if (isset($data['slug'])) {
            $slug = trim($data['slug']);
            if (!empty($slug)) {
                $table = array(
                    "categories",
                    "brand",
                    "product",
                );
                $where = (!empty($data['id']) && empty($data['copy'])) ? "id != " . $data['id'] . " and " : "";
                foreach ($table as $v) {
                    $check = $this->d->rawQueryOne("select id from $v where $where slug = ? limit 0,1", array($data['slug']));
                    if (!empty($check['id'])) {
                        $result = 'exist';
                        break;
                    }
                }
            } else {
                $result = 'empty';
            }
        }
        return $result;
    }
    public function generateHash()
    {
        if (!$this->hash) {
            $this->hash = $this->stringRandom(10);
        }
        return $this->hash;
    }
    public function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
    public function checkLoginAdmin()
    {
        global $loginAdmin;

        $token = (!empty($_SESSION[$loginAdmin]['token'])) ? $_SESSION[$loginAdmin]['token'] : '';
        $row = $this->d->rawQuery("select secret_key from #_user where secret_key = ? and find_in_set('hienthi',status)", array($token));

        if (count($row) == 1 && $row[0]['secret_key'] != '') {
            return true;
        } else {
            if (!empty($_SESSION[TOKEN]))
                unset($_SESSION[TOKEN]);
            unset($_SESSION[$loginAdmin]);
            return false;
        }
    }
    public function encryptPassword($secret = '', $str = '', $salt = '')
    {
        return md5($secret . $str . $salt);
    }
    public function transfer($msg = '', $page = '', $numb = true)
    {
        global $configBase;
        $basehref = $configBase;
        $showtext = $msg;
        $page_transfer = $page;
        $numb = $numb;
        include("./templates/layout/transfer.php");
        exit();
    }
    public function joinCols($array = null, $column = null)
    {
        $str = '';
        $arrayTemp = array();
        if ($array && $column) {
            foreach ($array as $k => $v) {
                if (!empty($v[$column])) {
                    $arrayTemp[] = $v[$column];
                }
            }
            if (!empty($arrayTemp)) {
                $arrayTemp = array_unique($arrayTemp);
                $str = implode(",", $arrayTemp);
            }
        }
        return $str;
    }
    public function uploadName($name = '')
    {
        $result = '';
        if ($name != '') {
            $rand = rand(1000, 9999);
            $ten_anh = pathinfo($name, PATHINFO_FILENAME);
            $result = $this->changeTitle($ten_anh) . "-" . $rand;
        }
        return $result;
    }
    public function isNumber($numbs)
    {
        if (preg_match('/^[0-9]+$/', $numbs)) {
            return true;
        } else {
            return false;
        }
    }
    /* Alert */
    public function alert($notify = '')
    {
        echo '<script language="javascript">alert("' . $notify . '")</script>';
    }
    /* Has file */
    public function hasFile($file)
    {
        if (isset($_FILES[$file])) {
            if ($_FILES[$file]['error'] == 4) {
                return false;
            } else if ($_FILES[$file]['error'] == 0) {
                return true;
            }
        } else {
            return false;
        }
    }
    /* Size file */
    public function sizeFile($file)
    {
        if ($this->hasFile($file)) {
            if ($_FILES[$file]['error'] == 0) {
                return $_FILES[$file]['size'];
            }
        } else {
            return 0;
        }
    }
    /* Check file */
    public function checkFile($file)
    {
        global $config;
        $result = true;
        if ($this->hasFile($file)) {
            if ($this->sizeFile($file) > $config['website']['video']['max-size']) {
                $result = false;
            }
        }
        return $result;
    }
    /* Check extension file */
    public function checkExtFile($file)
    {
        global $config;
        $result = true;
        if ($this->hasFile($file)) {
            $ext = $this->infoPath($_FILES[$file]["name"], 'extension');
            if (!in_array($ext, $config['website']['video']['extension'])) {
                $result = false;
            }
        }
        return $result;
    }
    /* Kiểm tra dữ liệu nhập vào */
    public function cleanInput($input = '', $type = '')
    {
        $output = '';
        if ($input != '') {
            /*
                    // Loại bỏ HTML tags
                    '@<[\/\!]*?[^<>]*?>@si',
                */
            $search = array(
                'script' => '@<script[^>]*?>.*?</script>@si',
                'style' => '@<style[^>]*?>.*?</style>@siU',
                'blank' => '@<![\s\S]*?--[ \t\n\r]*>@',
                'iframe' => '/<iframe(.*?)<\/iframe>/is',
                'title' => '/<title(.*?)<\/title>/is',
                'pre' => '/<pre(.*?)<\/pre>/is',
                'frame' => '/<frame(.*?)<\/frame>/is',
                'frameset' => '/<frameset(.*?)<\/frameset>/is',
                'object' => '/<object(.*?)<\/object>/is',
                'embed' => '/<embed(.*?)<\/embed>/is',
                'applet' => '/<applet(.*?)<\/applet>/is',
                'meta' => '/<meta(.*?)<\/meta>/is',
                'doctype' => '/<!doctype(.*?)>/is',
                'link' => '/<link(.*?)>/is',
                'body' => '/<body(.*?)<\/body>/is',
                'html' => '/<html(.*?)<\/html>/is',
                'head' => '/<head(.*?)<\/head>/is',
                'onclick' => '/onclick="(.*?)"/is',
                'ondbclick' => '/ondbclick="(.*?)"/is',
                'onchange' => '/onchange="(.*?)"/is',
                'onmouseover' => '/onmouseover="(.*?)"/is',
                'onmouseout' => '/onmouseout="(.*?)"/is',
                'onmouseenter' => '/onmouseenter="(.*?)"/is',
                'onmouseleave' => '/onmouseleave="(.*?)"/is',
                'onmousemove' => '/onmousemove="(.*?)"/is',
                'onkeydown' => '/onkeydown="(.*?)"/is',
                'onload' => '/onload="(.*?)"/is',
                'onunload' => '/onunload="(.*?)"/is',
                'onkeyup' => '/onkeyup="(.*?)"/is',
                'onkeypress' => '/onkeypress="(.*?)"/is',
                'onblur' => '/onblur="(.*?)"/is',
                'oncopy' => '/oncopy="(.*?)"/is',
                'oncut' => '/oncut="(.*?)"/is',
                'onpaste' => '/onpaste="(.*?)"/is',
                'php-tag' => '/<(\?|\%)\=?(php)?/',
                'php-short-tag' => '/(\%|\?)>/'
            );
            if (!empty($type)) {
                unset($search[$type]);
            }
            $output = preg_replace($search, '', $input);
        }
        return $output;
    }
    /* Check title */
    public function checkTitle($data = array())
    {
        global $config;
        $result = array();
        foreach ($config['website']['lang'] as $k => $v) {
            if (isset($data['name' . $k])) {
                $title = trim($data['name' . $k]);
                if (empty($title)) {
                    $result[] = 'Tiêu đề (' . $v . ') không được trống';
                }
            }
        }
        return $result;
    }
    /* Kiểm tra dữ liệu nhập vào */
    public function sanitize($input = '', $type = '')
    {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = $this->sanitize($val, $type);
            }
        } else {
            $output = $this->cleanInput($input, $type);
        }
        return $output;
    }
    /* Info path */
    public function infoPath($filename = '', $type = '')
    {
        $result = '';
        if (!empty($filename) && !empty($type)) {
            if ($type == 'extension') {
                $result = pathinfo($filename, PATHINFO_EXTENSION);
            } else if ($type == 'filename') {
                $result = pathinfo($filename, PATHINFO_FILENAME);
            }
        }
        return $result;
    }
    /* Format bytes */
    public function formatBytes($size, $precision = 2)
    {
        $result = array();
        $base = log($size, 1024);
        $suffixes = array('', 'Kb', 'Mb', 'Gb', 'Tb');
        $result['numb'] = round(pow(1024, $base - floor($base)), $precision);
        $result['ext'] = $suffixes[floor($base)];
        return $result;
    }
    public function deleteFile($file = '')
    {
        return @unlink($file);
    }
    public function uploadImage($file = '', $extension = '', $folder = '', $newname = '')
    {
        global $config;
        if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {
            $postMaxSize = ini_get('post_max_size');
            $MaxSize = explode('M', $postMaxSize);
            $MaxSize = $MaxSize[0];
            if ($_FILES[$file]['size'] > $MaxSize * 1048576) {
                $this->alert('Dung lượng file không được vượt quá ' . $postMaxSize);
                return false;
            }
            $ext = explode('.', $_FILES[$file]['name']);
            $ext = strtolower($ext[count($ext) - 1]);
            $name = basename($_FILES[$file]['name'], '.' . $ext);
            if (strpos($extension, $ext) === false) {
                $this->alert('Chỉ hỗ trợ upload file dạng ' . $extension);
                return false;
            }
            if ($newname == '' && file_exists($folder . $_FILES[$file]['name']))
                for ($i = 0; $i < 100; $i++) {
                    if (!file_exists($folder . $name . $i . '.' . $ext)) {
                        $_FILES[$file]['name'] = $name . $i . '.' . $ext;
                        break;
                    }
                } else {
                $_FILES[$file]['name'] = $newname . '.' . $ext;
            }
            if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                    return false;
                }
            }

            return $_FILES[$file]['name'];
        }
        return false;
    }
    public function getAjaxCategory($table = '', $level = '', $type = '', $title_select = 'Chọn danh mục', $class_select = 'select-category')
    {
        $where = '';
        $params = array($type);
        $id_parent = 'id_' . $level;
        $data_level = '';
        $data_type = 'data-type="' . $type . '"';
        $data_table = '';
        $data_child = '';
        if ($level == 'list') {
            $data_level = 'data-level="0"';
            $data_table = 'data-table="#_' . $table . '_cat"';
            $data_child = 'data-child="id_cat"';
        } else if ($level == 'brand') {
            $data_level = '';
            $data_type = '';
            $class_select = '';
        }
        $rows = $this->d->rawQuery("select name, id from #_" . $table . " where type = ? " . $where . " order by numb,id desc", $params);
        $str = '<select id="' . $id_parent . '" name="data[' . $id_parent . ']" ' . $data_level . ' ' . $data_type . ' ' . $data_table . ' ' . $data_child . ' class="form-control select2 ' . $class_select . '"><option value="0">' . $title_select . '</option>';
        foreach ($rows as $v) {
            if (isset($_REQUEST[$id_parent]) && ($v["id"] == (int) $_REQUEST[$id_parent]))
                $selected = "selected";
            else
                $selected = "";
            $str .= '<option value=' . $v["id"] . ' ' . $selected . '>' . $v["name"] . '</option>';
        }
        $str .= '</select>';
        return $str;
    }
    /* UTF8 convert */
    public function utf8Convert($str = '')
    {
        if ($str != '') {
            $utf8 = array(
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'd' => 'đ|Đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                '' => '`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\“|\”|\:|\;|_',
            );
            foreach ($utf8 as $ascii => $uni) {
                $str = preg_replace("/($uni)/i", $ascii, $str);
            }
        }
        return $str;
    }
    public function changeTitle($text = '')
    {
        if ($text != '') {
            $text = strtolower($this->utf8Convert($text));
            $text = preg_replace("/[^a-z0-9-\s]/", "", $text);
            $text = preg_replace('/([\s]+)/', '-', $text);
            $text = str_replace(array('%20', ' '), '-', $text);
            $text = preg_replace("/\-\-\-\-\-/", "-", $text);
            $text = preg_replace("/\-\-\-\-/", "-", $text);
            $text = preg_replace("/\-\-\-/", "-", $text);
            $text = preg_replace("/\-\-/", "-", $text);
            $text = '@' . $text . '@';
            $text = preg_replace('/\@\-|\-\@|\@/', '', $text);
        }
        return $text;
    }
    public function getCurrentPageURL()
    {
        $pageURL = 'http';
        if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on")
            $pageURL .= "s";
        $pageURL .= "://";
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        $urlpos = strpos($pageURL, "?p");
        $pageURL = ($urlpos) ? explode("?p=", $pageURL) : explode("&p=", $pageURL);
        return $pageURL[0];
    }
    public function decodeHtmlChars($htmlChars)
    {
        return htmlspecialchars_decode($htmlChars ?: '');
    }
    public function pagination($totalq = 0, $perPage = 10, $page = 1, $url = '?')
    {
        $urlpos = strpos($url, "?");
        $url = ($urlpos) ? $url . "&" : $url . "?";
        $total = $totalq;
        $adjacents = "2";
        $firstlabel = "First";
        $prevlabel = "Prev";
        $nextlabel = "Next";
        $lastlabel = "Last";
        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $perPage;
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($total / $perPage);
        $lpm1 = $lastpage - 1;
        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<ul class='pagination flex-wrap justify-content-center mb-0'>";
            $pagination .= "<li class='page-item'><a class='page-link'>Page {$page} / {$lastpage}</a></li>";
            if ($page > 1) {
                $pagination .= "<li class='page-item'><a class='page-link' href='{$this->getCurrentPageURL()}'>{$firstlabel}</a></li>";
                $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$prev}'>{$prevlabel}</a></li>";
            }
            if ($lastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
                    else
                        $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$counter}'>{$counter}</a></li>";
                }
            } elseif ($lastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
                        else
                            $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$counter}'>{$counter}</a></li>";
                    }
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=1'>...</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$lpm1}'>{$lpm1}</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$lastpage}'>{$lastpage}</a></li>";
                } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=1'>1</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=2'>2</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=1'>...</a></li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
                        else
                            $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$counter}'>{$counter}</a></li>";
                    }
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=1'>...</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$lpm1}'>{$lpm1}</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$lastpage}'>{$lastpage}</a></li>";
                } else {
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=1'>1</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=2'>2</a></li>";
                    $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=1'>...</a></li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination .= "<li class='page-item active'><a class='page-link'>{$counter}</a></li>";
                        else
                            $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$counter}'>{$counter}</a></li>";
                    }
                }
            }
            if ($page < $counter - 1) {
                $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p={$next}'>{$nextlabel}</a></li>";
                $pagination .= "<li class='page-item'><a class='page-link' href='{$url}p=$lastpage'>{$lastlabel}</a></li>";
            }
            $pagination .= "</ul>";
        }
        return $pagination;
    }
    /* Format money */
    public function formatMoney($price = 0, $unit = 'đ', $html = false)
    {
        $str = '';
        if ($price) {
            $str .= number_format($price, 0, ',', '.');
            if ($unit != '') {
                if ($html) {
                    $str .= '<span>' . $unit . '</span>';
                } else {
                    $str .= $unit;
                }
            }
        }
        return $str;
    }
    public function GetProducts($arr = array(), $class = '', $checkHot = true)
    {
        global $lang;
        if ($class != '') { ?>
            <div class="<?= $class ?>">
            <?php }
        foreach ($arr as $k => $v) { ?>
                <div class="product">
                    <a class="box-product text-decoration-none" href="<?= $v['slug'] ?>" title="<?= $v['name'] ?>">
                        <p class="pic-product scale-img">
                            <img src="<?= UPLOAD_PRODUCT_L . $v['photo'] ?>" width="300" height="300"
                                onerror="this.src='extensions/images/noimage.png'" class="" alt="<?= $v['name'] ?>">
                        </p>
                        <div class="product_content">
                            <div class="product__info__more">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="9" height="8" viewBox="0 0 9 8" fill="none">
                                        <path
                                            d="M1.52861 7.54423C1.61032 7.2057 1.68966 6.86718 1.77256 6.52976C1.88033 6.09121 1.98572 5.65267 2.10059 5.21523C2.12783 5.11302 2.08638 5.05586 2.00941 4.99321C1.409 4.50851 0.81215 4.01831 0.211745 3.53361C0.0423999 3.39732 -0.0464173 3.23905 0.0246365 3.03022C0.094506 2.82359 0.256746 2.73236 0.484118 2.71478C1.24203 2.65433 1.99875 2.58399 2.75547 2.52793C2.9485 2.51364 3.061 2.45869 3.13916 2.27734C3.42101 1.62887 3.72891 0.99029 4.02023 0.345118C4.1126 0.140685 4.25234 0 4.49984 0C4.74735 0 4.8859 0.141784 4.97827 0.345118C5.2838 1.01997 5.59762 1.69152 5.90315 2.36636C5.94342 2.45649 5.99434 2.50045 6.10447 2.50815C6.82093 2.5653 7.53739 2.62795 8.25385 2.6895C8.34741 2.69719 8.43978 2.71038 8.53333 2.71588C8.75597 2.73017 8.90755 2.83238 8.97505 3.03022C9.04136 3.22366 8.9715 3.38193 8.81281 3.51163C8.23609 3.98094 7.66529 4.45685 7.0791 4.91518C6.91804 5.04157 6.87659 5.15368 6.92633 5.34273C7.10633 6.02197 7.2662 6.70451 7.43436 7.38595C7.48529 7.59149 7.46279 7.77724 7.2662 7.91133C7.07081 8.04432 6.87541 8.01574 6.67764 7.90473C5.99671 7.52334 5.31104 7.14855 4.63248 6.76496C4.533 6.70891 4.46432 6.71111 4.36602 6.76606C3.68036 7.15185 2.99232 7.53214 2.3031 7.91133C2.04493 8.05421 1.7844 8.01574 1.63164 7.8212C1.56769 7.73987 1.53216 7.64974 1.52861 7.54423Z"
                                            fill="#FAC027" />
                                    </svg>
                                    5.0 <b>(10 đánh giá)</b></span>
                            </div>
                            <h3 class="name-product text-split"><?= $v['name' . $lang] ?></h3>
                            <?php
                            if ($checkHot) { ?>
                                <div class="checkHot">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="58" height="27" viewBox="0 0 58 27" fill="none">
                                        <path
                                            d="M58 9.82105C58 15.2458 53.7043 19.6421 48.4069 19.6421H2.82309C1.54096 19.6421 0.398317 20.4865 0.0107291 21.7373C0.00268227 21.762 0 21.7744 0 21.7744V1.87414C0 0.838902 0.819433 0 1.82931 0H48.4069C51.0556 0 53.4536 1.09977 55.1903 2.87643C56.9257 4.65446 58 7.10938 58 9.82105Z"
                                            fill="#EC1C24" />
                                        <path
                                            d="M3.91209 19.6421V27C0.00804673 25.6188 0 21.7744 0 21.7744C0 21.7744 0.00268227 21.762 0.0107291 21.7373C0.398317 20.4865 1.54096 19.6421 2.82309 19.6421H3.91209Z"
                                            fill="#6B000E" />
                                        <path
                                            d="M21.8269 8.07182V9.53523H16.4134V8.07182H21.8269ZM16.9435 4V13.8645H15V4H16.9435ZM23.2686 4V13.8645H21.3251V4H23.2686Z"
                                            fill="white" />
                                        <path
                                            d="M24.7739 10.2737V10.1314C24.7739 9.59395 24.8539 9.09937 25.0141 8.6477C25.1743 8.19151 25.4075 7.7963 25.7138 7.46206C26.02 7.12782 26.3946 6.86811 26.8375 6.68293C27.2803 6.49323 27.7845 6.39837 28.3498 6.39837C28.9246 6.39837 29.4335 6.49323 29.8763 6.68293C30.3239 6.86811 30.7008 7.12782 31.0071 7.46206C31.3133 7.7963 31.5465 8.19151 31.7067 8.6477C31.8669 9.09937 31.947 9.59395 31.947 10.1314V10.2737C31.947 10.8067 31.8669 11.3013 31.7067 11.7575C31.5465 12.2091 31.3133 12.6043 31.0071 12.9431C30.7008 13.2773 30.3263 13.537 29.8834 13.7222C29.4405 13.9074 28.934 14 28.364 14C27.7986 14 27.2921 13.9074 26.8445 13.7222C26.3969 13.537 26.02 13.2773 25.7138 12.9431C25.4075 12.6043 25.1743 12.2091 25.0141 11.7575C24.8539 11.3013 24.7739 10.8067 24.7739 10.2737ZM26.6396 10.1314V10.2737C26.6396 10.5944 26.6726 10.8948 26.7385 11.1748C26.8045 11.4548 26.9058 11.701 27.0424 11.9133C27.179 12.1256 27.3557 12.2927 27.5724 12.4146C27.7939 12.5321 28.0577 12.5908 28.364 12.5908C28.6655 12.5908 28.9246 12.5321 29.1413 12.4146C29.3581 12.2927 29.5347 12.1256 29.6714 11.9133C29.8127 11.701 29.9164 11.4548 29.9823 11.1748C30.0483 10.8948 30.0813 10.5944 30.0813 10.2737V10.1314C30.0813 9.81527 30.0483 9.51942 29.9823 9.2439C29.9164 8.96387 29.8127 8.71771 29.6714 8.50542C29.5347 8.28862 29.3557 8.11924 29.1343 7.99729C28.9176 7.87082 28.6561 7.80759 28.3498 7.80759C28.0483 7.80759 27.7892 7.87082 27.5724 7.99729C27.3557 8.11924 27.179 8.28862 27.0424 8.50542C26.9058 8.71771 26.8045 8.96387 26.7385 9.2439C26.6726 9.51942 26.6396 9.81527 26.6396 10.1314Z"
                                            fill="white" />
                                        <path
                                            d="M36.9223 6.53388V7.82114H32.5406V6.53388H36.9223ZM33.7138 4.73171H35.5866V11.7507C35.5866 11.9675 35.6172 12.1346 35.6784 12.252C35.7397 12.3695 35.8316 12.4485 35.9541 12.4892C36.0766 12.5298 36.2226 12.5501 36.3922 12.5501C36.5147 12.5501 36.6278 12.5434 36.7314 12.5298C36.8351 12.5163 36.9223 12.5027 36.9929 12.4892L37 13.8306C36.8445 13.8803 36.6678 13.921 36.47 13.9526C36.2768 13.9842 36.0577 14 35.8127 14C35.3934 14 35.0259 13.9322 34.7102 13.7967C34.3946 13.6567 34.1496 13.4332 33.9753 13.126C33.8009 12.8144 33.7138 12.4033 33.7138 11.893V4.73171Z"
                                            fill="white" />
                                    </svg>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <div class="group__price_cart">
                            <p class="price-product">

                                <?php if ($v['discount']) { ?>
                                    <span class="price-old"><?= $this->formatMoney($v['regular_price']) ?></span>
                                    <span class="price-new"><?= $this->formatMoney($v['sale_price']) ?></span>
                                    <!-- <span class="price-per"><?= '-' . $v['discount'] . '%' ?></span> -->
                                <?php } else { ?>
                                    <span
                                        class="price-new"><?= ($v['regular_price']) ? $this->formatMoney($v['regular_price']) : 'Liên hệ' ?></span>
                                <?php } ?>
                            </p>
                            <p class="view-detail w-clear">
                                <span>
                                    Xem chi tiết <svg xmlns="http://www.w3.org/2000/svg" width="14" height="7" viewBox="0 0 14 7"
                                        fill="none">
                                        <path
                                            d="M12.1123 4.06465C12.0096 4.06465 11.9449 4.06465 11.8806 4.06465C8.1634 4.06465 4.44655 4.06465 0.729393 4.06433C0.651301 4.06433 0.572897 4.06659 0.49543 4.05884C0.209302 4.03143 -0.00216976 3.78857 1.68015e-05 3.49475C0.00220337 3.20093 0.215862 2.96356 0.504176 2.93872C0.576645 2.93259 0.649739 2.93453 0.722521 2.93453C4.43437 2.93421 8.14622 2.93453 11.8581 2.93453C11.9293 2.93453 12.0002 2.93453 12.0714 2.93453C12.0858 2.91389 12.0998 2.89324 12.1142 2.8726C12.0636 2.83842 12.0058 2.81165 11.9637 2.76843C11.383 2.17434 10.8038 1.57896 10.226 0.981971C10.037 0.786522 9.99543 0.529148 10.1085 0.303059C10.2216 0.0776153 10.4506 -0.0446211 10.697 0.0150457C10.7979 0.0395575 10.9054 0.0966442 10.9788 0.17147C11.9318 1.1413 12.8811 2.115 13.8266 3.09256C14.0734 3.34768 14.0531 3.67698 13.7891 3.94886C13.0001 4.76098 12.2092 5.57148 11.4192 6.38263C11.2789 6.52679 11.1409 6.67322 10.9981 6.81449C10.7542 7.05606 10.4212 7.06154 10.2041 6.8319C9.98606 6.60098 9.99575 6.25587 10.2325 6.01108C10.8101 5.41409 11.3898 4.81903 11.9687 4.22301C12.0077 4.18269 12.0439 4.14012 12.1123 4.06465Z"
                                            fill="white" />
                                    </svg>
                                </span>
                            </p>
                        </div>

                    </a>

                </div>
            <?php }
        if ($class != '') { ?>
            </div>
        <?php }
    }
     /* Check account */
    public function checkAccount($data = '', $type = '', $tbl = '', $id = 0)
    {
        $result = false;
        $row = array();
        if (!empty($data) && !empty($type) && !empty($tbl)) {
            $where = (!empty($id)) ? ' and id != ' . $id : '';
            $row = $this->d->rawQueryOne("select id from #_$tbl where $type = ? $where limit 0,1", array($data));
            if (!empty($row)) {
                $result = true;
            }
        }
        return $result;
    }
     public function isPhone($number)
    {
        $number = trim($number);
        if (preg_match_all('/^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/m', $number, $matches, PREG_SET_ORDER, 0)) {
            return true;
        } else {
            return false;
        }
    }
    /* Format phone */
    public function formatPhone($number, $dash = ' ')
    {
        if (preg_match('/^(\d{4})(\d{3})(\d{3})$/', $number, $matches) || preg_match('/^(\d{3})(\d{4})(\d{4})$/', $number, $matches)) {
            return $matches[1] . $dash . $matches[2] . $dash . $matches[3];
        }
    }
    /* Parse phone */
    public function parsePhone($number)
    {
        return (!empty($number)) ? preg_replace('/[^0-9]/', '', $number) : '';
    }
    /* Check letters and nums */
    public function isAlphaNum($str)
    {
        if (preg_match('/^[a-z0-9]+$/', $str)) {
            return true;
        } else {
            return false;
        }
    }
    /* Is email */
    public function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    /* Is match */
    public function isMatch($value1, $value2)
    {
        if ($value1 == $value2) {
            return true;
        } else {
            return false;
        }
    }
}