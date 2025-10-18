<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = "Please enter a valid email address";
}

if (!Validator::string($password)) {
    $errors['password'] = "Please enter a password";
}

if (!empty($errors)) {
    return view("session/create.view.php", [
        'heading' => "Log In",
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query("SELECT * FROM users WHERE email = :email", [
    'email' => $email
])->fetch();

if (!$user) {
    return view("session/create.view.php", [
        'heading' => "Log In",
        'errors' => [
            'email' => "No account found with that email address"
        ]
    ]);
}

if (!password_verify($password, $user['password'])) {
    return view("session/create.view.php", [
        'heading' => "Log In",
        'errors' => [
            'password' => "Incorrect password"
        ]
    ]);
}

login($user);

header("Location: /notes");
exit();
