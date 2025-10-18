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

function login($user)
{
    $_SESSION['user'] = [
        'id' => $user['id'],
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

function isGuest(): bool
{
    return !isset($_SESSION['user']);
}

function currentUser()
{
    return $_SESSION['user'] ?? null;
}