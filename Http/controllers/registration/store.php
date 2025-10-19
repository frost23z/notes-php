<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\RegisterForm;

$form = RegisterForm::validate($_POST);

$db = App::resolve(Database::class);

// Check if email already exists
$user = $db->query("SELECT * FROM users WHERE email = :email", [
    'email' => $form->email
])->fetch();

if ($user) {
    $form->error('email', 'This email is already registered')->throw();
}

// Create new user
$hashedPassword = password_hash($form->password, PASSWORD_BCRYPT);

$db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
    'email' => $form->email,
    'password' => $hashedPassword
]);

$userId = $db->lastInsertId();

// Log in the new user
$authenticator = new Authenticator();
$authenticator->login([
    'id' => $userId,
    'email' => $form->email
]);

redirect('/notes');