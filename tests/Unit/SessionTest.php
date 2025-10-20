<?php

use Core\Session;

beforeEach(function () {
    // Start session for tests
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // Clear session data before each test
    $_SESSION = [];
});

afterEach(function () {
    // Clean up session after each test
    $_SESSION = [];
});

test('can store value in session', function () {
    Session::put('test_key', 'test_value');

    expect($_SESSION['test_key'])->toBe('test_value');
});

test('can retrieve value from session', function () {
    $_SESSION['test_key'] = 'test_value';

    expect(Session::get('test_key'))->toBe('test_value');
});

test('can retrieve value with default', function () {
    expect(Session::get('nonexistent', 'default'))->toBe('default');
});

test('can check if key exists', function () {
    $_SESSION['test_key'] = 'value';

    expect(Session::has('test_key'))->toBeTrue()
        ->and(Session::has('nonexistent'))->toBeFalse();
});

test('can flash a value', function () {
    Session::flash('message', 'Hello');

    expect($_SESSION['_flash']['message'])->toBe('Hello');
});

test('flash values take priority over regular values', function () {
    $_SESSION['key'] = 'regular';
    $_SESSION['_flash']['key'] = 'flash';

    expect(Session::get('key'))->toBe('flash');
});

test('isGuest returns true when no user', function () {
    expect(Session::isGuest())->toBeTrue();
});

test('isGuest returns false when user exists', function () {
    $_SESSION['user'] = ['id' => 1, 'email' => 'test@test.com'];

    expect(Session::isGuest())->toBeFalse();
});

test('can get current user', function () {
    $user = ['id' => 1, 'email' => 'test@test.com'];
    $_SESSION['user'] = $user;

    expect(Session::user())->toBe($user);
});

test('user returns null when not logged in', function () {
    expect(Session::user())->toBeNull();
});

test('can flush all session data', function () {
    $_SESSION['key1'] = 'value1';
    $_SESSION['key2'] = 'value2';

    Session::flush();

    expect($_SESSION)->toBeEmpty();
});

test('can unflash data', function () {
    $_SESSION['_flash']['message'] = 'Hello';

    Session::unflash();

    expect($_SESSION)->not->toHaveKey('_flash');
});

test('can pull flash value', function () {
    $_SESSION['_flash']['message'] = 'Hello';

    $value = Session::pull('message');

    expect($value)->toBe('Hello')
        ->and($_SESSION['_flash'])->not->toHaveKey('message');
});
