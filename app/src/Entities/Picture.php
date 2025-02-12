<?php

namespace App\Entities;

use App\Models\PictureModel;

class Picture {

    private int $id_picture;
    private string $created_at;
    private string $description;
    private string $url;
    private string $extension;
    private string $link;
    private bool $public_access;
    private int $id_user;
    private int $id_group;

    public function __construct(int $id_picture, string $created_at, string $description, string $url, string $extension, bool $public_access, int $id_user, int $id_group, int $likes = 0) {
        $this->id_picture = $id_picture;
        $created_at = new \DateTime($created_at);
        $this->created_at = $created_at->format("d/m/Y");
        $this->description = $description;
        $this->url = $url;
        $this->link = "../../../public/uploads/pictures/" . $url . "." . $extension;
        $this->public_access = $public_access;
        $this->id_user = $id_user;
        $this->id_group = $id_group;
        $this->likes = $likes;
    }

    public function getIdPicture(): int {
        return $this->id_picture;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getLink(): string {
        return $this->link;
    }

    public function getPublicAccess(): bool {
        return $this->public_access;
    }

    public function getIdUser(): int {
        return $this->id_user;
    }

    public function getIdGroup(): int {
        return $this->id_group;
    }

    public function getLikes(): int {
        return $this->likes;
    }

    public function setIdPicture(int $id_picture): void {
        $this->id_picture = $id_picture;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setUrl(string $url): void {
        $this->url = $url;
    }

    public function setPublicAccess(bool $public_access): void {
        $this->public_access = $public_access;
    }

    public function canEdit(int $id_user): bool {
        $model = new PictureModel();
        return $model->canEdit($this->id_picture, $id_user);
    }
}