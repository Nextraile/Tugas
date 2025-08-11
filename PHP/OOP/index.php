<?php

// manggil autoload function dari init.php
require_once __DIR__ . "/init.php";

// objects
$Budi = new AkunReguler("Budi", 100000);
$Andi = new AkunPrioritas("Andi", 200000);

// looping sederhana buat keperluan testing
// foreach ($objects as $object)
// {
//     echo $object->getInfoAkun() . "\n\n"
//         .$object->deposit(50000) . "\n\n"
//     ;
// }

echo $Andi->deposit(50000). "\n\n";
echo $Andi->withdraw(50000). "\n\n";
echo $Andi->transfer($Budi, 50000). "\n\n";
echo $Budi->getSaldo();
