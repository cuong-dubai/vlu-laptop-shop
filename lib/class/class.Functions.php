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

    public function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
}