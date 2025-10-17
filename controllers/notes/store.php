<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$errors = Validator::validateNoteData($_POST);
$title = $_POST['title'];
$content = $_POST['content'];

if (empty($errors)) {
    $db->query("INSERT INTO notes (title, content, user_id) VALUES (:title, :content, :user_id)", [
        'title' => $title,
        'content' => $content,
        'user_id' => 1 // Replace with actual user ID
    ]);

    header("Location: /notes");
    exit();
}

view("notes/create.view.php", [
    'heading' => "Create Note",
    'errors' => $errors
]);
