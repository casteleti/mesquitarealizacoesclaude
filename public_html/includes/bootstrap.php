<?php

declare(strict_types=1);

// Error reporting
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// Timezone
date_default_timezone_set('America/Sao_Paulo');

// Session
ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');
if (PHP_VERSION_ID >= 70300) {
    ini_set('session.cookie_samesite', 'Lax');
}
session_name('mesquita_sess');
session_start();

// Autoloader — loads from core/, models/, controllers/
spl_autoload_register(function (string $class): void {
    $dirs = [
        ROOT . '/core/',
        ROOT . '/models/',
        ROOT . '/controllers/',
    ];
    foreach ($dirs as $dir) {
        $file = $dir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Load helpers
require_once ROOT . '/includes/helpers.php';

// Load config
$GLOBALS['config_app'] = require ROOT . '/config/app.php';
$GLOBALS['config_db']  = require ROOT . '/config/database.php';

// Boot database connection
Database::getInstance();
