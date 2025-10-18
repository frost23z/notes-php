<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'auth' => Auth::class,
        'guest' => Guest::class
    ];

    public static function resolve($key)
    {
        if (!$key) return null;

        $middleware = self::MAP[$key] ?? false;
        if (!$middleware) {
            throw new \Exception("Middleware {$key} not found in the middleware map.");
        };
        (new $middleware)->handle();
    }
}