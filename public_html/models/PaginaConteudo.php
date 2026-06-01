<?php

declare(strict_types=1);

class PaginaConteudo extends Model
{
    protected static string $table = 'pagina_conteudos';

    public static function paginas(): array
    {
        return ['home', 'quem-somos', 'setores', 'obras', 'como-atuamos', 'contato'];
    }

    public static function get(string $pagina): array
    {
        $stmt = static::query(
            'SELECT campos FROM pagina_conteudos WHERE pagina = ? LIMIT 1',
            [$pagina]
        );
        $row = $stmt->fetch();
        if (!$row) {
            return [];
        }
        return json_decode($row['campos'], true) ?: [];
    }

    public static function save(string $pagina, array $campos): void
    {
        $exists = static::query(
            'SELECT id FROM pagina_conteudos WHERE pagina = ? LIMIT 1',
            [$pagina]
        )->fetch();

        $json = json_encode($campos, JSON_UNESCAPED_UNICODE);

        if ($exists) {
            static::query(
                'UPDATE pagina_conteudos SET campos = ?, updated_at = NOW() WHERE pagina = ?',
                [$json, $pagina]
            );
        } else {
            static::query(
                'INSERT INTO pagina_conteudos (pagina, campos, created_at, updated_at) VALUES (?, ?, NOW(), NOW())',
                [$pagina, $json]
            );
        }
    }

    public static function campo(string $pagina, string $chave, mixed $default = ''): mixed
    {
        $campos = static::get($pagina);
        return $campos[$chave] ?? $default;
    }
}
