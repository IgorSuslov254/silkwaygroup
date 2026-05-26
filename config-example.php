<?php
// HTTP
define('HTTP_SERVER', 'http://dev.silkwaygroup.ru/');

// HTTPS
define('HTTPS_SERVER', 'https://dev.silkwaygroup.ru/');

// DIR
define('DIR_APPLICATION', '/home/a/antonesb/dev.silkwaygroup.ru/public_html/catalog/');
define('DIR_SYSTEM', '/home/a/antonesb/dev.silkwaygroup.ru/public_html/system/');
define('DIR_IMAGE', '/home/a/antonesb/dev.silkwaygroup.ru/public_html/image/');
define('DIR_STORAGE', '/home/a/antonesb/dev.silkwaygroup.ru/storage/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/theme/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_MODIFICATION', DIR_STORAGE . 'modification/');
define('DIR_SESSION', DIR_STORAGE . 'session/');
define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_DATABASE', '');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');