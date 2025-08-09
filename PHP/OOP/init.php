<?php

// autoload function buat ngeload class secara otomatis
spl_autoload_register(function ($class)
{
    $class = explode("/", $class);
    $class = end($class);
    $file = __DIR__ . "/" . $class . ".php";
    require_once $file;
});