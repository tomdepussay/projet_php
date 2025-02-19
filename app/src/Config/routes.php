<?php

namespace App\Config;

class Routes {
    public static array $routes = [
        [
            "path" => "/",
            "method" => ["GET"],
            "controller" => "HomeController",
            "function" => "index"
        ],
        [
            "path" => "/connexion",
            "method" => ["GET", "POST"],
            "controller" => "AuthController",
            "function" => "login"
        ],
        [
            "path" => "/inscription",
            "method" => ["GET", "POST"],
            "controller" => "AuthController",
            "function" => "register"
        ],
        [
            "path" => "/deconnexion",
            "method" => ["GET"],
            "controller" => "AuthController",
            "function" => "logout"
        ],
        [
            "path" => "/recuperation",
            "method" => ["GET", "POST"],
            "controller" => "AuthController",
            "function" => "forgotPassword"
        ],
        [
            "path" => "/groupes",
            "method" => ["GET"],
            "controller" => "GroupController",
            "function" => "index"
        ],
        [
            "path" => "/groupes/creer",
            "method" => ["GET", "POST"],
            "controller" => "GroupController",
            "function" => "create"
        ],
        [
            "path" => "/groupes/{id_group}",
            "method" => ["GET"],
            "controller" => "GroupController",
            "function" => "show"
        ],
        [
            "path" => "/groupes/{id_group}/gerer",
            "method" => ["GET", "POST"],
            "controller" => "GroupController",
            "function" => "edit"
        ],
        [
            "path" => "/groupes/{id_group}/ajouter",
            "method" => ["GET", "POST"],
            "controller" => "PictureController",
            "function" => "create"
        ],
        [
            "path" => "/photos/{url_picture}",
            "method" => ["GET", "POST"],
            "controller" => "PictureController",
            "function" => "show"
        ],
        [
            "path" => "/photos/{url_picture}/commenter",
            "method" => ["GET", "POST"],
            "controller" => "PictureController",
            "function" => "comment"
        ],
        [
            "path" => "/photos/{url_picture}/modifier",
            "method" => ["GET", "POST"],
            "controller" => "PictureController",
            "function" => "edit"
        ],
        [
            "path" => "/photos/{url_picture}/supprimer",
            "method" => ["POST"],
            "controller" => "PictureController",
            "function" => "delete"
        ],
        [
            "path" => "/design",
            "method" => ["GET"],
            "controller" => "HomeController",
            "function" => "design"
        ]
    ];
}