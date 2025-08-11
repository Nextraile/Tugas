<?php
class AkunBank
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
    // setter methods

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
    // getter methods

    // method buat menampilkan informasi akun
    public function getInfoAkun()
    {
        $nama = $this->getNama();
        $saldo = $this->getSaldo();
        $status = $this->getStatusAkun();

        return  "Akun " . $status . ": " . $nama . "\n" .
                "Saldo: Rp " . number_format($saldo);
    }
    // method buat menampilkan informasi akun

    // method buat ngereturn message
    protected function returnSukses($pesan)
    {
        return "Transaksi berhasil!\n" . $pesan;
    }

    protected function returnError($pesan)
    {
        return "Transaksi gagal!\n" . $pesan;
    }
    // method buat ngereturn message

    // operator saldo methods
    protected function tambahSaldo($nominal)
    {
        $saldo = $this->getSaldo();
        $kalkulasi = $saldo += $nominal;
        $this->setSaldo($kalkulasi);
        return $this->getSaldo();
    }

    protected function kurangiSaldo($nominal)
    {
        $saldo = $this->getSaldo();
        $kalkulasi = $saldo -= $nominal;
        $this->setSaldo($kalkulasi);
        return $this->getSaldo();
    }
    // operator saldo methods

    // deposit method
    public function deposit($nominal)
    {
        $minimalDeposit = 50000;
        $saldo = $this->getSaldo();

        if ($nominal < $minimalDeposit)
        {
            $pesan =    "Nominal minimal deposit adalah Rp " . number_format($minimalDeposit);
            return $this->returnError($pesan);
        }
        else
        {
            $saldoSekarang = $this->tambahSaldo($nominal);
            $pesan =    "Nominal sebesar Rp " . number_format($nominal) . " berhasil ditambahkan ke dalam saldo\n".
                        "Total saldo saat ini: Rp " . number_format($saldoSekarang);
            return $this->returnSukses($pesan);
        }
    }
    // deposit method

    // withdraw method
    public function withdraw($nominal)
    {
        $minimalTarik = 50000;
        $maksimalTarik = 2000000;
        $saldo = $this->getSaldo();

        if ($nominal < $minimalTarik)
        {
            $pesan =    "Nominal minimal penarikan adalah Rp " . number_format($minimalTarik);
            return $this->returnError($pesan);
        }
        else if ($nominal > $maksimalTarik)
        {
            $pesan =    "Nominal maksimal penarikan adalah Rp " . number_format($maksimalTarik);
            return $this->returnError($pesan);
        }
        else if ($nominal > $saldo)
        {
            $pesan =    "Saldo tidak mencukupi";
            return $this->returnError($pesan);
        }
        else
        {
            $saldo = $this->kurangiSaldo($nominal);
            $pesan =    "Saldo ditarik: Rp " . number_format($nominal) . "\n".
                        "Total saldo saat ini: Rp " . number_format($saldo);
            return $this->returnSukses($pesan);
        }
    }
    // withdraw method

    // transfer method
    public function transfer($subjek, $nominal)
    {
        $minimalTransfer = 50000;
        $saldo = $this->getSaldo();
        $namaSubjek = $subjek->getNama();
        $estimasiSaldo = $saldo - $nominal;

        if (!$subjek instanceof AkunBank)
        {
            $pesan =    "Nama akun yang dituju tidak ditemukan";
            return $this->returnError($pesan);
        }
        elseif ($nominal < $minimalTransfer)
        {
            $pesan =    "Nominal minimal transfer adalah Rp " . number_format($minimalTransfer);
            return $this->returnError($pesan);
        }
        elseif ($estimasiSaldo <= 0)
        {
            $pesan =    "Saldo tidak mencukupi";
            return $this->returnError($pesan);
        }
        else
        {
            $saldo = $this->kurangiSaldo($nominal);
            $saldoSubjek = $subjek->tambahSaldo($nominal);
            $pesan =    "Nominal sejumlah Rp " . number_format($nominal) . " berhasil ditransfer ke akun $namaSubjek" . "\n" .
                        "Saldo saat ini: Rp " . number_format($saldo);
            return $this->returnSukses($pesan);
        }
    }
    // transfer method

    // cashback method
    protected function cashback($persentase, $nominal)
    {
        if ($persentase <= 0 || $nominal <= 0)
        {
            $pesan =    "Tidak ada cashback";
        }
        else
        {
            $cashback = $persentase / 100 * $nominal;
            $this->tambahSaldo($cashback);
            $pesan =    "Cashback sebesar Rp " . number_format($cashback) . " berhasil ditambahkan ke dalam saldo" . "\n" .
                        "Saldo saat ini: Rp " . number_format($this->getSaldo());
        }

        return $pesan;
    }
    // cashback method
}