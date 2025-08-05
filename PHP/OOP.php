<?php
class Sigma {
    private $skibidi,
            $sigma,
            $latina,
            $batak,
            $medan,
            $pace,
            $jawa;

    public function __construct($skibidi, $sigma, $latina, $batak, $medan, $pace, $jawa){
        $this->skibidi = $skibidi;
        $this->sigma = $sigma;
        $this->latina = $latina;
        $this->batak = $batak;
        $this->medan = $medan;
        $this->pace = $pace;
        $this->jawa = $jawa;
    }

    public function muscleMemory(){
        if ($this->batak == true){
            $str = "jangan ko serang kami israel, kami ini sodaramu";
        } else if ($this->medan == true) {
            $str = "ingfokan besi kiloan terdekat";
        } else if ($this->pace == true) {
            $str = "papua merdeka su dekat! sa pulang pigi makan dulu";
        } else if ($this->jawa == true) {
            $str = "horeg? serlok tak parani";
        } else {
            $str = "imigran gelap rohingya";
        }

        return $str;
    }

    public function setSuku($suku){
        if ($suku == "batak"){
            $this->batak = true;
        } elseif ($suku == "medan") {
            $this->medan = true;
        } elseif ($suku == "pace"){
            $this->pace = true;
        } elseif ($suku == "jawa"){
            $this->jawa = true;
        }
    }
}

$Mugiyono = new Sigma(false, false, false, false, false, false, false);
$Mugiyono->setSuku("batak");
$gyat = $Mugiyono->muscleMemory();
echo $gyat;