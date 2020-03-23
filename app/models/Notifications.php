<?php

    namespace App\Models;

    class Notifications
    {
        public function __construct()
        {
            $this->MSSQL = new \Classes\DB\MSSQL;
        }

        public function sendNotification()
        {
        }

        public function deleteNotification()
        {
        }
    }
