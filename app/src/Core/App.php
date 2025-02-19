<?php

namespace App\Core;

use App\Core\Router;
use App\Config\Routes;

class App {
    private $router;
    private $routes;

    public function __construct() {
        $_SESSION['auth'] = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
        $this->router = new Router();
        $this->routes = Routes::$routes;
        $this->loadEnv();
        $this->router = new Router();
    }

    /**
     * Démarrer l'application.
     */
    public function run() {
        $this->router->dispatch($this->routes);
    }

    /**
     * Charger les variables d'environnement à partir de src/.env.
     */
    private function loadEnv() {
        
        $env = getenv();

        foreach($env as $key => $value) {
            $_ENV[$key] = $value;
        }
    }
}
