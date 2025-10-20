<?php

namespace Core;

use Core\Middleware\Middleware;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class Router
{
    protected array $routes = [];

    /**
     * Redirect to a different URL.
     */
    #[NoReturn]
    public static function redirect(string $path, bool $replace = true, int $response_code = 0): void
    {
        header("Location: $path", $replace, $response_code);
        exit();
    }

    /**
     * Attach middleware to the last registered route.
     */
    public function only($key): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    /**
     * Register a GET route.
     */
    public function get($uri, $controller): void
    {
        $this->add('GET', $uri, $controller);
    }

    /**
     * Add a route to the router.
     */
    public function add($method, $uri, $controller): static
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $controller,
            'middleware' => null
        ];

        return $this;
    }

    /**
     * Register a POST route.
     */
    public function post($uri, $controller): void
    {
        $this->add('POST', $uri, $controller);
    }

    /**
     * Register a PUT route.
     */
    public function put($uri, $controller): void
    {
        $this->add('PUT', $uri, $controller);
    }

    /**
     * Register a DELETE route.
     */
    public function delete($uri, $controller): void
    {
        $this->add('DELETE', $uri, $controller);
    }

    /**
     * Route an incoming HTTP request to the appropriate controller.
     * @throws Exception If middleware resolution fails
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                return require base_path("Http/controllers/{$route['controller']}");
            }
        }
        $this->abort();
    }

    /**
     * Abort the request with an HTTP error code.
     */
    #[NoReturn]
    public function abort($code = Response::HTTP_NOT_FOUND): void
    {
        http_response_code($code);
        view("$code.php");
        die();
    }

    /**
     * Get the previous URL from the HTTP referer header.
     */
    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}