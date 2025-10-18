<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$id = $_POST['id'];

$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $id])->fetchOrFail();

authorize($note['user_id'] === 1);

$errors = Validator::validateNoteData($_POST);

if (empty($errors)) {
    $db->query("UPDATE notes SET title = :title, content = :content WHERE id = :id", [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'id' => $id
    ]);

    header("Location: /notes/show?id={$id}");
    exit();
}

view("notes/edit.view.php", [
    'heading' => "Edit Note",
    'note' => $note,
    'errors' => $errors
]);
