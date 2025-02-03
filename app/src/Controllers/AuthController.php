<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;
use App\Entities\User;
use App\Core\Auth;
use App\Models\PasswordResetModel;

class AuthController {

    public function register(): void 
    {
        $auth = new Auth();
        
        if($auth->isLogged()){
            header('Location: /');
            exit;
        }
        $error = [];

        $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
        $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $passwordConfirm = isset($_POST["passwordConfirm"]) ? $_POST["passwordConfirm"] : "";

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){

            $firstname = ucwords(strtolower(trim($_POST["firstname"])));

            if(empty($firstname)){
                $error["firstname"] = "Le prénom est obligatoire";
            } else {
                $len = strlen($firstname);
                if($len < 2 || $len > 30){
                    $error["firstname"] = "Le prénom doit contenir entre 2 et 30 caractères";
                }
            }

            $lastname = strtoupper(trim($_POST["lastname"]));

            if(empty($lastname)){
                $error["lastname"] = "Le nom est obligatoire";
            } else {
                $len = strlen($lastname);
                if($len < 2 || $len > 30){
                    $error["lastname"] = "Le nom doit contenir entre 2 et 30 caractères";
                }
            }

            $email = strtolower(trim($_POST["email"]));

            if(empty($email)){
                $error["email"] = "L'email est obligatoire";
            } else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error["email"] = "L'email n'est pas valide";
                } else {
                    $len = strlen($email);
                    if($len > 255){
                        $error["email"] = "L'email est trop longue";
                    }
                }
            }

            $password = $_POST["password"];

            if(empty($password)){
                $error["password"] = "Le mot de passe est obligatoire";
            }

            $passwordConfirm = $_POST["passwordConfirm"];

            if(empty($passwordConfirm)){
                $error["passwordConfirm"] = "La confirmation du mot de passe est obligatoire";
            } else {
                if($password != $passwordConfirm){
                    $error["passwordConfirm"] = "Les mots de passe ne correspondent pas";
                }
            }

            if(empty($error)){

                $userModel = new UserModel();
                $userExist = $userModel->findByEmail($email);

                if($userExist){
                    $error["email"] = "Cet email est déjà utilisé";
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $userAdded = $userModel->addUser($firstname, $lastname, $email, $password);

                    if($userAdded){
                        header("Location: /connexion");
                    } else {
                        $error["global"] = "Une erreur est survenue lors de l'inscription";
                    }
                }
            }
        }

        $view = new View("auth/register");
        $view->addData("title", 'Inscription');
        $view->addData("description", "Page d'inscription' de mon site");
        $view->addData("error", $error);
        $view->addData("credentials", [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email
        ]);
    }

    public function login(): void
    {
        $auth = new Auth();
        
        if($auth->isLogged()){
            header('Location: /');
            exit;
        }

        $error = [];

        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $passwordConfirm = isset($_POST["passwordConfirm"]) ? $_POST["passwordConfirm"] : "";

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){

            $email = strtolower(trim($_POST["email"]));

            if(empty($email)){
                $error["email"] = "L'email est obligatoire";
            } 

            $password = $_POST["password"];

            if(empty($password)){
                $error["password"] = "Le mot de passe est obligatoire";
            }

            if(empty($error)){

                $userModel = new UserModel();
                $user = $userModel->findByEmail($email);

                if($user){
                    if(password_verify($password, $user->getPassword())){
                        Auth::login($user);
                        header("Location: /");
                    } else {
                        $error["global"] = "L'email ou le mot de passe est incorrect";
                    }
                } else {
                    $error["global"] = "L'email ou le mot de passe est incorrect";
                }
            }
        }

        $view = new View('auth/login');
        $view->addData('error', $error);
    }

    public function logout(): void 
    {
        Auth::logout();
        header('Location: /');
    }

    public function forgotPassword(): void 
    {
        $auth = new Auth();

        if($auth->isLogged()){
            header('Location: /');
            exit;
        }

        $error = [];

        $email = isset($_POST["email"]) ? $_POST["email"] : "";

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){

            $email = strtolower(trim($_POST["email"]));

            if(empty($email)){
                $error["email"] = "L'email est obligatoire";
            }

            if(empty($error)){

                $userModel = new UserModel();
                $user = $userModel->findByEmail($email);

                if($user){
                    $token = bin2hex(random_bytes(32));
                    
                    $passwordResetModel = new PasswordResetModel();
                    $passwordResetModel->addToken($user->getIdUser(), $token);

                    $link = "http://localhost:8000/reset-password?token=$token";

                    // Données du mail
                    $data = [
                        "from" => "ne-pas-repondre@tomdepussay.fr",
                        "to" => [$user->getEmail()],
                        "subject" => "Réinitialisation de votre mot de passe",
                        "html" => "<h1>Bonjour !</h1><p>Pour réinitialiser votre mot de passe cliquez sur ce lien : <a href='" . $link . "' target='_blank'>" . $link . "</a></p>"
                    ];

                    $url = "https://api.resend.com/emails";

                    // Initialiser cURL
                    $ch = curl_init($url);
                                    
                    // Configurer la requête cURL
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        "Authorization: Bearer " . $_ENV['RESEND_KEY'],
                        "Content-Type: application/json"
                    ]);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    
                    // Exécuter la requête
                    $response = curl_exec($ch);
                    
                    // Vérifier s'il y a des erreurs
                    if (curl_errno($ch)) {
                        echo 'Erreur cURL : ' . curl_error($ch);
                    } else {
                        echo 'Réponse : ' . $response;
                    }
                    
                    // Fermer la connexion cURL
                    curl_close($ch);

                } else {
                    $error["global"] = "Cet utilisateur n'existe pas";
                }
            }
        }

        $view = new View('auth/forgot-password');
        $view->addData('error', $error);
        $view->addData('email', $email);
    }
}