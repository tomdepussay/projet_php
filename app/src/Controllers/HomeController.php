<?php 

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;

class HomeController {

    public function index(): void
    {
        $view = new View('home/index');
    }
}