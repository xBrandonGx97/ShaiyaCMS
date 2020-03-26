<?php
    return [
        'driver' => env('DB_DRIVER'),
        'host' => env('DB_HOST'),
        'database' => env('DB_NAME'),
        'username' => env('DB_USER'),
        'password' => env('DB_PASS'),
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ];
