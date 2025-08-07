<?php

include_once    "Parent Class.php";
include_once    "Akun Reguler.php";
include_once    "Akun Prioritas.php";

$a = new akunPrioritas("Budi", 100000);
echo $a->getInfoAkun() . "\n";
echo $a->deposit(10000);