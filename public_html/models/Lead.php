<?php

declare(strict_types=1);

class Lead extends Model
{
    protected static string $table = 'leads';

    // Status: 1=Não lida, 2=Lida, 3=Respondida
    public const STATUS = [
        1 => 'Não lida',
        2 => 'Lida',
        3 => 'Respondida',
    ];

    public const STATUS_CORES = [
        1 => 'badge-danger',
        2 => 'badge-warning',
        3 => 'badge-success',
    ];

    public const ROW_CLASSES = [
        1 => 'lead-row-new',
        2 => 'lead-row-read',
        3 => 'lead-row-replied',
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

    public static function marcarLida(int $id): void
    {
        $lead = static::find($id);
        if ($lead && (int) $lead['status'] === 1) {
            static::update($id, ['status' => 2]);
        }
    }

    /** @deprecated use marcarLida */
    public static function marcarVisualizado(int $id): void
    {
        static::marcarLida($id);
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
