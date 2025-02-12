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

    public function findOneById(int $id_user): User|bool 
    {
        $sql = "SELECT * FROM users WHERE id_user = :id_user";
        $query = $this->db->prepare($sql);
        $query->execute(['id_user' => $id_user]);
        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if($user) {
            return $this->parseUser($user);
        } else {
            return false;
        }
    }

    public function pictureIsLike(int $id_user, int $id_picture): bool
    {
        $sql = "SELECT * FROM likes WHERE id_user = :id_user AND id_picture = :id_picture";
        $query = $this->db->prepare($sql);
        $query->execute(['id_user' => $id_user, 'id_picture' => $id_picture]);
        $like = $query->fetch(\PDO::FETCH_ASSOC);

        if($like) {
            return true;
        } else {
            return false;
        }
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

