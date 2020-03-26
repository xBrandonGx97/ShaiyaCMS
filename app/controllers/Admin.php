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

    public function index()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
        ];

        $this->view('pages/ap/index', $data);
    }
}
