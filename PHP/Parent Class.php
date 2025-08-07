<?php
class akunBank
{
    // property
    private $nama = "",
            $saldo = 0,
            $statusAkun = "Reguler";

    // constructor buat nginput value property tiap objek
    public function __construct($nama, $saldo, $status)
    {
        $this->nama = $nama;
        $this->saldo = $saldo;
        $this->statusAkun = $status;
    }

    // setter methods
    protected function setNama($nama)
    {
        $this->nama = $nama;
    }

    protected function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    }

    protected function setStatusAkun($status)
    {
        $this->statusAkun = $status;
    }

    // getter methods
    public function getNama()
    {
        return $this->nama;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    public function getStatusAkun()
    {
        return $this->statusAkun;
    }

    // method buat menampilkan informasi akun
    public function getInfoAkun()
    {
        $nama = $this->getNama();
        $saldo = $this->getSaldo();
        $status = $this->getStatusAkun();

        return  "Akun " . $status . ": " . $nama . "\n" .
                "Saldo: Rp " . number_format($saldo);
    }

    // operator saldo methods
    protected function tambahSaldo($nominal)
    {
        $saldo = $this->getSaldo();
        $str = $saldo += $nominal;
        $this->setSaldo($str);
    }

    protected function kurangiSaldo($nominal)
    {
        $saldo = $this->getSaldo();
        $str = $saldo -= $nominal;
        $this->setSaldo($str);
    }

    // deposit method
    public function deposit($nominal)
    {
        $minimalDeposit = 50000;
        $saldo = $this->getSaldo();

        if ($nominal <= $minimalDeposit)
        {
            return  "Transaksi gagal!\n".
                    "Nominal minimal deposit adalah Rp " . number_format($minimalDeposit);
        }
        else
        {
            $saldoSekarang = $this->tambahSaldo($nominal);
            return  "Transaksi berhasil!\n".
                    "Nominal sebesar Rp " . number_format($nominal) . " berhasil ditambahkan ke dalam saldo\n".
                    "Total saldo saat ini: Rp " . number_format($saldoSekarang);
        }
    }

    // withdraw methods
    public function withdraw($nominal)
    {
        $minimalTarik = 50000;
        $maksimalTarik = 2000000;
        $saldo = $this->getSaldo();

        if ($nominal <= $minimalTarik)
        {
            $error = "Nominal minimal penarikan adalah Rp " . number_format($minimalTarik);
        }
        else if ($nominal > $maksimalTarik)
        {
            $error = "Nominal maksimal penarikan adalah Rp " . number_format($maksimalTarik);
        }
        else if ($nominal > $saldo)
        {
            $error = "Saldo tidak mencukupi";
        }
        else
        {
            $saldo = $this->kurangiSaldo($nominal);
            $sukses = "Saldo ditarik: Rp " . number_format($nominal) . "\n".
                      "Total saldo saat ini: Rp " . number_format($saldo);
        }

    }

    // transfer methods
    public function transfer($subjek, $nominal)
    {
        $minimalTransfer = 50000;
        $saldo = $this->getSaldo();
        $namaSubjek = $subjek->getNama();
        $saldoSubjek = $subjek->getSaldo();
        $estimasiSaldo = $saldo - $nominal;

        if (!$subjek instanceof akunBank)
        {
            $error = "Transaksi gagal!\n".
                    "Nama akun yang dituju tidak ditemukan";
        }
        elseif ($nominal < $minimalTransfer)
        {
            $error = "Transaksi gagal!\n".
                    "Nominal minimal transfer adalah Rp " . number_format($minimalTransfer);
        }
        elseif ($estimasiSaldo <= 0)
        {
            $error = "Transaksi gagal!\n".
                    "Saldo tidak mencukupi";
        }
        else
        {
            $saldo = $this->kurangiSaldo($nominal);
            $saldoSubjek += $nominal;
            $sukses = "Nominal sejumlah Rp " . number_format($nominal) . " berhasil ditransfer ke akun $namaSubjek\n".
                      "Saldo saat ini: Rp " . number_format($saldo);
        }
        
    }
}