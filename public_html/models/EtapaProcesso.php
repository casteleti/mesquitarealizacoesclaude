<?php

declare(strict_types=1);

class EtapaProcesso extends Model
{
    protected static string $table = 'etapas_processo';

    public static function ativos(): array
    {
        return static::findAll('ativo = 1', [], 'ordem ASC');
    }

    public static function primeiras(int $limit = 3): array
    {
        $stmt = static::query(
            'SELECT * FROM etapas_processo WHERE ativo = 1 ORDER BY ordem ASC LIMIT ?',
            [$limit]
        );
        return $stmt->fetchAll();
    }
}
