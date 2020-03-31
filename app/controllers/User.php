<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils as Utils;

class User extends Controller
{
    public function __construct(Utils\User $user)
    {
        $this->user = $user;
        $this->select = new Utils\Select;
    }

    /* Get Methods */

    public function profile()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('pages/cms/user/profile', $data);
    }

    public function settings()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('pages/cms/user/settings', $data);
    }

    /* Post Methods */
}
