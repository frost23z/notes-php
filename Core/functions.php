<?php

use Core\Response;
use Core\Session;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn]
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die;
}

function authorize($condition, $status = Response::HTTP_FORBIDDEN): bool
{
    if (!$condition) {
        abort($status);
    }
    return true;
}

#[NoReturn]
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

function view($path, $attributes = []): void
{
    extract($attributes);
    require base_path("views/" . $path);
}

function old(string $key, $default = '')
{
    return Session::get('old')[$key] ?? $default;
}

/**
 * Flash message helpers
 */
function success(string $message): void
{
    Session::flash('success', $message);
}

function error(string $message): void
{
    Session::flash('error', $message);
}

function warning(string $message): void
{
    Session::flash('warning', $message);
}

function info(string $message): void
{
    Session::flash('info', $message);
}

function authorizeNoteOwner(array $note): void
{
    authorize($note['user_id'] === Session::user()['id']);
}