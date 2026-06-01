<?php

// Detecta ambiente pelo hostname
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$isProduction = !in_array($host, ['localhost', 'mesquitarealizacoesclaude.test', '127.0.0.1'], true)
             && !str_starts_with($host, '192.168.')
             && !str_ends_with($host, '.test');

if ($isProduction) {
    return [
        'host'     => 'dbmesquita.vpscronos0842.mysql.dbaas.com.br',
        'database' => 'dbmesquita',
        'username' => 'dbmesquita',
        'password' => 'Mes@!3dbmy@#56!',
        'charset'  => 'utf8mb4',
    ];
}

// Local (Laragon)
return [
    'host'     => 'localhost',
    'database' => 'mesquitarealizacoes',
    'username' => 'root',
    'password' => '',
    'charset'  => 'utf8mb4',
];
