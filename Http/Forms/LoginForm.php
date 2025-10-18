<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected array $errors = [];

    public function validate(string $email, string $password): bool
    {
        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($password, 6, 14)) {
            $this->errors['password'] = "Password must be between 6 and 14 characters";
        }

        return empty($this->errors);
    }

    public function error(string $field, string $message): self
    {
        $this->errors[$field] = $message;
        return $this;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}