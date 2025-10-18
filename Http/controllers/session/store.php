<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if (!$form->validate($email, $password)) {
    return view("session/create.view.php", [
        'heading' => "Log In",
        'errors' => $form->errors()
    ]);
}

$authenticator = new Authenticator();

if (!$authenticator->attempt($email, $password)) {
    $form->error('email', 'No matching account found for that email address and password');

    return view("session/create.view.php", [
        'heading' => "Log In",
        'errors' => $form->errors()
    ]);
}

header("Location: /notes");
exit();
