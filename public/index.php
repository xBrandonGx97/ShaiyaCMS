<?php
        // Define Security
        define('IN_CMS', true);
        setcookie('Default', session_id(), 0, '/', null, null, true);
        require_once '../app/bootstrap.php';
        Bootstrap::run();
        Bootstrap::dispatch();
