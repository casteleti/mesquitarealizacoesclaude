<?php

$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$isProduction = !in_array($host, ['localhost', 'mesquitarealizacoesclaude.test', '127.0.0.1'], true)
             && !str_starts_with($host, '192.168.')
             && !str_ends_with($host, '.test');

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$siteUrl = $isProduction ? $scheme . '://' . $host : 'http://mesquitarealizacoesclaude.test';

return [
    'name'     => 'Mesquita Realizações',
    'url'      => $siteUrl,
    'env'      => $isProduction ? 'production' : 'local',
    'debug'    => !$isProduction,
    'timezone' => 'America/Sao_Paulo',
    'locale'   => 'pt_BR',

    'session' => [
        'name'     => 'mesquita_sess',
        'lifetime' => 7200,
    ],

    'upload' => [
        'max_size'  => 8 * 1024 * 1024, // 8MB
        'allowed'   => ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'],
        'base_path' => ROOT . '/uploads',
        'base_url'  => '/uploads',
    ],

    'rate_limit' => [
        'contact_per_hour' => 3,
    ],

    'admin' => [
        'path'    => '/admin',
        'session' => 'admin_user_id',
    ],
];
