<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = currentUser()['id'];

$notes = $db->query('SELECT * FROM notes where user_id = :user_id', ['user_id' => $currentUserId])->fetchAll();

view("notes/index.view.php", [
    'heading' => "My Notes",
    'notes' => $notes
]);