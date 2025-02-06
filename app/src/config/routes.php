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
            "path" => "/mot-de-passe-oublie",
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
            "path" => "/groupes/{id}",
            "method" => ["GET"],
            "controller" => "GroupController",
            "function" => "show"
        ],
        [
            "path" => "/groupes/{id}/gerer",
            "method" => ["GET", "POST"],
            "controller" => "GroupController",
            "function" => "edit"
        ]
    ];
}