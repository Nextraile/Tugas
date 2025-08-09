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

    // override method deposit
    public function deposit($nominal)
    {
        $persentase = 5;
        $cashback = $persentase / 100 * $nominal;

        // manggil method deposit parent
        $str1 = parent::deposit($nominal);

        if ($cashback
            )
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

    // override method withdraw
    public function withdraw($nominal)
    {
        $persentase = 5;
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

    // override method transfer
    public function transfer($subjek, $nominal)
    {
        $persentase = 5;
        $cashback = $persentase / 100 * $nominal;

        // manggil method transfer parent
        $str1 = parent::transfer($subjek, $nominal);

        if (!$cashback)
        {
            $str2 = "Tidak ada cashback";
        }
        else
        {
            $this->tambahSaldo($cashback);
            $str2 = "Cashback sebesar Rp " . number_format($cashback) . " berhasil ditambahkan ke dalam saldo" .
                    "\nSaldo saat ini: Rp " . number_format($this->getSaldo());
        }

        return  $str = $str1 . "\n" . $str2;
    }
}