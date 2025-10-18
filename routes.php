<?php

$router->add('get', '/', 'index.php');
$router->add('get', '/about', 'about.php');

// Notes resource - RESTful routes (protected by auth middleware)
$router->add('get', '/notes', 'notes/index.php')->only('auth');
$router->add('get', '/notes/create', 'notes/create.php')->only('auth');
$router->add('post', '/notes', 'notes/store.php')->only('auth');
$router->add('get', '/notes/show', 'notes/show.php')->only('auth');
$router->add('get', '/notes/edit', 'notes/edit.php')->only('auth');
$router->add('patch', '/notes/update', 'notes/update.php')->only('auth');
$router->add('delete', '/notes/destroy', 'notes/destroy.php')->only('auth');

// Authentication routes (protected by guest middleware)
$router->add('get', '/register', 'registration/create.php')->only('guest');
$router->add('post', '/register', 'registration/store.php')->only('guest');

$router->add('get', '/login', 'session/create.php')->only('guest');
$router->add('post', '/login', 'session/store.php')->only('guest');

// Logout (protected by auth middleware)
$router->add('delete', '/logout', 'session/destroy.php')->only('auth');