<?php

namespace Http\Forms;

use Core\ValidationException;

abstract class BaseForm
{
    protected array $errors = [];
    protected array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->rules();
    }

    abstract protected function rules(): void;

    /**
     * @throws ValidationException
     */
    public static function validate(array $attributes): static
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

    /**
     * @throws ValidationException
     */
    public function throw(): never
    {
        ValidationException::throw($this->errors, $this->attributes);
    }

    public function error(string $field, string $message): static
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
