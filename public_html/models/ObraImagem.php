<?php

declare(strict_types=1);

class ObraImagem extends Model
{
    protected static string $table = 'obra_imagens';

    public static function deObra(int $obraId): array
    {
        return static::findAll('obra_id = ?', [$obraId], 'ordem ASC');
    }

    public static function primeira(int $obraId): ?array
    {
        $stmt = static::query(
            'SELECT * FROM obra_imagens WHERE obra_id = ? ORDER BY ordem ASC LIMIT 1',
            [$obraId]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function deleteDeObra(int $obraId): void
    {
        $imagens = static::deObra($obraId);
        foreach ($imagens as $img) {
            Upload::delete($img['caminho']);
        }
        static::query('DELETE FROM obra_imagens WHERE obra_id = ?', [$obraId]);
    }
}
