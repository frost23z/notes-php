<?php

namespace Core;

class App
{
    private static Container $container;

    public static function bind($key, $resolver)
    {
        static::getContainer()->bind($key, $resolver);
    }

    public static function getContainer(): Container
    {
        return static::$container;
    }

    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    public static function resolve($key)
    {
        return static::getContainer()->resolve($key);
    }
}