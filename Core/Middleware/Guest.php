<?php

namespace Core\Middleware;

use Core\Router;
use Core\Session;

class Guest
{
    public function handle(): void
    {
        if (!Session::isGuest()) {
            Router::redirect('/');
        }
    }
}
