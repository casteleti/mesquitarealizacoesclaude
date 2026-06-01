<?php

declare(strict_types=1);

class Banner extends Model
{
    protected static string $table = 'banners';

    public static function ativos(): array
    {
        return static::findAll('ativo = 1', [], 'ordem ASC');
    }
}
