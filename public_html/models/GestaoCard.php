<?php

declare(strict_types=1);

class GestaoCard extends Model
{
    protected static string $table = 'gestao_cards';

    public static function ativos(): array
    {
        return static::findAll('ativo = 1', [], 'ordem ASC');
    }
}
