<?php

namespace Classes\Security;

class Security
{
    public function __construct()
    {
        $this->sslCheck();
    }

    private function sslCheck()
    {
        if (APP['secureHTTPS'] === true) {
            if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off') {
                $redirect_url="https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
                header("Location: $redirect_url");
                exit;
            }
        }
    }
}
