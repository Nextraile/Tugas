<?php
class bankDik
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
            return  false &&
                    "Penarikan gagal!\n".
                    "Nominal minimal penarikan adalah Rp " . number_format($minimalTarik);
        }
        else if ($nominal > $maksimalTarik)
        {
            return  false &&
                    "Penarikan gagal!\n".
                    "Nominal maksimal penarikan adalah Rp " . number_format($maksimalTarik);
        }
        else if ($nominal > $saldo)
        {
            return  false &&
                    "Penarikan gagal!\n".
                    "Saldo tidak mencukupi";
        }
        else
        {
            $saldo = $this->kurangiSaldo($nominal);
            return  true &&
                    "Penarikan berhasil!\n".
                    "Saldo ditarik: Rp " . number_format($nominal) . "\n".
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

        if (!$subjek instanceof bankDik)
        {
            return  false &&
                    "Transaksi gagal!\n".
                    "Nama akun yang dituju tidak ditemukan";
        }
        elseif ($nominal < $minimalTransfer)
        {
            return  false &&
                    "Transaksi gagal!\n".
                    "Nominal minimal transfer adalah Rp " . number_format($minimalTransfer);
        }
        elseif ($estimasiSaldo <= 0)
        {
            return  false &&
                    "Transaksi gagal!\n".
                    "Saldo tidak mencukupi";
        }
        else
        {
            $saldo = $this->kurangiSaldo($nominal);
            $saldoSubjek += $nominal;
            return  true &&
                    "Transaksi berhasil!\n".
                    "Nominal sejumlah Rp " . number_format($nominal) . " berhasil ditransfer ke akun $namaSubjek\n".
                    "Saldo saat ini: Rp " . number_format($saldo);
        }
        
    }
}

trait bankDik
{
    protected function error($str)
    {
        return "Transaksi gagal!\n" . $pesan;
    }
}

// subclass akun reguler
class akunReguler extends bankDik
{
    // constructor buat akun reguler
    public function __construct($nama, $saldo)
    {
        // manggil constructor parent dengan parameternya ditambah status akun
        parent::__construct($nama, $saldo, "Reguler");
    }

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

// subclass akun prioritastemek
class akunPrioritas extends bankDik
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
 
$a = new akunPrioritas("Budi", 100000);
echo $a->getInfoAkun() . "\n";
echo $a->deposit(10000);