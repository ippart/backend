<?php

require __DIR__.'/vendor/autoload.php';

// HTTP
define('HTTP_SERVER', 'http://new.ippart.com/');

// HTTPS
define('HTTPS_SERVER', 'http://new.ippart.com/');

// DIR
define('DIR_APPLICATION', '/app/catalog/');
define('DIR_SYSTEM', '/app/system/');
define('DIR_IMAGE', '/app/image/');
define('DIR_LANGUAGE', '/app/catalog/language/');
define('DIR_TEMPLATE', '/app/catalog/view/theme/');
define('DIR_CONFIG', '/app/system/config/');
define('DIR_CACHE', '/app/system/storage/cache/');
define('DIR_DOWNLOAD', '/app/system/storage/download/');
define('DIR_LOGS', '/app/system/storage/logs/');
define('DIR_MODIFICATION', '/app/system/storage/modification/');
define('DIR_UPLOAD', '/app/system/storage/upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'ippart_db');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ippart');
define('DB_PORT', '3306');
define('DB_PREFIX', '');
