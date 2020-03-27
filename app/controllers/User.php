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

    public function user($id)
    {
        $userModel = $this->model(Models\User::class);
        $Friends = $this->model(Models\Friends::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select,
            'userModel' => $userModel,
            'userID' => $id,
            'friends' => $Friends
        ];
        $this->view('pages/cms/user/user', $data);
    }

    public function users()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select
        ];
        $this->view('pages/cms/user/users', $data);
    }

    /* Post Methods */
}
