<?php

declare(strict_types=1);

class View
{
    public static function render(string $template, array $data = []): void
    {
        extract($data);
        require ROOT . '/views/' . $template . '.php';
    }

    public static function partial(string $partial, array $data = []): void
    {
        extract($data);
        require ROOT . '/views/' . $partial . '.php';
    }

    public static function escape(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public static function raw(mixed $value): string
    {
        return (string) $value;
    }
}
