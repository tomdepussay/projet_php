<?php

namespace App\Controllers;

use App\Core\View;

class ErrorController {

    public function error404(): void
    {
        $view = new View("error/error404");
    }
}