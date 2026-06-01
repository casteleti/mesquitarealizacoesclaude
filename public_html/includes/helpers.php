<?php

declare(strict_types=1);

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Retorna atributo style inline para o page-hero quando há imagem de fundo.
 * Mantém o gradiente escuro sobreposto para legibilidade do texto.
 */
function page_hero_style(string $imagePath): string
{
    if ($imagePath === '') {
        return '';
    }
    $url = upload_url($imagePath);
    return 'style="background: linear-gradient(112deg, rgba(24,25,28,.82) 0%, rgba(24,25,28,.72) 50%, rgba(31,41,55,.62) 100%), url(\'' . addslashes($url) . '\') center/cover no-repeat;"';
}

function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/');
}

function url(string $path = ''): string
{
    return '/' . ltrim($path, '/');
}

function upload_url(string $path): string
{
    return $path ? htmlspecialchars($path, ENT_QUOTES) : '';
}

function csrf_field(): string
{
    return Csrf::field();
}

function csrf_meta(): string
{
    return Csrf::meta();
}

function flash_messages(): void
{
    foreach (flash() as $type => $message) {
        echo '<div class="alert alert-' . e($type) . '">' . e($message) . '</div>';
    }
}

function flash(?string $type = null, ?string $message = null): array
{
    if ($type !== null && $message !== null) {
        $_SESSION['flash'][$type] = $message;
        return [];
    }
    $messages = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $messages;
}

function absolute_url(string $path = ''): string
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $scheme . '://' . $host . '/' . ltrim($path, '/');
}

function upload_absolute_url(string $path): string
{
    if (!$path) return '';
    if (str_starts_with($path, 'http')) return $path;
    return absolute_url($path);
}

function old(string $key, mixed $default = ''): mixed
{
    return $_SESSION['old'][$key] ?? $default;
}

function slug(string $text): string
{
    $text = mb_strtolower($text, 'UTF-8');
    $text = str_replace(
        ['á','à','ã','â','é','è','ê','í','ì','ó','ò','õ','ô','ú','ù','ü','ç','ñ'],
        ['a','a','a','a','e','e','e','i','i','o','o','o','o','u','u','u','c','n'],
        $text
    );
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', trim($text));
    return $text;
}

function truncate(string $text, int $length = 155): string
{
    $plain = strip_tags($text);
    if (mb_strlen($plain) <= $length) {
        return $plain;
    }
    return mb_substr($plain, 0, $length) . '...';
}

function phone_normalize(string $phone): string
{
    return preg_replace('/\D/', '', $phone);
}

function date_br(string $date): string
{
    return $date ? date('d/m/Y', strtotime($date)) : '';
}

function active_class(string $path, string $class = 'active'): string
{
    $current = strtok($_SERVER['REQUEST_URI'], '?');
    return $current === $path ? $class : '';
}

function is_admin_area(): bool
{
    return str_starts_with($_SERVER['REQUEST_URI'], '/admin');
}

function config(string $key, mixed $default = null): mixed
{
    $cfg = $GLOBALS['config_app'] ?? [];
    $keys = explode('.', $key);
    $value = $cfg;
    foreach ($keys as $k) {
        if (!is_array($value) || !array_key_exists($k, $value)) {
            return $default;
        }
        $value = $value[$k];
    }
    return $value;
}

/**
 * Render a Lucide icon name as inline SVG.
 * Falls back to a styled text label if the icon is unknown.
 */
function lucide_icon(string $name, string $class = 'icon', int $size = 24): string
{
    static $paths = [
        'factory'           => 'M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7-6H4a2 2 0 0 0-2 2v16zM14 2v6h6M12 12h.01M8 12h.01M16 12h.01M8 16h.01M12 16h.01M16 16h.01',
        'zap'               => 'M13 2 3 14h9l-1 8 10-12h-9l1-8z',
        'lightning'         => 'M13 2 3 14h9l-1 8 10-12h-9l1-8z',
        'industry'          => 'M2 20V8l7-6 7 6v12H2zM9 20v-5h4v5',
        'truck'             => 'M5 17H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v3m0 0h2l3 3v4h-2m-3 0H9m0 0a2 2 0 1 0 4 0 2 2 0 0 0-4 0M5 17a2 2 0 1 0 4 0 2 2 0 0 0-4 0',
        'crosshair'         => 'M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20zm0-17v4m0 6v4M2 12h4m12 0h4',
        'list-checks'       => 'M3 7h6m4 0h8M3 12h6m4 0h8M3 17h6m4 0h8M9 7l2 2 4-4m0 10l-4 4-2-2',
        'shield-check'      => 'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10zm-2-7 2 2 4-4',
        'check-circle'      => 'M22 11.08V12a10 10 0 1 1-5.93-9.14M22 4 12 14.01l-3-3',
        'users'             => 'M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75M9 7a4 4 0 1 0 0-8 4 4 0 0 0 0 8z',
        'clock'             => 'M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20zm0-14v4l2.5 2.5',
        'wrench'            => 'M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z',
        'hard-hat'          => 'M2 20h20M2 14a10 10 0 0 1 20 0M12 4V2m-4.5 3.5-1.5-1.5M16.5 5.5l1.5-1.5',
        'building'          => 'M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9zm6 11V10h6v10',
        'building-2'        => 'M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18zm-4 0h20M10 6h.01M14 6h.01M10 10h.01M14 10h.01M10 14h.01M14 14h.01',
        'buildings'         => 'M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18zm-4 0h20M10 6h.01M14 6h.01M10 10h.01M14 10h.01M10 14h.01M14 14h.01',
        'award'             => 'M12 15a7 7 0 1 0 0-14 7 7 0 0 0 0 14zm0 0v6m-3-3h6',
        'target'            => 'M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20zm0-6a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 0v.01',
        'layers'            => 'M12 2 2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5',
        'settings'          => 'M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.22-1.23.93.98a2 2 0 0 1 0 2.5l-.93.98a2 2 0 0 1-2.45.49l-1.18-.6a7.07 7.07 0 0 1-1.18.49l-.2 1.3a2 2 0 0 1-1.96 1.61H9.41a2 2 0 0 1-1.96-1.61l-.2-1.3a7.07 7.07 0 0 1-1.18-.49l-1.18.6a2 2 0 0 1-2.45-.49l-.93-.98a2 2 0 0 1 0-2.5l.93-.98c-.14-.43-.21-.88-.21-1.27s.07-.84.21-1.27l-.93-.98a2 2 0 0 1 0-2.5l.93-.98a2 2 0 0 1 2.45-.49l1.18.6c.37-.18.77-.35 1.18-.49l.2-1.3A2 2 0 0 1 9.41 3h1.18a2 2 0 0 1 1.96 1.61l.2 1.3c.41.14.81.31 1.18.49l1.18-.6a2 2 0 0 1 2.45.49l.93.98a2 2 0 0 1 0 2.5l-.93.98c.14.43.21.88.21 1.27s-.07.84-.21 1.27z',
        'leaf'              => 'M17 8C8 10 5.9 16.17 3.82 22M9.5 2.1A10 10 0 0 1 22 12.1M2 12h2m2-6.5 1.5 1.5M12 2v2m6.5 2-1.5 1.5',
        'flame'             => 'M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z',
        'sun'               => 'M12 7a5 5 0 1 0 0 10A5 5 0 0 0 12 7zm0-4v2m0 14v2M4.22 4.22l1.42 1.42m12.72 12.72 1.42 1.42M2 12h2m16 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42',
        'map-pin'           => 'M12 2a7 7 0 0 1 7 7c0 5.25-7 13-7 13S5 14.25 5 9a7 7 0 0 1 7-7zm0 9.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z',
        'phone'             => 'M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6A16 16 0 0 0 15.4 16.09l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z',
        'mail'              => 'M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm0 0 8 8 8-8',
    ];

    $name = strtolower(trim($name));
    if (!isset($paths[$name])) {
        return '<span class="' . e($class) . ' icon-text">' . e($name) . '</span>';
    }

    $d = $paths[$name];
    $s = (int) $size;
    return '<svg class="' . e($class) . '" xmlns="http://www.w3.org/2000/svg" width="' . $s . '" height="' . $s . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="' . $d . '"/></svg>';
}

/**
 * Renderiza ícone: prioriza arquivo enviado via upload,
 * cai em Lucide se só houver nome, ou retorna vazio.
 */
function render_icon(string $iconeArquivo, string $iconeName, string $class = 'icon', int $size = 28): string
{
    if ($iconeArquivo !== '') {
        $url = upload_url($iconeArquivo);
        $s   = (int) $size;
        return '<img src="' . e($url) . '" class="' . e($class) . ' icon-upload" width="' . $s . '" height="' . $s . '" alt="" aria-hidden="true" loading="lazy">';
    }
    if ($iconeName !== '') {
        return lucide_icon($iconeName, $class, $size);
    }
    return '';
}

function site_config(string $key, mixed $default = ''): mixed
{
    static $cache = null;
    if ($cache === null) {
        $cache = Configuracao::getAll();
    }
    return $cache[$key] ?? $default;
}
