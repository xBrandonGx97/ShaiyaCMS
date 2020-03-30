<?php
    return [
        // Session
        'sessionName' => env('SESSION_NAME'),
        // Timezone
        'timeZone' => 'America/Chicago',
        // Root Dir
        'ROOT' => dirname(dirname(__FILE__)),
        // App Root
        'APPROOT' => dirname(dirname(__FILE__)) . '/app',
        // URL Root
        'URLROOT' => 'http://shaiyacms.local',
        // Base Dir
        'BASEDIR' => '/',
        // Framework Root
        'FWROOT' => $_SERVER['DOCUMENT_ROOT'] . '/../framework/',
        // Public Root
        'PUBROOT' => $_SERVER['DOCUMENT_ROOT'] . '/../public/',
        // Widget Dir
        'WIDGETDIR' => dirname(dirname(__FILE__)) . '/app/widgets/',
    ];
