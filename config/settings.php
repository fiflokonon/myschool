<?php

// Should be set to 0 in production
error_reporting(E_ALL);

// Should be set to '0' in production
ini_set('display_errors', '1');

// Settings
$settings = [];
// Database settings
$settings['db'] = [
    'driver' => 'psql',
    'host' => 'ec2-34-202-127-5.compute-1.amazonaws.com',
    'username' => 'nwysqzusqyfubb',
    'database' => 'itptbjllhuhzfh',
    'password' => '1f952ff626099530f13a4faede4cd470008332e3ebe0dafc0f00325543912468',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];
// ...

return $settings;