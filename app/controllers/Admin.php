<?php

namespace App\Controllers;

use Classes\Utils as Utils;

class Admin extends \Framework\Core\CoreController
{
    public function __construct(Utils\User $user)
    {
            $this->user = $user;
    }

    public static function index()
    {
        $this->user->run();
        $this->user->_fetch_User();

        $data = ['pageData' => [
            'index' => 'index',
            'title' => 'Home',
            'zone' => 'AP',
            'nav' => true,
        ],
            'User' => $this->user,
        ];

        self::view('ap/index', $data);
    }
}
