<?php

// subclass akun reguler
class akunReguler extends akunBank
{
    // constructor buat akun reguler
    public function __construct($nama, $saldo)
    {
        // manggil constructor parent dengan parameternya ditambah status akun
        parent::__construct($nama, $saldo, "Reguler");
    }

    // override method deposit
    public function deposit($nominal)
    {
        $persentase = 2;
        $cashback = $persentase / 100 * $nominal;

        // manggil method deposit parent
        $str1 = parent::deposit($nominal);

        if ($cashback)
        {
        $this->tambahSaldo($cashback);
            $str2 = "Cashback sebesar Rp " . number_format($cashback) . " berhasil ditambahkan ke dalam saldo" .
                    "\nSaldo saat ini: Rp " . number_format($this->getSaldo());
        }
        else
        {
            $str2 = "Tidak ada cashback";
        }

        return  $str = $str1 . "\n" . $str2;
    }

    public function withdraw($nominal)
    {
        $persentase = 2;
        $cashback = $persentase / 100 * $nominal;

        // manggil method transfer parent
        $str1 = parent::withdraw($nominal);

        if ($cashback)
        {
        $this->tambahSaldo($cashback);
            $str2 = "Cashback sebesar Rp " . number_format($cashback) . " berhasil ditambahkan ke dalam saldo" .
                    "\nSaldo saat ini: Rp " . number_format($this->getSaldo());
        }
        else
        {
            $str2 = "Tidak ada cashback";
        }

        return  $str = $str1 . "\n" . $str2;
    }

    public function transfer($subjek, $nominal)
    {
        $persentase = 2;
        $cashback = $persentase / 100 * $nominal;

        // manggil method transfer parent
        $str1 = parent::transfer($subjek, $nominal);

        if ($cashback)
        {
        $this->tambahSaldo($cashback);
            $str2 = "Cashback sebesar Rp " . number_format($cashback) . " berhasil ditambahkan ke dalam saldo" .
                    "\nSaldo saat ini: Rp " . number_format($this->getSaldo());
        }
        else
        {
            $str2 = "Tidak ada cashback";
        }

        return  $str = $str1 . "\n" . $str2;
    }
}