<?php
ini_set('error_log', '/tmp/pcphrm.log');

define('CLIENT_NAME', 'app');
define('APP_BASE_PATH', 'C:/xampp/htdocs/PCPHRM/');
define('CLIENT_BASE_PATH', 'C:/xampp/htdocs/PCPHRM/app/');
define('BASE_URL','http://localhost/PCPHRM/');
define('CLIENT_BASE_URL','http://localhost/PCPHRM/app/');

define('APP_DB', 'ingenuj9_pcphrm');
define('APP_USERNAME', 'root');
define('APP_PASSWORD', '');
define('APP_HOST', 'localhost');
define('APP_CON_STR', 'mysql://'.APP_USERNAME.':'.APP_PASSWORD.'@'.APP_HOST.'/'.APP_DB);

//file upload
define('FILE_TYPES', 'jpg,png,jpeg');
define('MAX_FILE_SIZE_KB', 10 * 1024);