<?php

namespace App\Controllers;

    class Core_Controller extends \Framework\Core\CoreController
    {
        public static function settings($id)
        {
            echo 'core/settings';
            echo $id;
        }
    }
