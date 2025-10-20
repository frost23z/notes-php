<?php

namespace Core;

use Exception;

class ValidationException extends Exception
{
    public function __construct(protected array $errors, protected array $old = [])
    {
        parent::__construct('Validation failed');
    }

    /**
     * @throws ValidationException
     */
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
