<?php

global $wpdb;

return [
    'connections' => [
        'driver'   => 'mysql',
        'host'     => DB_HOST,
        'database' => DB_NAME,
        'username' => DB_USER,
        'password' => DB_PASSWORD,
        'charset'  => DB_CHARSET,
        'prefix'   => $wpdb->prefix,
    ]
];
