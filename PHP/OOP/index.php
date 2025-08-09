<?php

// manggil autoload function dari init.php
require_once __DIR__ . "/init.php";

// objects
$Budi = new AkunReguler("Budi", 100000);
$Andi = new AkunPrioritas("Andi", 200000);
$objects = [$Budi, $Andi];

// looping sederhana buat keperluan testing
foreach ($objects as $object)
{
    echo $object->getInfoAkun() . "\n";
}
