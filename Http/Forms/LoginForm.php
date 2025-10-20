<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm extends BaseForm
{
    protected function rules(): void
    {
        if (!Validator::email($this->attributes['email'] ?? '')) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($this->attributes['password'] ?? '', 6, 14)) {
            $this->errors['password'] = "Password must be between 6 and 14 characters";
        }
    }
}