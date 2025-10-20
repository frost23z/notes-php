<?php

use Core\Container;

beforeEach(function () {
    $this->container = new Container();
});

test('can bind and resolve a simple value', function () {
    $this->container->bind('test', fn() => 'value');

    expect($this->container->resolve('test'))->toBe('value');
});

test('can bind and resolve a class', function () {
    $this->container->bind('database', fn() => new stdClass());

    $result = $this->container->resolve('database');

    expect($result)->toBeInstanceOf(stdClass::class);
});

test('can bind with closure that receives container', function () {
    $this->container->bind('config', fn() => ['key' => 'value']);
    $this->container->bind('service', fn() => [
        'config' => $this->container->resolve('config')
    ]);

    $service = $this->container->resolve('service');

    expect($service['config'])->toBe(['key' => 'value']);
});

test('throws exception when binding not found', function () {
    $this->container->resolve('nonexistent');
})->throws(Exception::class, 'No matching binding found for key nonexistent');

test('can override existing binding', function () {
    $this->container->bind('test', fn() => 'first');
    $this->container->bind('test', fn() => 'second');

    expect($this->container->resolve('test'))->toBe('second');
});
