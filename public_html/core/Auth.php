<?php

declare(strict_types=1);

class Auth
{
    private static string $sessionKey = 'admin_user_id';

    public static function login(int $userId): void
    {
        session_regenerate_id(true);
        $_SESSION[self::$sessionKey] = $userId;
    }

    public static function logout(): void
    {
        unset($_SESSION[self::$sessionKey]);
        session_regenerate_id(true);
    }

    public static function check(): bool
    {
        return isset($_SESSION[self::$sessionKey]) && (int) $_SESSION[self::$sessionKey] > 0;
    }

    public static function id(): ?int
    {
        return self::check() ? (int) $_SESSION[self::$sessionKey] : null;
    }

    public static function user(): ?array
    {
        $id = self::id();
        return $id ? User::find($id) : null;
    }

    public static function requireAdmin(): void
    {
        if (!self::check()) {
            header('Location: /admin/login');
            exit;
        }
    }
}
