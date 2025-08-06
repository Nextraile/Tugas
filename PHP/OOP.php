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
    public function setorTunai($nominal){
        $minimalTransfer = 50000;
        $saldo = $this->saldo;
        if (!$nominal == (0 || "") &&
            $nominal >= $minimalTransfer)
        {
            $saldoSekarang = Bankdik::tambahSaldo($nominal);
            $str =  "Transaksi berhasil!\n".
                    "Nominal sebesar Rp $nominal berhasil ditambahkan ke dalam saldo\n".
                    "Total saldo saat ini: Rp $saldoSekarang";
        }
        else
        {
            $str =  "Transaksi gagal!\n".
                    "Nominal minimal transfer adalah Rp $minimalTransfer dan tidak boleh kosong";
        }

        return $str;
    }

    //tarik methods
    public function tarikTunai($nominal){
        $minimalTarik = 50000;
        $maksimalTarik = 2000000;
        $saldo = $this->saldo;

        if ($nominal >= $minimalTarik &&
            $nominal <= $maksimalTarik &&
            $saldo >= $nominal)
        {
            $saldoSekarang = Bankdik::kurangiSaldo($nominal);
            $str =  "Penarikan berhasil!\n".
                    "Saldo ditarik: Rp $nominal\n".
                    "Total saldo saat ini: Rp $saldoSekarang";
        }
        else
        {
            $str =  "Penarikan gagal!\n".
                    "Saldo tidak boleh:".
                    "-lebih sedikit daripada nominal penarikan\n".
                    "-melebihi nominal maksimal penarikan\n".
                    "Nominal minimal penarikan: Rp $minimalTarik\n".
                    "Nominal maksimal penarikan: Rp $maksimalTarik";
        }

        return $str;
    }
    public function transfer($subjek, $nominal){
        $minimalTransfer = 50000;
        $saldo = $this->saldo;
        $namaSubjek = $subjek->nama;
        $saldoSubjek = $subjek->saldo;
        $estimasiSaldo = $saldo - $nominal;
        if ($subjek instanceof Bankdik &&
            $estimasiSaldo >= $minimalTransfer &&
            $nominal >= $minimalTransfer)
        {
            Bankdik::kurangiSaldo($nominal);
            $saldoSubjek += $nominal;
            $str =  "Transaksi berhasil!\n".
                    "Nominal sejumlah Rp $nominal berhasil ditransfer ke akun $namaSubjek\n".
                    "Saldo saat ini: Rp $saldo";
        } else {
            $str =  "Transaksi gagal!\n".
                    "Nominal minimal transfer adalah Rp $minimalTransfer dan tidak boleh kosong\n".
                    "Saldo yang hendak ditransfer tidak boleh lebih dan kurang dari jumlah saldo saat ini: Rp $saldo";
        }
        
        return $str;
    }
}

//skenario

echo "Testing Bankdik Class\n";

// Skenario 1: Akun dasar
$budi = new Bankdik("Budi", 1000000, "reguler");
$ani = new Bankdik("Ani", 500000, "prioritas");

echo "Info Akun Awal:\n";
echo "Budi: Rp " . number_format($budi->getSaldo()) . "\n";
echo "Ani: Rp " . number_format($ani->getSaldo()) . "\n\n";

// Skenario 2: Setor tunai berhasil
echo "Scenario 2: Setor tunai sukses\n";
echo $budi->setorTunai(200000) . "\n\n";

// Skenario 3: Setor tunai gagal (di bawah minimum)
echo "Scenario 3: Setor tunai gagal (nominal kecil)\n";
echo $budi->setorTunai(20000) . "\n\n";

// Skenario 4: Tarik tunai berhasil
echo "Scenario 4: Tarik tunai sukses\n";
echo $budi->tarikTunai(300000) . "\n\n";

// Skenario 5: Tarik tunai gagal (melebihi saldo)
echo "Scenario 5: Tarik tunai gagal (saldo tidak cukup)\n";
echo $budi->tarikTunai(2000000) . "\n\n";

// Skenario 6: Tarik tunai gagal (melebihi batas maksimal)
echo "Scenario 6: Tarik tunai gagal (melebihi limit)\n";
echo $budi->tarikTunai(2500000) . "\n\n";

// Skenario 7: Transfer berhasil
echo "Scenario 7: Transfer sukses\n";
echo $budi->transfer($ani, 150000) . "\n\n";

// Skenario 8: Transfer gagal (saldo tidak cukup)
echo "Scenario 8: Transfer gagal (saldo tidak cukup)\n";
echo $budi->transfer($ani, 2000000) . "\n\n";

// Skenario 9: Transfer gagal (nominal terlalu kecil)
echo "Scenario 9: Transfer gagal (nominal kecil)\n";
echo $budi->transfer($ani, 10000) . "\n\n";

// Skenario 10: Cek saldo akhir
echo "Info Akun Akhir:\n";
echo "Budi: Rp " . number_format($budi->getSaldo()) . "\n";
echo "Ani: Rp " . number_format($ani->getSaldo()) . "\n";