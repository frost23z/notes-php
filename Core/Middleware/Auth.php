<?php

namespace Core\Middleware;

use Core\Router;
use Core\Session;

class Auth
{
    public function handle(): void
    {
        if (Session::isGuest()) {
            Router::redirect('/login');
        }
    }
}