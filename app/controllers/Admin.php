<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use Classes\Utils as Utils;

class Admin extends Controller
{
    public function __construct(Utils\User $user)
    {
            $this->user = $user;
    }

    public static function index()
    {
        $this->user->run();
        $this->user->fetchUser();

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
