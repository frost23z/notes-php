<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$id = $_GET['id'];

$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $id])->fetchOrFail();

authorize($note['user_id'] === 1);

view("notes/show.view.php", [
    'heading' => "Note Details",
    'note' => $note
]);