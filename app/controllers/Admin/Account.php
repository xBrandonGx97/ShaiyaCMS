<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use Classes\Utils as Utils;

class Account extends Controller
{
    public function __construct(Utils\User $user)
    {
            $this->user = $user;
    }

    public function ban()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/account/ban', $data);
    }

    public function banSearch()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/account/banSearch', $data);
    }

    public function dpHandout()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/account/dpHandout', $data);
    }

    public function edit()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/account/edit', $data);
    }

    public function ipSearch()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/account/ipSearch', $data);
    }

    public function search()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/account/search', $data);
    }

    public function unban()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/ap/account/unban', $data);
    }
}
