<?php

spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . "/";
    $relativeClass = str_replace("\\", "/", $className);
    $file = "{$baseDir}{$relativeClass}.php";
    if(file_exists($file)) require_once $file;
});