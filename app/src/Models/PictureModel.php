<?php

namespace App\Models;

use App\Core\Database;
use App\Entities\Picture;

class PictureModel {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert(string $description, array $picture, int $id_user, int $id_group): string|bool
    {
        $this->db->beginTransaction();

        // On vérifie que l'url n'existe pas déjà
        do {
            // 1 chance sur 4 294 967 296 d'avoir une collision
            $url = substr(bin2hex(random_bytes(4)), 0, 8);
            $query = $this->db->prepare("SELECT * FROM pictures WHERE url = :url");
            $query->execute(['url' => $url]);
            $urlExist = $query->fetch(\PDO::FETCH_ASSOC);
        } while($urlExist);

        $sql = "INSERT INTO pictures (description, url, extension, id_user, id_group) VALUES (:description, :url, :extension, :id_user, :id_group)";
        $query = $this->db->prepare($sql);
        $result = $query->execute([
            'description' => $description,
            'url' => $url,
            'extension' => pathinfo($picture["name"], PATHINFO_EXTENSION),
            'id_user' => $id_user,
            'id_group' => $id_group
        ]);
        
        if(!$result) {
            $this->db->rollBack();
            return false;
        }

        // Le nom du fichier est l'url + l'extension
        $filename = $url . "." . pathinfo($picture["name"], PATHINFO_EXTENSION);

        // Path assets/uploads/pictures
        $path = __DIR__ . "/../../public/uploads/pictures/" . $filename;

        $result = move_uploaded_file($picture["tmp_name"], $path);

        if(!$result) {
            $this->db->rollBack();
            return false;
        }

        $this->db->commit();
        return $url;
    }

    public function countLikes(int $id_picture): int
    {
        $sql = "SELECT COUNT(*) FROM likes WHERE id_picture = :id_picture";
        $query = $this->db->prepare($sql);
        $query->execute(['id_picture' => $id_picture]);
        return $query->fetchColumn();
    }

    public function findOneByUrl(string $url): Picture|bool 
    {
        $sql = "SELECT * FROM pictures WHERE url = :url";
        $query = $this->db->prepare($sql);
        $query->execute(['url' => $url]);
        $picture = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$picture) {
            return false;
        }

        $picture["likes"] = $this->countLikes($picture["id_picture"]);

        return new Picture(
            $picture["id_picture"],
            $picture["created_at"],
            $picture["description"],
            $picture["url"],
            $picture["extension"],
            $picture["public_access"],
            $picture["id_user"],
            $picture["id_group"],
            $picture["likes"]
        );
    }

    public function findAllByIdGroup(int $id_group): array 
    {
        $sql = "SELECT * FROM pictures WHERE id_group = :id_group ORDER BY id_picture DESC";
        $query = $this->db->prepare($sql);
        $query->execute(['id_group' => $id_group]);
        $pictures = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $this->parsePictures($pictures);
    }

    public function findAllByIdUser(int $id_user): array 
    {
        $sql = "SELECT * FROM pictures WHERE id_user = :id_user ORDER BY id_picture DESC";
        $query = $this->db->prepare($sql);
        $query->execute(['id_user' => $id_user]);
        $pictures = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $this->parsePictures($pictures);
    }

    public function like(int $id_picture, int $id_user): bool
    {
        $sql = "INSERT INTO likes (id_picture, id_user) VALUES (:id_picture, :id_user)";
        $query = $this->db->prepare($sql);
        return $query->execute([
            'id_picture' => $id_picture,
            'id_user' => $id_user
        ]);
    }

    public function unlike(int $id_picture, int $id_user): bool
    {
        $sql = "DELETE FROM likes WHERE id_picture = :id_picture AND id_user = :id_user";
        $query = $this->db->prepare($sql);
        return $query->execute([
            'id_picture' => $id_picture,
            'id_user' => $id_user
        ]);
    }

    public function update(int $id_picture, string $description, bool $public_access): bool 
    {
        $public_access = $public_access ? 1 : 0;
        $sql = "UPDATE pictures SET description = :description, public_access = :public_access WHERE id_picture = :id_picture";
        $query = $this->db->prepare($sql);
        return $query->execute([
            'description' => $description,
            'public_access' => $public_access,
            'id_picture' => $id_picture
        ]);
    }

    public function delete(int $id_picture): bool 
    {
        $this->db->beginTransaction();

        $sql = "SELECT url, extension FROM pictures WHERE id_picture = :id_picture";
        $query = $this->db->prepare($sql);
        $query->execute(['id_picture' => $id_picture]);
        $picture = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$picture) {
            $this->db->rollBack();
            return false;
        }

        $sql = "DELETE FROM likes WHERE id_picture = :id_picture";
        $query = $this->db->prepare($sql);
        $query->execute(['id_picture' => $id_picture]);

        $sql = "DELETE FROM comments WHERE id_picture = :id_picture";
        $query = $this->db->prepare($sql);
        $query->execute(['id_picture' => $id_picture]);

        $sql = "DELETE FROM pictures WHERE id_picture = :id_picture";
        $query = $this->db->prepare($sql);
        $query->execute(['id_picture' => $id_picture]);

        $path = __DIR__ . "/../../public/uploads/pictures/" . $picture["url"] . "." . $picture["extension"];
        $unlink = unlink($path);

        if(!$unlink) {
            $this->db->rollBack();
            return false;
        }

        $this->db->commit();

        return true;
    }

    public function canEdit(int $id_picture, int $id_user): bool
    {
        $sql = "SELECT id_user, id_group FROM pictures WHERE id_picture = :id_picture";
        $query = $this->db->prepare($sql);
        $query->execute([
            'id_picture' => $id_picture
        ]);
        $picture = $query->fetch(\PDO::FETCH_ASSOC);

        if($id_user === $picture["id_user"]) {
            return true;
        } else {
            $sql = "SELECT * FROM users_groups WHERE id_group = :id_group AND id_user = :id_user";
            $query = $this->db->prepare($sql);
            $query->execute([
                'id_group' => $picture["id_group"],
                'id_user' => $id_user
            ]);
            return $query->fetch(\PDO::FETCH_ASSOC) ? true : false;
        }
    }

    private function parsePictures(array $rows): array
    {
        $pictures = [];
        foreach($rows as $row) {
            $pictures[] = $this->parsePicture($row);
        }
        return $pictures;
    }

    private function parsePicture(array $row): Picture
    {
        return new Picture(
            $row["id_picture"],
            $row["created_at"],
            $row["description"],
            $row["url"],
            $row["extension"],
            $row["public_access"],
            $row["id_user"],
            $row["id_group"]
        );
    }
}