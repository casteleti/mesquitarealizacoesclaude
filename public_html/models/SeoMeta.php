<?php

declare(strict_types=1);

class SeoMeta extends Model
{
    protected static string $table = 'seo_metas';

    public static function getByPage(string $pagina): ?array
    {
        $stmt = static::query('SELECT * FROM seo_metas WHERE pagina = ? LIMIT 1', [$pagina]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function savePage(string $pagina, array $data): void
    {
        $exists = static::query('SELECT id FROM seo_metas WHERE pagina = ?', [$pagina])->fetch();
        if ($exists) {
            static::update((int) $exists['id'], $data);
        } else {
            static::insert(array_merge(['pagina' => $pagina], $data));
        }
    }
}
