<?php
require "Database.php";
require "Validator.php";

$config = require "config.php";
$db = new Database($config['db']);

$heading = "Create Note";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
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
}

require "views/notes/create.view.php";