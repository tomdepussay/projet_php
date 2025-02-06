<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Auth;
use App\Models\GroupModel;
use App\Models\UserModel;

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

        $canAccess = $group->canAccess($auth->user()->getIdUser());

        if(!$canAccess) {
            header("Location: /groupes");
            exit;
        }

        $view = new View("group/show");
        $view->addData("group", $group);
    }

    public function edit(int $id): void 
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

        $canAccess = $group->canAccess($auth->user()->getIdUser());

        if(!$canAccess) {
            header("Location: /groupes");
            exit;
        }

        $canEdit = $group->canEdit($auth->user()->getIdUser());

        if(!$canEdit){
            header("Location: /groupes");
            exit;
        }

        $error = [];
        $email = trim($_POST["email"] ?? "");

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

            if(empty($email)) {
                $error["email"] = "L'email est obligatoire";
            } else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error["email"] = "L'email n'est pas valide";
                }
            }

            if(empty($error)) {
                $userModel = new UserModel();
                $user = $userModel->findByEmail($email);

                if(!$user) {
                    $error["email"] = "L'utilisateur n'existe pas";
                } else {
                    $userExist = $groupModel->userExist($id, $user->getIdUser());
                    if($userExist) {
                        $error["email"] = "L'utilisateur est déjà dans le groupe";
                    }
                }

                if(empty($error)) {
                    $stmt = $groupModel->addUser($id, $user->getIdUser());
                    
                    if($stmt) {
                        header("Location: /groupes/$id/gerer");
                        exit;
                    } else {
                        $error["email"] = "Erreur lors de l'ajout de l'utilisateur";
                    }
                }
            }
        }

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteUser"])) {
            $id_user = $_POST["deleteUser"];
            $userExist = $groupModel->userExist($id, $id_user);

            if(!$userExist) {
                header("Location: /groupes/$id/gerer");
                exit;
            }

            $userCanEdit = $groupModel->canEdit($id, $id_user);

            if($userCanEdit) {
                header("Location: /groupes/$id/gerer");
                exit;
            }

            $stmt = $groupModel->deleteUser($id, $id_user);

            if($stmt) {
                header("Location: /groupes/$id/gerer");
                exit;
            } else {
                $error["delete"] = "Erreur lors de la suppression de l'utilisateur";
            }
        }

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteGroup"])) {
            $stmt = $groupModel->delete($id);

            if($stmt) {
                header("Location: /groupes");
                exit;
            } else {
                $error["delete"] = "Erreur lors de la suppression du groupe";
            }
        }

        $view = new View("group/edit");
        $view->addData("group", $group);
        $view->addData("error", $error);
        $view->addData("email", $email);
    }
}