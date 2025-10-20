<?php

use Core\ValidationException;

test('can create validation exception with errors', function () {
    $errors = ['email' => 'Invalid email'];

    $exception = new ValidationException($errors);

    expect($exception->errors())->toBe($errors)
        ->and($exception->old())->toBe([]);
});

test('can create validation exception with errors and old data', function () {
    $errors = ['email' => 'Invalid email'];
    $old = ['email' => 'invalid@'];

    $exception = new ValidationException($errors, $old);

    expect($exception->errors())->toBe($errors)
        ->and($exception->old())->toBe($old);
});

test('can throw validation exception statically', function () {
    ValidationException::throw(['field' => 'error'], ['field' => 'value']);
})->throws(ValidationException::class, 'Validation failed');

test('exception message is validation failed', function () {
    $exception = new ValidationException(['field' => 'error']);

    expect($exception->getMessage())->toBe('Validation failed');
});

test('can access errors after catching exception', function () {
    try {
        ValidationException::throw(['email' => 'Invalid', 'password' => 'Too short']);
    } catch (ValidationException $e) {
        expect($e->errors())->toHaveKey('email')
            ->and($e->errors())->toHaveKey('password')
            ->and($e->errors()['email'])->toBe('Invalid');
    }
});
