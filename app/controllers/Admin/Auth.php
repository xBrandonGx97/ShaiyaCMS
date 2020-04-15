<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils as Utils;

class Auth extends Controller
{
    public function __construct(Utils\User $user, Utils\Session $session)
    {
        $this->session = $session;
        $this->auth = new Utils\Auth($this->session);
        $this->user = $user;
        $this->select = new Utils\Select;
    }

    public function login()
    {
        $logIn = $this->model(Models\Admin\Auth\LogIn::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'login' => $logIn
        ];

        $this->view('pages/ap/auth/login', $data);
    }

    public function logout()
    {
        $this->auth->logout();
    }

    public function signup()
    {
        $signUp = $this->model(Models\Admin\Auth\SignUp::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'select' => $this->select,
            'sign' => $signUp
        ];

        $this->view('pages/ap/auth/signup', $data);
    }
}
