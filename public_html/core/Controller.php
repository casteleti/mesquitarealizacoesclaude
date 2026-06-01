<?php

declare(strict_types=1);

abstract class Controller
{
    protected function view(string $template, array $data = []): void
    {
        $file = ROOT . '/views/' . $template . '.php';
        if (!file_exists($file)) {
            http_response_code(500);
            die('View not found: ' . htmlspecialchars($template));
        }

        extract($data);

        ob_start();
        require $file;
        $content = ob_get_clean();

        if (str_starts_with($template, 'admin/')) {
            $authPages = ['admin/login', 'admin/error'];
            $layout = in_array($template, $authPages)
                ? ROOT . '/views/admin/auth-layout.php'
                : ROOT . '/views/admin/layout.php';
        } else {
            if (!isset($settings)) {
                $settings = $config ?? $GLOBALS['config_app'] ?? [];
            }
            $layout = ROOT . '/views/site/layout.php';
        }

        require $layout;
    }

    protected function json(mixed $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    protected function redirect(string $url, int $status = 302): void
    {
        header('Location: ' . $url, true, $status);
        exit;
    }

    protected function abort(int $code = 404): void
    {
        http_response_code($code);
        $config   = Configuracao::getAll();
        $settings = $config;
        $seo      = Seo::meta(['title' => 'Página não encontrada'], $config);
        $this->view('site/404', compact('config', 'settings', 'seo'));
        exit;
    }

    protected function requireAdmin(): void
    {
        Auth::requireAdmin();
    }

    protected function csrfVerify(): void
    {
        Csrf::verify();
    }

    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'][$type] = $message;
    }

    protected function old(string $key, mixed $default = ''): mixed
    {
        return $_SESSION['old'][$key] ?? $default;
    }

    protected function input(string $key, mixed $default = ''): mixed
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    protected function inputs(): array
    {
        return array_merge($_GET ?? [], $_POST ?? []);
    }
}
