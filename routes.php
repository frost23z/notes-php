<?php

$router->add('get', '/', 'controllers/index.php');
$router->add('get', '/about', 'controllers/about.php');

// Notes resource - RESTful routes (protected by auth middleware)
$router->add('get', '/notes', 'controllers/notes/index.php')->only('auth');
$router->add('get', '/notes/create', 'controllers/notes/create.php')->only('auth');
$router->add('post', '/notes', 'controllers/notes/store.php')->only('auth');
$router->add('get', '/notes/show', 'controllers/notes/show.php')->only('auth');
$router->add('get', '/notes/edit', 'controllers/notes/edit.php')->only('auth');
$router->add('patch', '/notes/update', 'controllers/notes/update.php')->only('auth');
$router->add('delete', '/notes/destroy', 'controllers/notes/destroy.php')->only('auth');

// Authentication routes (protected by guest middleware)
$router->add('get', '/register', 'controllers/registration/create.php')->only('guest');
$router->add('post', '/register', 'controllers/registration/store.php')->only('guest');

$router->add('get', '/login', 'controllers/session/create.php')->only('guest');
$router->add('post', '/login', 'controllers/session/store.php')->only('guest');

// Logout (protected by auth middleware)
$router->add('delete', '/logout', 'controllers/session/destroy.php')->only('auth');