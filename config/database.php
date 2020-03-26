<?php
    return [
        'driver' => env('DB_DRIVER'),
        'host' => env('DB_HOST'),
        'user' => env('DB_USER'),
        'pass' => env('DB_PASS'),
        'name' => env('DB_NAME'),
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ];
