<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Auth;
use App\Models\GroupModel;

class GroupController {

    public function index(): void
    {
        $auth = new Auth();

        if(!$auth->isLogged()) {
            header("Location: /connexion");
            exit;
        }

        $groupModel = new GroupModel();
        $groups = $groupModel->findAllByIdUser($auth->user()->getIdUser());

        $view = new View("group/index");
        $view->addData("groups", $groups);
    }

    public function create(): void
    {
        $auth = new Auth();

        if(!$auth->isLogged()) {
            header("Location: /connexion");
            exit;
        }

        $error = [];

        $name = isset($_POST["name"]) ? $_POST["name"] : "";

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

            $name = trim($_POST["name"]);

            if(empty($name)) {
                $error["name"] = "Le nom du groupe est obligatoire";
            } else {
                $len = strlen($name);
                if($len < 2 || $len > 50) {
                    $error["name"] = "Le nom du groupe doit contenir entre 2 et 50 caractères";
                }
            }

            if(empty($error)) {

                $groupModel = new GroupModel();
                $groupExist = $groupModel->findOneByName($auth->user()->getIdUser(), $name);

                if($groupExist) {
                    $error["name"] = "Le groupe existe déjà";
                } else {
                    $stmt = $groupModel->insert($auth->user()->getIdUser(), $name);

                    if($stmt){
                        header("Location: /groupes");
                        exit;
                    } else {
                        $error["name"] = "Erreur lors de la création du groupe";
                    }
                }

            }

            if(empty($error)) {
                // Insertion en base de données
            }
        }


        $view = new View("group/create");
    }

    public function show(int $id): void 
    {   
        $auth = new Auth();

        if(!$auth->isLogged()) {
            header("Location: /connexion");
            exit;
        }

        $groupModel = new GroupModel();
        $group = $groupModel->findOneById($id);

        if(!$group) {
            header("Location: /groupes");
            exit;
        }

        $view = new View("group/show");
        $view->addData("group", $group);
    }
}