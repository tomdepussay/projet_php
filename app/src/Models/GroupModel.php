<?php

namespace App\Models;

use App\Core\Database;
use App\Entities\Group;

class GroupModel {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findAllUsersByIdGroup(int $id): array 
    {
        $sql = "SELECT 
                    u.*,
                    s.*
                FROM users u
                LEFT JOIN users_groups ug ON u.id_user = ug.id_user
                LEFT JOIN status s ON ug.id_status = s.id_status
                WHERE ug.id_group = :id";
    }

    public function findOneById(int $id): Group|bool 
    {
        $sql = "SELECT * FROM groups WHERE id_group = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $group = $query->fetch(\PDO::FETCH_ASSOC);

        if($group) {
            return $this->parseGroup($group);
        } else {
            return false;
        }
    }

    public function findAllByIdUser(int $id): array
    {
        $sql = "SELECT * FROM groups g
                LEFT JOIN users_groups ug ON g.id_group = ug.id_group
                WHERE ug.id_user = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $groups = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $this->parseGroups($groups);
    }

    public function findOneByName(int $id_user, string $name): Group|bool
    {
        $sql = "SELECT * FROM groups g
                LEFT JOIN users_groups ug ON g.id_group = ug.id_group
                WHERE ug.id_user = :id_user AND g.name = :name";
        $query = $this->db->prepare($sql);
        $query->execute(['id_user' => $id_user, 'name' => $name]);
        $group = $query->fetch(\PDO::FETCH_ASSOC);

        if($group) {
            return $this->parseGroup($group);
        } else {
            return false;
        }
    }

    public function insert(int $id_user, string $name): bool 
    {
        // Début de transaction
        $this->db->beginTransaction();

        // Insertion du groupe
        $sql_insert_group = "INSERT INTO groups (name) VALUES (:name)";
        $query_insert_group = $this->db->prepare($sql_insert_group);
        $stmt_insert_group = $query_insert_group->execute(['name' => $name]);
        $id_group = $this->db->lastInsertId();

        // Insertion de l'utilisateur dans le groupe
        $sql_insert_user_group = "INSERT INTO users_groups (id_user, id_group, id_status) VALUES (:id_user, :id_group, 1)";
        $query_insert_user_group = $this->db->prepare($sql_insert_user_group);
        $stmt_insert_user_group = $query_insert_user_group->execute(['id_user' => $id_user, 'id_group' => $id_group]);

        // Si les deux requêtes sont exécutées avec succès, on valide la transaction
        if($stmt_insert_group && $stmt_insert_user_group) {
            $this->db->commit();
            return true;
        } else {
            $this->db->rollBack();
            return false;
        }
    }

    private function parseGroups(array $rows): array
    {
        $groups = [];
        foreach($rows as $row) {
            $groups[] = $this->parseGroup($row);
        }
        return $groups;
    }

    private function parseGroup(array $row): Group
    {
        return new Group($row['id_group'], $row['name']);
    }
}