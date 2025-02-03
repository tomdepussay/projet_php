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
        $envFile = __DIR__ . '/../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, '=') !== false) {
                    [$key, $value] = explode('=', $line, 2);
                    $_ENV[$key] = trim($value);
                }
            }
        }
    }
}
