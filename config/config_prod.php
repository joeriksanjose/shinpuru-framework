<?php
define('MAIN_URL', 'http://shinpuru.e/');
define('MAIN_HOST_NAME', 'shinpuri.e');

ini_set('display_errors', 'Off');
error_reporting(E_ALL | E_STRICT);
ini_set('error_log', LOG_DIR.'php.log');
ini_set('session.auto_start', 0);

// SQL Configuration
define('DB_DSN', 'mysql:host=localhost;dbname=shinpuru');
define('DB_USERNAME', 'shinpuru');
define('DB_PASSWORD', 'shinpuru');
define('DB_ATTR_TIMEOUT', 3);