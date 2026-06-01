<?php

declare(strict_types=1);

class LoginAttempt extends Model
{
    protected static string $table = 'login_attempts';

    public static function isBlocked(string $ip): bool
    {
        $count = (int) static::query(
            'SELECT COUNT(*) FROM login_attempts
             WHERE ip = ? AND attempted_at >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)',
            [$ip]
        )->fetchColumn();
        return $count >= 5;
    }

    public static function record(string $ip): void
    {
        static::insert(['ip' => $ip, 'attempted_at' => date('Y-m-d H:i:s')]);
    }

    public static function clear(string $ip): void
    {
        static::query('DELETE FROM login_attempts WHERE ip = ?', [$ip]);
    }
}
