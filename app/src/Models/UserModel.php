<?php 

namespace App\Models;

use App\Core\Database;
use App\Entities\User;

class UserModel {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findByEmail(string $email): User|bool
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(['email' => $email]);
        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if($user) {
            return $this->parseUser($user);
        } else {
            return false;
        }
        
    }

    public function addUser(string $firstname, string $lastname, string $email, string $password): bool 
    {
        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (:firstname, :lastname, :email, :password)";
        $query = $this->db->prepare($sql);
        $stmt = $query->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password
        ]);
        
        return $stmt;
    }

    private function parseUsers(array $rows): array
    {
        $users = [];
        foreach($rows as $row) {
            $users[] = $this->parseUser($row);
        }
        return $users;
    }

    private function parseUser(array $row): User
    {
        return new User($row['id_user'], $row['firstname'], $row["lastname"], $row['email'], $row['password']);
    }
}

