<?php

declare(strict_types=1);

class Lead extends Model
{
    protected static string $table = 'leads';

    // Status: 1=Novo, 2=Visualizado, 3=Em contato, 4=Convertido, 5=Descartado
    public const STATUS = [
        1 => 'Novo',
        2 => 'Visualizado',
        3 => 'Em contato',
        4 => 'Convertido',
        5 => 'Descartado',
    ];

    public const TIPOS_PROJETO = [
        'implantacao'               => 'Implantação',
        'expansao'                  => 'Expansão',
        'infraestrutura-produtiva'  => 'Infraestrutura produtiva',
        'infraestrutura-logistica'  => 'Infraestrutura logística',
        'outro'                     => 'Outro',
    ];

    public static function novos(): int
    {
        return static::count('status = 1');
    }

    public static function marcarVisualizado(int $id): void
    {
        $lead = static::find($id);
        if ($lead && (int) $lead['status'] === 1) {
            static::update($id, ['status' => 2]);
        }
    }

    public static function isRateLimited(string $ip): bool
    {
        $limit = config('rate_limit.contact_per_hour', 3);
        $count = (int) static::query(
            'SELECT COUNT(*) FROM leads WHERE ip = ? AND created_at >= DATE_SUB(NOW(), INTERVAL 1 HOUR)',
            [$ip]
        )->fetchColumn();
        return $count >= $limit;
    }
}
