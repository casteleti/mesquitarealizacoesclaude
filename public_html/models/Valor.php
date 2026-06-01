<?php

declare(strict_types=1);

class Valor extends Model
{
    protected static string $table = 'valores';

    public static function ativos(): array
    {
        return static::findAll('ativo = 1', [], 'ordem ASC');
    }
}
