<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;

    public function __construct() {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    /**
     * Empêcher le clonage de l'instance
     */
    private function __clone() {}

    /**
     * Empêcher la désérialisation de l'instance
     */
    public function __wakeup() {}

    /**
     * Retourner une instance unique de la connexion à la base de données.
     * @return PDO
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Retourner directement la connexion lorsque l'objet est utilisé comme string ou appelé.
     * @return PDO
     */
    public function __invoke() {
        return $this->connection;
    }

    /**
     * Permettre l'instanciation directe en retournant la connexion.
     * @return PDO
     */
    public function __get($name) {
        if ($name === 'connection') {
            return $this->connection;
        }
    }

    // Nouvelle méthode magique pour rediriger tous les appels vers PDO
    public function __call($name, $arguments) {
        if (method_exists($this->connection, $name)) {
            return call_user_func_array([$this->connection, $name], $arguments);
        }
        throw new \BadMethodCallException("La méthode $name n'existe pas dans PDO.");
    }
}
