<?php
class Bankdik {
    //property
    private $nama = "",
            $saldo = 0,
            $statusAkun = "Reguler";

    //constructor buat nginput value property tiap objek
    public function __construct($nama, $saldo, $status){
        $this->nama = $nama;
        $this->saldo = $saldo;
        $this->statusAkun = $status;
    }

    //setter methods
    protected function setNama($nama){
        $this->nama = $nama;
    }
    protected function setSaldo($saldo){
        $this->saldo = $saldo;
    }
    protected function setStatusAkun($status){
        $this->statusAkun = $status;
    }

    //getter methods
    public function getNama(){
        return $this->nama;
    }
    public function getSaldo(){
        return $this->saldo;
    }
    public function getStatusAkun(){
        return $this->statusAkun;
    }

    //transaksi methods
    protected function tambahSaldo($nominal){
        $str = $this->saldo += $nominal;
        return $str;
    }

    protected function kurangiSaldo($nominal){
        $str = $this->saldo -= $nominal;
        return $str;
    }

    // methods
    public function deposit($nominal){
        $minimalDeposit = number_format(50000);
        $saldo = $this->saldo;

        if ($nominal <= $minimalDeposit) {
            $str =  "Transaksi gagal!\n".
                    "Nominal minimal deposit adalah Rp number_format($minimalDeposit)";
        } else {
            $saldoSekarang = Bankdik::tambahSaldo($nominal);
            $str =  "Transaksi berhasil!\n".
                    "Nominal sebesar Rp number_format($nominal) berhasil ditambahkan ke dalam saldo\n".
                    "Total saldo saat ini: Rp number_format($saldoSekarang)";
        }

        return $str;
    }

    //tarik methods
    public function withdraw($nominal){
        $minimalTarik = 50000;
        $maksimalTarik = 2000000;
        $saldo = $this->saldo;

        if ($nominal <= $minimalTarik)
        {
            $str =  "Penarikan gagal!\n".
                    "Nominal minimal penarikan adalah Rp number_$minimalTarik";
        }
        else if ($nominal > $maksimalTarik)
        {
            $str =  "Penarikan gagal!\n".
                    "Nominal maksimal penarikan adalah Rp $maksimalTarik";
        }
        else if ($nominal > $saldo)
        {
            $str = "Penarikan gagal!\n".
                    "Saldo tidak mencukupi";
        }
        else
        {
            $saldo = Bankdik::kurangiSaldo($nominal);
            $str =  "Penarikan berhasil!\n".
                    "Saldo ditarik: Rp $nominal\n".
                    "Total saldo saat ini: Rp $saldo";
        }

        return $str;
    }

        public function transfer($subjek, $nominal){
        $minimalTransfer = 50000;
        $saldo = $this->saldo;
        $namaSubjek = $subjek->nama;
        $saldoSubjek = $subjek->saldo;
        $estimasiSaldo = $saldo - $nominal;

        if (!$subjek instanceof Bankdik)
        {
            $str =  "Transaksi gagal!\n".
                    "Nama akun yang dituju tidak ditemukan";
        }
        elseif ($nominal < $minimalTransfer)
        {
            $str =  "Transaksi gagal!\n".
                    "Nominal minimal transfer adalah $minimalTransfer";
        }
        elseif ($estimasiSaldo <= 0)
        {
            $str =  "Transaksi gagal!\n".
                    "Saldo tidak mencukupi";
        }
        else
        {
            $saldo = Bankdik::kurangiSaldo($nominal);
            $saldoSubjek += $nominal;
            $str =  "Transaksi berhasil!\n".
                    "Nominal sejumlah Rp $nominal berhasil ditransfer ke akun $namaSubjek\n".
                    "Saldo saat ini: Rp $saldo";
        }
        
        return $str;
    }
}