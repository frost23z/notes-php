<?php

use Core\Validator;

test('string validates correctly', function () {
    expect(Validator::string('hello'))->toBeTrue()
        ->and(Validator::string(''))->toBeFalse()
        ->and(Validator::string('   '))->toBeFalse(); // whitespace only
});

test('string validates with minimum length', function () {
    expect(Validator::string('hello', 3))->toBeTrue()
        ->and(Validator::string('hi', 3))->toBeFalse();
});

test('string validates with maximum length', function () {
    expect(Validator::string('hello', 1, 10))->toBeTrue()
        ->and(Validator::string('hello world', 1, 5))->toBeFalse();
});

test('string validates with exact length range', function () {
    expect(Validator::string('hello', 5, 5))->toBeTrue()
        ->and(Validator::string('hi', 5, 5))->toBeFalse()
        ->and(Validator::string('hello world', 5, 5))->toBeFalse();
});

test('email validates correctly', function () {
    expect(Validator::email('test@example.com'))->toBeTrue()
        ->and(Validator::email('test@test.co.uk'))->toBeTrue()
        ->and(Validator::email('invalid'))->toBeFalse()
        ->and(Validator::email('invalid@'))->toBeFalse()
        ->and(Validator::email('@invalid.com'))->toBeFalse()
        ->and(Validator::email(''))->toBeFalse();
});
