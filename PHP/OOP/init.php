<?php

// autoload function buat ngeload class secara otomatis
spl_autoload_register(function ($class)
{
    // ngereplace namespace jadi path yang bener
    $class = str_replace("\\", "/", $class);

    // $path yang berisi direktori tiap class
    $path =
    [
        __DIR__ . '/models/',
        __DIR__ . '/views/',
        __DIR__ . '/controls/'
    ];

    // nyari file class di tiap direktori yang ada di $path
    foreach ($path as $dir)
    {
        $file = $dir . $class . ".php";

        // kalo file exists, require file tersebut
        if (file_exists($file))
        {
            require_once $file;

            // kalo ketemu, langsung return dan berhenti dari loop
            return;
        }
    }

    // kalo ga ketemu, lempar exception
    throw new exception ("Class $class not found!");
});