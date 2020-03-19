<?php
    return [
        // DB Params
        'database' => [
            'host' => env('DB_HOST'),
            'user' => env('DB_USER'),
            'pass' => env('DB_PASS'),
            'name' => env('DB_NAME'),
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ],
        // Root Dir
        'ROOT' => dirname(dirname(__FILE__)),
        // App Root
        'APPROOT' => dirname(dirname(__FILE__)) . '\app',
        // URL Root
        'URLROOT' => 'http://my_own_router.local',
        // Base Dir
        'BASEDIR' => '/',
        // Framework Root
        'FWROOT' => $_SERVER['DOCUMENT_ROOT'] . '/../framework/',
        // Public Root
        'PUBROOT' => $_SERVER['DOCUMENT_ROOT'] . '/../public/',
    ];
