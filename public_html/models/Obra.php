<?php

declare(strict_types=1);

class Obra extends Model
{
    protected static string $table = 'obras';

    public static function destaques(int $limit = 6): array
    {
        return static::query(
            'SELECT o.*, s.title AS setor_nome FROM obras o
             LEFT JOIN setores s ON s.id = o.setor_id
             WHERE o.ativo = 1 AND o.destaque = 1
             ORDER BY o.ordem ASC LIMIT ?',
            [$limit]
        )->fetchAll();
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = static::query(
            'SELECT o.*, s.title AS setor_nome, s.slug AS setor_slug
             FROM obras o
             LEFT JOIN setores s ON s.id = o.setor_id
             WHERE o.slug = ? AND o.ativo = 1 LIMIT 1',
            [$slug]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function relacionadas(int $id, ?int $setorId, int $limit = 3): array
    {
        if ($setorId) {
            $rows = static::query(
                'SELECT o.*, s.title AS setor_nome FROM obras o
                 LEFT JOIN setores s ON s.id = o.setor_id
                 WHERE o.ativo = 1 AND o.id != ? AND o.setor_id = ?
                 ORDER BY o.ordem ASC LIMIT ?',
                [$id, $setorId, $limit]
            )->fetchAll();
            if (count($rows) >= $limit) {
                return $rows;
            }
        }
        return static::query(
            'SELECT o.*, s.title AS setor_nome FROM obras o
             LEFT JOIN setores s ON s.id = o.setor_id
             WHERE o.ativo = 1 AND o.id != ?
             ORDER BY o.ordem ASC LIMIT ?',
            [$id, $limit]
        )->fetchAll();
    }

    public static function paginar(int $page, int $perPage, ?string $setor = null, ?string $busca = null): array
    {
        $where  = ['o.ativo = 1'];
        $params = [];

        if ($setor) {
            $where[]  = 's.slug = ?';
            $params[] = $setor;
        }

        $whereStr = implode(' AND ', $where);

        $total = (int) static::query(
            "SELECT COUNT(*) FROM obras o LEFT JOIN setores s ON s.id = o.setor_id WHERE $whereStr",
            $params
        )->fetchColumn();

        $offset = ($page - 1) * $perPage;

        $rows = static::query(
            "SELECT o.*, s.title AS setor_nome, s.slug AS setor_slug
             FROM obras o
             LEFT JOIN setores s ON s.id = o.setor_id
             WHERE $whereStr
             ORDER BY o.ordem ASC
             LIMIT ? OFFSET ?",
            array_merge($params, [$perPage, $offset])
        )->fetchAll();

        return [
            'data'         => $rows,
            'total'        => $total,
            'per_page'     => $perPage,
            'current_page' => $page,
            'last_page'    => (int) ceil($total / $perPage),
        ];
    }

    public static function todosAdmin(): array
    {
        return static::query(
            'SELECT o.*, s.title AS setor_nome FROM obras o
             LEFT JOIN setores s ON s.id = o.setor_id
             ORDER BY o.ordem ASC, o.created_at DESC'
        )->fetchAll();
    }

    public static function todosParaFiltro(?string $setor = null): array
    {
        $where  = ['o.ativo = 1'];
        $params = [];
        if ($setor) {
            $where[]  = 's.slug = ?';
            $params[] = $setor;
        }
        $whereStr = implode(' AND ', $where);
        return static::query(
            "SELECT o.*, s.title AS setor_nome, s.slug AS setor_slug
             FROM obras o LEFT JOIN setores s ON s.id = o.setor_id
             WHERE $whereStr ORDER BY o.ordem ASC",
            $params
        )->fetchAll();
    }
}
