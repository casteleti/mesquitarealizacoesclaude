<?php

declare(strict_types=1);

class User extends Model
{
    protected static string $table = 'users';

    public static function findByEmail(string $email): ?array
    {
        $stmt = static::query('SELECT * FROM users WHERE email = ? LIMIT 1', [$email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}
