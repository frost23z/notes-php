<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class RegisterForm
{
    protected array $errors = [];
    protected array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::email($attributes['email'] ?? '')) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validator::string($attributes['password'] ?? '', 6, 14)) {
            $this->errors['password'] = "Password must be between 6 and 14 characters";
        }
    }

    public static function validate(array $attributes): self
    {
        $form = new static($attributes);

        if ($form->failed()) {
            $form->throw();
        }

        return $form;
    }

    public function failed(): bool
    {
        return !empty($this->errors);
    }

    public function throw(): void
    {
        throw new ValidationException($this->errors, $this->attributes);
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

    public function __get(string $key)
    {
        return $this->attributes[$key] ?? null;
    }
}
