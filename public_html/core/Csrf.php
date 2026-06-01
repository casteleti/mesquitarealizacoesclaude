<?php

declare(strict_types=1);

class Csrf
{
    public static function token(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function field(): string
    {
        return '<input type="hidden" name="_token" value="' . self::token() . '">';
    }

    public static function meta(): string
    {
        return '<meta name="csrf-token" content="' . self::token() . '">';
    }

    public static function verify(): void
    {
        $token = $_POST['_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (!hash_equals(self::token(), $token)) {
            http_response_code(419);
            die(json_encode(['error' => 'CSRF token mismatch']));
        }
    }

    public static function isValid(string $token): bool
    {
        return hash_equals(self::token(), $token);
    }
}
