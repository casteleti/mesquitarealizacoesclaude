<?php

declare(strict_types=1);

class Configuracao extends Model
{
    protected static string $table = 'configuracoes';

    public static function getAll(): array
    {
        static $cache = null;
        if ($cache !== null) {
            return $cache;
        }
        $rows = static::query('SELECT chave, valor FROM configuracoes')->fetchAll();
        $cache = [];
        foreach ($rows as $row) {
            $cache[$row['chave']] = $row['valor'];
        }
        return $cache;
    }

    public static function get(string $key, mixed $default = ''): mixed
    {
        return static::getAll()[$key] ?? $default;
    }

    public static function saveAll(array $data): void
    {
        $db = Database::getInstance();
        $stmt = $db->prepare(
            'INSERT INTO configuracoes (chave, valor) VALUES (?, ?)
             ON DUPLICATE KEY UPDATE valor = VALUES(valor)'
        );
        foreach ($data as $key => $value) {
            $stmt->execute([$key, $value]);
        }
    }
}
