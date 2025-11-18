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
}