<?php

declare(strict_types=1);

class Router
{
    private array $routes = [];

    public function get(string $path, $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    private function add(string $method, string $path, $handler): void
    {
        $this->routes[] = compact('method', 'path', 'handler');
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = strtok($uri, '?');
        $uri = '/' . trim($uri, '/');

        foreach ($this->routes as $route) {
            if ($route['method'] !== strtoupper($method)) {
                continue;
            }
            $params = $this->match($route['path'], $uri);
            if ($params !== false) {
                $this->run($route['handler'], $params);
                return;
            }
        }

        $this->notFound();
    }

    private function match(string $path, string $uri): array|false
    {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';
        if (preg_match($pattern, $uri, $matches)) {
            return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        }
        return false;
    }

    private function run($handler, array $params): void
    {
        if (is_callable($handler)) {
            call_user_func_array($handler, $params);
            return;
        }

        [$class, $method] = explode('@', $handler);

        if (!class_exists($class)) {
            $this->notFound();
            return;
        }

        $controller = new $class();
        if (!method_exists($controller, $method)) {
            $this->notFound();
            return;
        }

        call_user_func_array([$controller, $method], $params);
    }

    private function notFound(): void
    {
        http_response_code(404);
        require ROOT . '/views/site/404.php';
        exit;
    }
}
