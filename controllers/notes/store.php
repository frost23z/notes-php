<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = Validator::validateNoteData($_POST);
$title = $_POST['title'];
$content = $_POST['content'];

if (empty($errors)) {
    $db->query("INSERT INTO notes (title, content, user_id) VALUES (:title, :content, :user_id)", [
        'title' => $title,
        'content' => $content,
        'user_id' => currentUser()['id']
    ]);

    header("Location: /notes");
    exit();
}

view("notes/create.view.php", [
    'heading' => "Create Note",
    'errors' => $errors
]);
