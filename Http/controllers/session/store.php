<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($_POST);

$authenticator = new Authenticator();

if (!$authenticator->attempt($form->email, $form->password)) {
    $form->error('email', 'No matching account found for that email address and password')->throw();
}

redirect('/notes');
