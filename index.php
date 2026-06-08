<?php

// Autoloader
if (is_file(__DIR__ . '/../storage/vendor/autoload.php')) {
    require_once(__DIR__ . '/../storage/vendor/autoload.php');
}

use Silkway\System\Bootstrap;

// Bootstrap
Bootstrap::run();

// Version
define('VERSION', '3.0.3.7');

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: install/index.php');
	exit;
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('catalog');