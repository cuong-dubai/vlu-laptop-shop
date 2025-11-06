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
            for ($i = 0; $i < $sokytu; $i++) {
                $vitri = mt_rand(0, strlen($chuoi));
                $str = $str . substr($chuoi, $vitri, 1);
            }
        }

        return $str;
    }
}