<?php

function database()
{
     $settings = [
        'database_type' => 'mysql',
        'database_name' => 'craft_test',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
    ];

    return [
        "{$settings['database_type']}:host={$settings['server']};dbname={$settings['database_name']}",
        $settings['username'],
        $settings['password'],
    ];
}
