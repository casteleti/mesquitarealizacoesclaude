<?php

declare(strict_types=1);

class Diferencial extends Model
{
    protected static string $table = 'diferenciais';

    // exibir_em: 1=Home, 2=Quem Somos, 3=Ambas
    public static function paraHome(): array
    {
        return static::findAll('ativo = 1 AND exibir_em IN (1,3)', [], 'ordem ASC');
    }

    public static function paraQuemSomos(): array
    {
        return static::findAll('ativo = 1 AND exibir_em IN (2,3)', [], 'ordem ASC');
    }
}
