<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
class Core extends Controller
{
    public static function settings($id)
    {
        echo 'core/settings';
        echo $id;
    }
}
