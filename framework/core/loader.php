<?php

namespace Framework\Core;

use App\Exceptions;

class Loader
{
    // Load config files
    public function config($config)
    {
        if (file_exists(CONFIG_PATH . $config . '.php')) {
            return require_once CONFIG_PATH . $config . '.php';
        } else {
            throw new Exceptions\ConfigException;
        }
    }

    // Load library classes
    public function library($lib)
    {
        //echo 'Loading lib ('.$lib.')..<br>';
        if (file_exists(LIB_PATH . $lib . '.class.php')) {
            include LIB_PATH . $lib . 'class.php';
        }
    }

    // loader helper functions. Naming conversion is xxx.php;
    public function helper($helper)
    {
        //echo 'Loading helper ('.$helper.')..<br>';
        if (file_exists(HELPER_PATH . $helper . '.php')) {
            include HELPER_PATH . $helper . '.php';
        } else {
            throw new Exceptions\HelperException;
        }
    }
}
