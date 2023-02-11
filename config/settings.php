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
    'host' => 'ec2-34-192-210-139.compute-1.amazonaws.com',
    'username' => 'agubbkfmyfxyvc',
    'database' => 'deaef5oqn3d1gh',
    'password' => '788d6ce3f46d387fc52de1eda5c695ba25f4f676c88887bbbc915281a9f50f11',
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