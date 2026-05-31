<?php

namespace Silkway\System;

use Dotenv\Dotenv;

class Bootstrap
{
    public static function run()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }
}