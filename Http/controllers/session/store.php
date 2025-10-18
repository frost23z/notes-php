<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if (!$form->validate($email, $password)) {
    return view("session/create.view.php", [
        'heading' => "Log In",
        'errors' => $form->errors()
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
