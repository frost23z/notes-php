<?php

$router->add('get', '/', 'controllers/index.php');
$router->add('get', '/about', 'controllers/about.php');

// Notes resource - RESTful routes
$router->add('get', '/notes', 'controllers/notes/index.php');           // List all notes
$router->add('get', '/notes/create', 'controllers/notes/create.php');   // Show create form
$router->add('post', '/notes', 'controllers/notes/store.php');          // Store new note
$router->add('get', '/notes/show', 'controllers/notes/show.php');       // Show single note
$router->add('get', '/notes/edit', 'controllers/notes/edit.php');       // Show edit form
$router->add('patch', '/notes/update', 'controllers/notes/update.php'); // Update note
$router->add('delete', '/notes/destroy', 'controllers/notes/destroy.php'); // Delete note