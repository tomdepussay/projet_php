<?php

spl_autoload_register(function (string $class) {
    $pathClass = __DIR__ . "/../" . str_ireplace(["App\\", "\\"], ["", "/"], $class) . ".php";
    if(file_exists($pathClass)){
        include $pathClass;
    } else {
        echo "Class not found: " . $class . "<br>";
    }
});

use App\Core\App;

session_start();

$app = new App();

$app->run();