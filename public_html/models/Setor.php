<?php

declare(strict_types=1);

class Setor extends Model
{
    protected static string $table = 'setores';

    public static function ativos(): array
    {
        return static::findAll('ativo = 1', [], 'ordem ASC');
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = static::query('SELECT * FROM setores WHERE slug = ? AND ativo = 1 LIMIT 1', [$slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function todosAdmin(): array
    {
        return static::query(
            'SELECT s.*, COUNT(o.id) AS obras_count
             FROM setores s
             LEFT JOIN obras o ON o.setor_id = s.id AND o.ativo = 1
             GROUP BY s.id
             ORDER BY s.ordem ASC'
        )->fetchAll();
    }

    /**
     * Retorna setores em destaque configurados no painel.
     * Ordem respeitada: posições 1-4 definidas em configuracoes.
     * Fallback: 4 primeiros ativos se nenhum configurado.
     */
    public static function destaques(): array
    {
        $config = Configuracao::getAll();
        $ids = [];
        for ($i = 1; $i <= 4; $i++) {
            $id = (int) ($config['setor_destaque_' . $i] ?? 0);
            if ($id > 0) {
                $ids[$i] = $id;
            }
        }

        if (empty($ids)) {
            // fallback: 4 primeiros ativos
            return static::query(
                'SELECT * FROM setores WHERE ativo = 1 ORDER BY ordem ASC LIMIT 4'
            )->fetchAll();
        }

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $rows = static::query(
            "SELECT * FROM setores WHERE id IN ($placeholders) AND ativo = 1",
            array_values($ids)
        )->fetchAll();

        // Reordenar conforme posições 1-4
        $indexed = [];
        foreach ($rows as $row) {
            $indexed[$row['id']] = $row;
        }
        $result = [];
        foreach ($ids as $pos => $id) {
            if (isset($indexed[$id])) {
                $result[] = $indexed[$id];
            }
        }
        return $result;
    }

    public static function comObras(): array
    {
        return static::query(
            'SELECT s.* FROM setores s
             INNER JOIN obras o ON o.setor_id = s.id AND o.ativo = 1
             WHERE s.ativo = 1
             GROUP BY s.id
             ORDER BY s.ordem ASC'
        )->fetchAll();
    }
}
