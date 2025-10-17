<?php

use Core\Database;

$config = require base_path("config.php");
$db = new Database($config['db']);


$id = $_GET['id'];

$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $id])->fetchOrFail();

authorize($note['user_id'] === 1);

view("notes/show.view.php", [
    'heading' => "Note Details",
    'note' => $note
]);