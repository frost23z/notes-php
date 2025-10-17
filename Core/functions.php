<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die;
}

function urlIs($value)
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] === $value;
}

function authorize($condition, $status = Response::HTTP_FORBIDDEN): bool
{
    if (!$condition) {
        abort($status);
    }
    return true;
}

function abort($code = Response::HTTP_NOT_FOUND)
{
    http_response_code($code);
    view("{$code}.php");
    die();
}

function base_path($path = ''): string
{
    return BASE_PATH . ltrim($path, '/');
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/" . $path);
}