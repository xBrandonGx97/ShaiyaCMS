<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class Player extends Controller
{
    public function __construct(Utils\User $user)
    {
            $this->user = $user;
            $this->logSys = new LogSys;
    }

    public function chatSearch()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/chatSearch', $data);
    }

    public function edit()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/edit', $data);
    }

    public function editWhItems()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/editWhItems', $data);
    }

    public function deleteWhItems()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/deleteWhItems', $data);
    }

    public function itemDelete()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/itemDelete', $data);
    }

    public function itemEdit()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/itemEdit', $data);
    }

    public function jail()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/jail', $data);
    }

    public function linkedGear()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/linkedGear', $data);
    }

    public function restore()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/restore', $data);
    }

    public function unJail()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/unJail', $data);
    }
}
