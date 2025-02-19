<?php

namespace App\Models;

use App\Core\Database;
use App\Entities\PasswordReset;

class PasswordResetModel {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addToken(int $id, string $token): bool
    {
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $sql = "INSERT INTO password_resets (token, expires_at, id_user) VALUES (:token, :expires_at, :id)";

        $query = $this->db->prepare($sql);
        $stmt = $query->execute([
            'token' => $token,
            'expires_at' => $expires_at,
            'id' => $id
        ]);

        return $stmt;
    }

    public function findOneByToken(string $token): array|bool
    {
        $sql = "SELECT * FROM password_resets WHERE token = :token";

        $query = $this->db->prepare($sql);
        $query->execute([
            'token' => $token
        ]);
        $passwordReset = $query->fetch(\PDO::FETCH_ASSOC);

        return $passwordReset;
    }

    public function deleteToken(int $id_password_reset): bool 
    {
        $sql = "DELETE FROM password_resets WHERE id_password_reset = :id_password_reset";

        $query = $this->db->prepare($sql);
        $stmt = $query->execute([
            'id_password_reset' => $id_password_reset
        ]);

        return $stmt;
    }
}