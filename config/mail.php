<?php
    return [
        'host' => env('MAIL_HOST'),
        'user' => env('MAIL_USER'),
        'pass' => env('MAIL_PASS'),
        'auth' => env('MAIL_AUTH'),
        'port' => env('MAIL_PORT'),
        'protocol' => env('MAIL_PROTOCOL'),
        'reply_email' => env('MAIL_REPLY_EMAIL'),
        'reply_name' => env('MAIL_REPLAY_NAME'),
    ];
