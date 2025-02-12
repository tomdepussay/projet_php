<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Auth;
use App\Models\GroupModel;
use App\Models\UserModel;
use App\Models\PictureModel;
use App\Models\CommentModel;

class PictureController {

    public function create(int $id_group): void 
    {
        $auth = new Auth();

        if(!$auth->isLogged()) {
            header("Location: /connexion");
            exit;
        }

        $groupModel = new GroupModel();
        $group = $groupModel->findOneById($id_group);

        if(!$group) {
            header("Location: /groupes");
            exit;
        }

        $canAccess = $group->canAccess($auth->user()->getIdUser());

        if(!$canAccess) {
            header("Location: /groupes");
            exit;
        }

        $canPost = $group->canPost($auth->user()->getIdUser());

        if(!$canPost) {
            header("Location: /groupes");
            exit;
        }
        
        $error = [];

        $picture = $_FILES["picture"] ?? null;
        $description = trim($_POST["description"] ?? "");
        
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

            if(empty($picture)) {
                $error["picture"] = "Veuillez ajouter une image";
            }

            if($picture["size"] > 1000000) {
                $error["picture"] = "L'image est trop lourde";
            }

            if($picture["error"] !== 0) {
                $error["picture"] = "Erreur lors de l'upload de l'image";
            }

            if($picture && !in_array($picture["type"], ["image/jpeg", "image/png", "image/webp"])) {
                $error["picture"] = "Le format de l'image n'est pas autorisé, veuillez utiliser un format JPG ou PNG ou WEBP";
            }
            
            if(empty($error)){

                $pictureModel = new PictureModel();
                $stmt = $pictureModel->insert($description, $picture, $auth->user()->getIdUser(), $group->getIdGroup());

                if($stmt) {
                    header("Location: /photos/" . $stmt);
                    exit;
                } else {
                    $error["global"] = "Erreur lors de l'ajout de l'image";
                }
            }
        }

        $view = new View("picture/create");
        $view->addData("group", $group);
        $view->addData("error", $error);
        $view->addData("description", $description);
    }

    public function show(string $url): void 
    {
        $auth = new Auth();

        if(!$auth->isLogged()) {
            header("Location: /connexion");
            exit;
        }

        $pictureModel = new PictureModel();
        $picture = $pictureModel->findOneByUrl($url);

        if(!$picture) {
            header("Location: /groupes");
            exit;
        }

        $groupModel = new GroupModel();
        $group = $groupModel->findOneById($picture->getIdGroup());

        if(!$group) {
            header("Location: /groupes");
            exit;
        }

        $back = "";

        if(!$picture->getPublicAccess()){

            $canAccess = $group->canAccess($auth->user()->getIdUser());

            $back = "/groupes/" . $group->getIdGroup();

            if(!$canAccess) {
                header("Location: /groupes");
                exit;
            }
        }

        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["like"])) {
            $pictureModel->like($picture->getIdPicture(), $auth->user()->getIdUser());
            header("Location: /photos/" . $picture->getUrl());
            exit;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["unlike"])) {
            $pictureModel->unlike($picture->getIdPicture(), $auth->user()->getIdUser());
            header("Location: /photos/" . $picture->getUrl());
            exit;
        }

        $userModel = new UserModel();
        $user = $userModel->findOneById($picture->getIdUser());

        $commentModel = new CommentModel();
        $comments = $commentModel->findAllByIdPicture($picture->getIdPicture());

        $view = new View("picture/show");
        $view->addData("picture", $picture);
        $view->addData("group", $group);
        $view->addData("user", $user);
        $view->addData("comments", $comments);
        $view->addData("back", $back);
    }

    public function comment(string $url): void 
    {
        $auth = new Auth();

        if(!$auth->isLogged()) {
            header("Location: /connexion");
            exit;
        }

        $pictureModel = new PictureModel();
        $picture = $pictureModel->findOneByUrl($url);

        if(!$picture) {
            header("Location: /groupes");
            exit;
        }

        $groupModel = new GroupModel();
        $group = $groupModel->findOneById($picture->getIdGroup());

        if(!$group) {
            header("Location: /groupes");
            exit;
        }

        if(!$picture->getPublicAccess()){

            $canAccess = $group->canAccess($auth->user()->getIdUser());

            if(!$canAccess) {
                header("Location: /groupes");
                exit;
            }
        }

        $comment = trim($_POST["comment"] ?? "");
        $error = [];

        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"]) && ($picture->getPublicAccess() || $group->canPost($auth->user()->getIdUser()))) {

            if(empty($comment)) {
                $error["comment"] = "Veuillez ajouter un commentaire";
            }

            if(empty($error)) {
                $commentModel = new CommentModel();
                $stmt = $commentModel->insert($comment, $auth->user()->getIdUser(), $picture->getIdPicture());

                if($stmt) {
                    header("Location: /photos/" . $picture->getUrl());
                    exit;
                } else {
                    $error["global"] = "Erreur lors de l'ajout du commentaire";
                }
            }
        }

        $view = new View("picture/comment");
        $view->addData("picture", $picture);
        $view->addData("group", $group);
        $view->addData("error", $error);
        $view->addData("comment", $comment);
    }

    public function edit(string $url): void 
    {
        $auth = new Auth();

        if(!$auth->isLogged()) {
            header("Location: /connexion");
            exit;
        }

        $pictureModel = new PictureModel();
        $picture = $pictureModel->findOneByUrl($url);

        if(!$picture) {
            header("Location: /groupes");
            exit;
        }

        $groupModel = new GroupModel();
        $group = $groupModel->findOneById($picture->getIdGroup());

        if(!$group) {
            header("Location: /groupes");
            exit;
        }

        if(!$picture->getPublicAccess()){

            $canAccess = $group->canAccess($auth->user()->getIdUser());

            if(!$canAccess) {
                header("Location: /groupes");
                exit;
            }
        }

        $error = [];
        $description = trim($_POST["description"] ?? "");
        $public = isset($_POST["public"]) ? true : false;

        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

            if(empty($description)) {
                $error["description"] = "Veuillez ajouter une description";
            }

            if(empty($error)) {
                $pictureModel = new PictureModel();
                $stmt = $pictureModel->update($picture->getIdPicture(), $description, $public);

                if($stmt) {
                    header("Location: /photos/" . $picture->getUrl());
                    exit;
                } else {
                    $error["global"] = "Erreur lors de la modification de l'image";
                }
            }
        }

        $view = new View("picture/edit");
        $view->addData("picture", $picture);
        $view->addData("group", $group);
        $view->addData("error", $error);
    }

    public function delete(string $url): void 
    {
        $auth = new Auth();

        if(!$auth->isLogged()) {
            header("Location: /connexion");
            exit;
        }

        $pictureModel = new PictureModel();
        $picture = $pictureModel->findOneByUrl($url);

        if(!$picture) {
            header("Location: /groupes");
            exit;
        }

        $groupModel = new GroupModel();
        $group = $groupModel->findOneById($picture->getIdGroup());

        if(!$group) {
            header("Location: /groupes");
            exit;
        }

        if(!$picture->canEdit($auth->user()->getIdUser())) {
            header("Location: /groupes");
            exit;
        }

        if($pictureModel->delete($picture->getIdPicture())) {
            header("Location: /groupes/" . $group->getIdGroup());
            exit;
        } else {
            header("Location: /photos/" . $picture->getUrl());
            exit;
        }
        
    }
}