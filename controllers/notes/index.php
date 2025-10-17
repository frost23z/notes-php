<?php

$config = require base_path("config.php");
$db = new Core\Database($config['db']);

$notes = $db->query('SELECT * FROM notes where user_id = :user_id', ['user_id' => 1])->fetchAll();

view("notes/index.view.php", [
    'heading' => "My Notes",
    'notes' => $notes
]);