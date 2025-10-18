<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected array $errors = [];
    public function validate($email, $password): bool
    {
        if (!Validator::email($email)) {
            $this->errors['email'] = 'Email is invalid';
        }

        if (!Validator::string($password, 6, 14)) {
            $this->errors['password'] = "Password must be at least 6 characters and no more than 14 characters long";
        }

        return empty($this->errors);
    }

    public function errors(): array {
        return $this->errors;
    }
}