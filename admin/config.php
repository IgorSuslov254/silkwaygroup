<?php

// HTTP
define('HTTP_SERVER', "http://{$_SERVER['HTTP_HOST']}/admin/");
define('HTTP_CATALOG', "http://{$_SERVER['HTTP_HOST']}/");

// HTTPS
define('HTTPS_SERVER', "https://{$_SERVER['HTTP_HOST']}/admin/");
define('HTTPS_CATALOG', "https://{$_SERVER['HTTP_HOST']}/");

// DIR
define('DIR_APPLICATION', __DIR__ . '/');
define('DIR_SYSTEM', __DIR__ . '/../system/');
define('DIR_IMAGE', __DIR__ . '/../image/');
define('DIR_STORAGE', __DIR__ . '/../../storage/');
define('DIR_CATALOG', __DIR__ . '/../catalog/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/template/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_MODIFICATION', DIR_STORAGE . 'modification/');
define('DIR_SESSION', DIR_STORAGE . 'session/');
define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

// DB
define('DB_DRIVER', $_ENV['DB_DRIVER']);
define('DB_HOSTNAME', $_ENV['DB_HOSTNAME']);
define('DB_USERNAME', $_ENV['DB_USERNAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_DATABASE', $_ENV['DB_DATABASE']);
define('DB_PORT', $_ENV['DB_PORT']);
define('DB_PREFIX', $_ENV['DB_PREFIX']);

// OpenCart API
define('OPENCART_SERVER', 'https://www.opencart.com/');
