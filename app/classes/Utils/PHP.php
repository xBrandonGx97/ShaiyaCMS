<?php

namespace Classes\Utils;

class PHP
{
    public function __construct()
    {
        $this->errorReporting();
        $this->defaultIni();
    }

    private function errorReporting()
    {
        // Error-checking | Uncomment the one that suits your needs at the moment.
        // Know that everyone can see the error messages, not just you.
        error_reporting(E_ALL);
        // error_reporting(E_ALL ^ E_NOTICE);
    }

    private function defaultIni()
    {
        // Sets default params without having to edit php.ini config
        // Options are 0/1
        if (APP['dev'] === true) {
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
        } else {
            ini_set('display_errors', '0');
            ini_set('display_startup_errors', '0');
        }
        ini_set('short_open_tag', '1');
        ini_set('log_errors', 1);
        ini_set('error_log', '../logs/ShaiyaCMS.log');
    }
}
