<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Load application bootstrap if needed for feature tests
        if (!defined('BASE_PATH')) {
            define('BASE_PATH', dirname(__DIR__) . '/');
        }

        // Load helper functions
        require_once BASE_PATH . 'vendor/autoload.php';
        require_once BASE_PATH . 'Core/functions.php';
    }
}
