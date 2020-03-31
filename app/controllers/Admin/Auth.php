<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use Classes\Utils as Utils;

class Auth extends Controller
{
    public function __construct(Utils\User $user)
    {
            $this->user = $user;
    }

    public function login()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/auth/login', $data);
    }
}
