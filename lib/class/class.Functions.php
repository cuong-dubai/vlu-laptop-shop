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