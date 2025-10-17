<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    public function get($uri, $controller): void
    {
        $this->add('GET', $uri, $controller);
    }

    public function add($method, $uri, $controller): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $controller
        ];

    }

    public function post($uri, $controller): void
    {
        $this->add('POST', $uri, $controller);
    }

    public function put($uri, $controller): void
    {
        $this->add('PUT', $uri, $controller);
    }

    public function delete($uri, $controller): void
    {
        $this->add('DELETE', $uri, $controller);
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }
        $this->abort();
    }

    #[NoReturn]
    public function abort($code = Response::HTTP_NOT_FOUND): void
    {
        http_response_code($code);
        view("{$code}.php");
        die();
    }
}