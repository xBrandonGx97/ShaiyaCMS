<?php
    return [
        // App
        'app' => [
            'title' => env('APP_TITLE')
        ],
        // DB Params
        'database' => [
            'driver' => env('DB_DRIVER'),
            'host' => env('DB_HOST'),
            'user' => env('DB_USER'),
            'pass' => env('DB_PASS'),
            'name' => env('DB_NAME'),
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ],
        // Session
        'sessionName' => env('SESSION_NAME'),
        // Mail
        'mail' => [
            'host' => env('MAIL_HOST'),
            'user' => env('MAIL_USER'),
            'pass' => env('MAIL_PASS'),
            'auth' => env('MAIL_AUTH'),
            'port' => env('MAIL_PORT'),
            'protocol' => env('MAIL_PROTOCOL'),
            'reply_email' => env('MAIL_REPLY_EMAIL'),
            'reply_name' => env('MAIL_REPLAY_NAME'),
        ],
        // Root Dir
        'ROOT' => dirname(dirname(__FILE__)),
        // App Root
        'APPROOT' => dirname(dirname(__FILE__)) . '/app',
        // URL Root
        'URLROOT' => 'http://my_own_router.local',
        // Base Dir
        'BASEDIR' => '/',
        // Framework Root
        'FWROOT' => $_SERVER['DOCUMENT_ROOT'] . '/../framework/',
        // Public Root
        'PUBROOT' => $_SERVER['DOCUMENT_ROOT'] . '/../public/',
        // Widget Dir
        'WIDGETDIR' => dirname(dirname(__FILE__)) . '/app/widgets/',
    ];
