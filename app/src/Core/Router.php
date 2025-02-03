<?php

namespace App\Core;

use App\Controllers\ErrorController;

class Router {
    /**
     * Trouver et exécuter la route correspondant à la requête HTTP.
     */
    public function dispatch(array $routes) {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        
        // Supprimer les paramètres GET de l'URL (si présents)
        $uri = strtok($uri, '?');

        foreach ($routes as $route) {
            // Convertir les routes dynamiques en expressions régulières
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route['path']);
            $pattern = "#^" . $pattern . "$#";
            
            if (preg_match($pattern, $uri, $matches) && in_array($method, $route['method'])) {
                array_shift($matches); // Supprimer le premier élément qui est l'URL complète
                
                $controllerClass = "App\\Controllers\\" . $route['controller'];
                $function = $route['function'];
                
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    
                    if (method_exists($controller, $function)) {
                        call_user_func_array([$controller, $function], $matches);
                        return;
                    }
                }
            }
        }

        // Si aucune route ne correspond, afficher une erreur 404
        $errorController = new ErrorController();
        $errorController->error404();
    }
}
