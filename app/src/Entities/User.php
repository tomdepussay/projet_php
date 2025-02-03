<?php

namespace App\Entities;

class User {
    private int $id_user;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;

    public function __construct(int $id_user, string $firstname, string $lastname, string $email, string $password)
    {
        $this->id_user = $id_user;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
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
}