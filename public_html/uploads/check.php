<?php
// Diagnóstico temporário — remover após uso
$dir = __DIR__;
echo "Diretório: $dir\n";
echo "Gravável: " . (is_writable($dir) ? 'SIM' : 'NÃO') . "\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "file_uploads: " . (ini_get('file_uploads') ? 'ON' : 'OFF') . "\n";

$sub = $dir . '/setores';
echo "uploads/setores existe: " . (is_dir($sub) ? 'SIM' : 'NÃO') . "\n";
echo "uploads/setores gravável: " . (is_writable($sub) ? 'SIM' : 'NÃO') . "\n";
