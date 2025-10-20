<?php

// Home - landing page (guest) or notes list (authenticated)
$router->add('get', '/', 'index.php');

// Authentication
$router->add('get', '/register', 'registration/create.php')->only('guest');
$router->add('post', '/register', 'registration/store.php')->only('guest');
$router->add('get', '/login', 'session/create.php')->only('guest');
$router->add('post', '/login', 'session/store.php')->only('guest');
$router->add('delete', '/logout', 'session/destroy.php')->only('auth');

// Notes - RESTful routing
$router->add('get', '/notes', 'notes/index.php')->only('auth');           // List all notes
$router->add('get', '/notes/create', 'notes/create.php')->only('auth');   // Show create form
$router->add('post', '/notes', 'notes/store.php')->only('auth');          // Store new note
$router->add('get', '/notes/show', 'notes/show.php')->only('auth');       // Show single note (uses ?id=)
$router->add('get', '/notes/edit', 'notes/edit.php')->only('auth');       // Show edit form (uses ?id=)
$router->add('patch', '/notes', 'notes/update.php')->only('auth');        // Update note
$router->add('delete', '/notes', 'notes/destroy.php')->only('auth');      // Delete note