<?php defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = true;

$db['default']['hostname'] = Config::DB_HOST;
$db['default']['username'] = Config::DB_USERNAME;
$db['default']['password'] = Config::DB_PASSWORD;
$db['default']['database'] = Config::DB_NAME;
$db['default']['port'] = Config::DB_PORT;

$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = 'ea_';
$db['default']['pconnect'] = false;
$db['default']['db_debug'] = true;
$db['default']['cache_on'] = false;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8mb4';
$db['default']['dbcollat'] = 'utf8mb4_unicode_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = true;
$db['default']['stricton'] = false;

// Aiven MySQL SSL configuration
$db['default']['encrypt'] = [
    'ssl_ca' => '/etc/mysql/certs/ca.pem',
    'ssl_verify' => true,
];

/* End of file database.php */
