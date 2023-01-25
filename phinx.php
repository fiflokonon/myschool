<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'pgsql',
            'host' => 'ec2-34-192-210-139.compute-1.amazonaws.com',
            'name' => 'deaef5oqn3d1gh',
            'user' => 'agubbkfmyfxyvc',
            'pass' => '788d6ce3f46d387fc52de1eda5c695ba25f4f676c88887bbbc915281a9f50f11',
            'port' => '5432',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'pgsql',
            'host' => 'localhost',
            'name' => 'Myschool',
            'user' => 'testuser',
            'pass' => 'udacity',
            'port' => '5432',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
