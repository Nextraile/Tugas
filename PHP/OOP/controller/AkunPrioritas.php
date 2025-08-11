<?php

// subclass akun prioritas
class AkunPrioritas extends AkunBank
{
    // constructor buat akun prioritas
    public function __construct($nama, $saldo)
    {
        // manggil constructor parent dengan parameternya ditambah status akun
        parent::__construct($nama, $saldo, "Prioritas");
    }

    // persentase diskon cashback
    private function persentaseCashback()
    {
        return $persentase = 5;
    }
    
    // override method deposit
    public function deposit($nominal)
    {
        $persentase = $this->persentaseCashback();

        // manggil method deposit parent
        $str1 = parent::deposit($nominal);

        // cashback 5% dari nominal deposit
        $str2 = $this->cashback($persentase, $nominal);

        return  $str = $str1 . "\n" . $str2;
    }

    public function withdraw($nominal)
    {
        $persentase = $this->persentaseCashback();

        // manggil method transfer parent
        $str1 = parent::withdraw($nominal);

        // cashback 5% dari nominal deposit
        $str2 = $this->cashback($persentase, $nominal);

        return $str = $str1 . "\n" . $str2;
    }

    public function transfer($subjek, $nominal)
    {
        $persentase = $this->persentaseCashback();

        // manggil method transfer parent
        $str1 = parent::transfer($subjek, $nominal);

        // cashback 5% dari nominal deposit
        $str2 = $this->cashback($persentase, $nominal);

        return  $str = $str1 . "\n" . $str2;
    }
}