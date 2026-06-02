<?php
// Acesso à home (variante com slider novo) enquanto o index.html "em breve" existe.
// Versão anterior arquivada em entrar_antigo.php.
$_SERVER['REQUEST_URI'] = '/';
$GLOBALS['HOME_VARIANT'] = 2;
require __DIR__ . '/index.php';
