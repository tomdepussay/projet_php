<?php

namespace App\Entities;

use App\Entities\User;

class Comment {

    private int $id_comment;
    private string $content;
    private User $user;

    public function __construct(int $id_comment, string $content, User $user) {
        $this->id_comment = $id_comment;
        $this->content = $content;
        $this->user = $user;
    }

    public function getIdComment(): int {
        return $this->id_comment;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getUser(): User {
        return $this->user;
    }
}