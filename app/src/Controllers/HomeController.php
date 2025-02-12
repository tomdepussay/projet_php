<?php 

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use App\Core\Auth;
use App\Models\PictureModel;

class HomeController {

    public function index(): void
    {
        $auth = new Auth();

        if(!$auth->isLogged()) {
            $view = new View('home/index');
            exit;
        }

        $pictureModel = new PictureModel();
        $pictures = $pictureModel->findAllByIdUser($auth->user()->getIdUser());

        $view = new View('home/connect');
        $view->addData('pictures', $pictures);
    }

    public function design(): void
    {
        $view = new View('home/design');
    }
}