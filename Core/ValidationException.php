<?php

namespace Core;

class ValidationException extends \Exception
{
    protected array $errors;
    protected array $old;

    public function __construct(array $errors, array $old = [])
    {
        $this->errors = $errors;
        $this->old = $old;

        parent::__construct('Validation failed');
    }

    public static function throw(array $errors, array $old = []): never
    {
        throw new static($errors, $old);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function old(): array
    {
        return $this->old;
    }
}
