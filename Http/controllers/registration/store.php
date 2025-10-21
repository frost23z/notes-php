<?php

use Core\App;
use Core\Authenticator;
use Core\Repositories\UserRepository;
use Core\Router;
use Http\Forms\RegisterForm;

$form = RegisterForm::validate($_POST);

$userRepo = App::resolve(UserRepository::class);

// Check if email already exists
if ($userRepo->existsByEmail($form->email)) {
    $form->error('email', 'This email is already registered')->throw();
}

// Create new user
$hashedPassword = password_hash($form->password, PASSWORD_BCRYPT);
$userId = $userRepo->create($form->email, $hashedPassword);

// Log in the new user
$authenticator = new Authenticator();
$authenticator->login([
    'id' => $userId,
    'email' => $form->email
]);

Router::redirect('/notes');