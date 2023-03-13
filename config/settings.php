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
    'host' => 'ec2-34-226-11-94.compute-1.amazonaws.com',
    'username' => 'nwysqzusqyfubb',
    'database' => 'd31khun38mlrau',
    'password' => '4c82efe28d544bb3eb002ce3bc84775a08bbf903918f18e0d77767f1252ed62f',
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