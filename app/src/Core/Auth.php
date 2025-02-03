<?php

namespace App\Core;

use App\Entities\User;

class Auth {
    public static function login(User $user): void
    {
        $_SESSION['auth'] = $user;
    }

    public static function logout(): void
    {
        $_SESSION['auth'] = null;
    }

    public static function user(): ?User
    {
        return $_SESSION['auth'] ?? null;
    }

    public static function isLogged(): bool
    {
        return $_SESSION['auth'] != null;
    }
}