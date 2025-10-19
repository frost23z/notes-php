<?php

namespace Core\Middleware;

use Exception;

class Middleware
{
    public const array MAP = [
        'auth' => Auth::class,
        'guest' => Guest::class
    ];

    /**
     * Resolve and execute middleware by key.
     * @throws Exception If the middleware key is not found in MAP
     */
    public static function resolve($key)
    {
        if (!$key) return null;

        $middleware = self::MAP[$key] ?? false;
        if (!$middleware) {
            throw new Exception("Middleware $key not found in the middleware map.");
        }
        (new $middleware)->handle();
    }
}