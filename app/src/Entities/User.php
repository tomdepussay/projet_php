<?php

namespace App\Entities;

use App\Models\UserModel;

class User {
    private int $id_user;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private int $id_status;
    private string $status;

    public function __construct(int $id_user, string $firstname, string $lastname, string $email, string $password, int $id_status = 0, string $status = "")
    {
        $this->id_user = $id_user;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->id_status = $id_status;
        $this->status = $status;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(): void 
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(): void 
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(): void 
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIdStatus(): int
    {
        return $this->id_status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function pictureIsLike(int $id_picture): bool
    {
        $userModel = new UserModel();
        return $userModel->pictureIsLike($this->id_user, $id_picture);
    }
}