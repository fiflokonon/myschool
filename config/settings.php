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
    'host' => 'ec2-3-214-2-141.compute-1.amazonaws.com',
    'username' => 'uyotvogbavbnar',
    'database' => 'd7jqr4goii2m4e',
    'password' => '79a296f54d9f963dd25e79bbfcb23fc15ef0da9c2a26ced6dc318a60d36a6da1',
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