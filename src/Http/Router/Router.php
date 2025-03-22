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
        $this->routes[$method->value][$path] = [$controller, $action];
    }

    public function get(string $path, string $controller, string $method): void
    {
        $this->add(HttpMethodsEnum::GET, $path, $controller, $method);
    }

    public function post(string $path, string $controller, string $method): void
    {
        $this->add(HttpMethodsEnum::POST, $path, $controller, $method);
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['PATH_INFO'] ?? '/';
        [$controller, $action] = $this->routes[$method][$path] ?? [null, null];
        
        if (!$controller || !$action) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        call_user_func([new $controller, $action]);
    }
}