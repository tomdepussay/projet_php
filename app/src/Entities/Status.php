<?php

namespace App\Entities;

class Status {
    private int $id_status;
    private string $name;

    public function __construct(int $id_status, string $name)
    {
        $this->id_status = $id_status;
        $this->name = $name;
    }

    public function getIdStatus(): int
    {
        return $this->id_status;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(): void 
    {
        $this->name = $name;
    }
}