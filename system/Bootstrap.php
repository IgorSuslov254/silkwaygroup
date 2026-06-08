<?php

namespace Silkway\System;

use Dotenv\Dotenv;

class Bootstrap
{
    /**
     * @return void
     */
    public static function run(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }
}