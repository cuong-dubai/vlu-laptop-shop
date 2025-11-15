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
}