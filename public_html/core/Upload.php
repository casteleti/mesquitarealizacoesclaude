<?php

declare(strict_types=1);

class Upload
{
    private static array $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
    private static int   $maxSize = 8388608; // 8MB

    public static function image(array $file, string $folder, ?string $oldFile = null): string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Erro no upload do arquivo.');
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, self::$allowed, true)) {
            throw new RuntimeException('Formato não permitido. Use: ' . implode(', ', self::$allowed));
        }

        if ($file['size'] > self::$maxSize) {
            throw new RuntimeException('Arquivo muito grande. Máximo 8MB.');
        }

        if (!self::isImage($file['tmp_name'])) {
            throw new RuntimeException('Arquivo inválido.');
        }

        $dir = ROOT . '/uploads/' . trim($folder, '/');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $name = uniqid('', true) . '.' . $ext;
        $dest = $dir . '/' . $name;

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            throw new RuntimeException('Falha ao salvar o arquivo.');
        }

        if ($oldFile) {
            self::delete($oldFile);
        }

        return '/uploads/' . trim($folder, '/') . '/' . $name;
    }

    public static function delete(string $path): void
    {
        $full = ROOT . $path;
        if (file_exists($full) && is_file($full)) {
            unlink($full);
        }
    }

    private static function isImage(string $tmp): bool
    {
        $info = @getimagesize($tmp);
        if ($info === false) {
            // Allow SVG
            $mime = mime_content_type($tmp);
            return $mime === 'image/svg+xml' || str_starts_with($mime, 'image/');
        }
        $allowed = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP];
        return in_array($info[2], $allowed, true);
    }
}
