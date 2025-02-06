<?php

namespace App\Entities;

use App\Models\GroupModel;

class Group {
    private int $id_group;
    private string $name;

    public function __construct(int $id_group, string $name)
    {
        $this->id_group = $id_group;
        $this->name = $name;
    }

    public function getIdGroup(): int
    {
        return $this->id_group;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(): void 
    {
        $this->name = $name;
    }

    public function getUsers(): array
    {
        $groupModel = new GroupModel();
        return $groupModel->findAllUsersByIdGroup($this->id_group);
    }

    public function canAccess(int $id_user): bool
    {
        $groupModel = new GroupModel();
        return $groupModel->canAccess($this->id_group, $id_user);
    }

    public function canPost(int $id_user): bool
    {
        $groupModel = new GroupModel();
        return $groupModel->canPost($this->id_group, $id_user);
    }

    public function canEdit(int $id_user): bool
    {
        $groupModel = new GroupModel();
        return $groupModel->canEdit($this->id_group, $id_user);
    }
}