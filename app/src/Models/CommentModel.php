<?php

namespace App\Models;

use App\Core\Database;
use App\Entities\Comment;
use App\Entities\User;

class CommentModel {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert(string $comment, int $id_user, int $id_picture): bool 
    {
        $sql = "INSERT INTO comments (content, id_user, id_picture) VALUES (:content, :id_user, :id_picture)";
        $query = $this->db->prepare($sql);
        return $query->execute([
            'content' => $comment,
            'id_user' => $id_user,
            'id_picture' => $id_picture
        ]);
    }

    public function findAllByIdPicture(int $id_picture): array 
    {
        $sql = "SELECT
                    c.*,
                    u.*
                FROM comments c
                LEFT JOIN users u ON c.id_user = u.id_user
                WHERE c.id_picture = :id_picture
                ORDER BY c.id_comment DESC";
        $query = $this->db->prepare($sql);
        $query->execute(['id_picture' => $id_picture]);
        $comments = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $this->parseComments($comments);
    }

    private function parseComment(array $row): Comment
    {
        return new Comment(
            $row["id_comment"],
            $row["content"],
            new User(
                $row["id_user"],
                $row["firstname"],
                $row["lastname"],
                $row["email"],
                $row["password"]
            )
        );
    }

    private function parseComments(array $rows): array
    {
        $comments = [];
        foreach($rows as $row) {
            $comments[] = $this->parseComment($row);
        }
        return $comments;
    }
}