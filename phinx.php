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
            'host' => 'ec2-34-194-158-176.compute-1.amazonaws.com',
            'name' => 'delu76ujik5mrs',
            'user' => 'jxclorjxhurfiq',
            'pass' => '0066717ff47de14a9a69334f3df94afc8a056a592ae35b2743dd688bf4c6e79e',
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
