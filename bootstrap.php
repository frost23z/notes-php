<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Repositories\NoteRepository;
use Core\Repositories\UserRepository;

$container = new Container();

$container->bind(Database::class, function () {
    $config = require base_path("config.php");
    return new Database($config['db']);
});

$container->bind(NoteRepository::class, function () {
    return new NoteRepository();
});

$container->bind(UserRepository::class, function () {
    return new UserRepository();
});

App::setContainer($container);