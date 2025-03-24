<?php

namespace App\Http\Router;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    private function add(HttpMethodsEnum $method, string $path, string $controller, string $action): void
    {
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<\1>[^/]+)', $path);
        $pattern = "#^{$pattern}$#";
        $this->routes[$method->value][$pattern] = [$controller, $action];
    }

    public function get(string $path, string $controller, string $method): void
    {
        $this->add(HttpMethodsEnum::GET, $path, $controller, $method);
    }

    public function post(string $path, string $controller, string $method): void
    {
        $this->add(HttpMethodsEnum::POST, $path, $controller, $method);
    }

    public function dispatch(): mixed
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['PATH_INFO'] ?? '/';

        foreach ($this->routes[$method] as $pattern => [$controller, $action]) {
            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter(
                    $matches,
                    fn($key) => !is_int($key),
                    ARRAY_FILTER_USE_KEY
                );
                
                return call_user_func_array([new $controller, $action], $params);
            }
        }

        http_response_code(404);
        return '404 Not Found';
    }
}