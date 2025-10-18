<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = "Email is not valid";
}

if (!Validator::string($password, 6, 14)) {
    $errors['password'] = "Password must be at least 6 characters and no more than 14 characters long";
}

if (!empty($errors)) {
    return view("registration/create.view.php", [
        'heading' => "Create Account",
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

$result = $db->query("SELECT * FROM users WHERE email = :email", [
    'email' => $email
])->fetch();

if ($result) {
    $errors['email'] = "Email is already registered";

    return view("registration/create.view.php", [
        'heading' => "Create Account",
        'errors' => $errors
    ]);
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
    'email' => $email,
    'password' => $hashedPassword
]);

$userId = $db->lastInsertId();

login([
    'id' => $userId,
    'email' => $email
]);

header("Location: /notes");
exit();
