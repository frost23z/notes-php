<?php

namespace Core;

use Exception;

class App
{
    private static Container $container;

    public static function bind($key, $resolver): void
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

    /**
     * @throws Exception
     */
    public static function resolve($key)
    {
        return static::getContainer()->resolve($key);
    }
}