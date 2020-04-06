<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class Player extends Controller
{
    public function __construct(Utils\User $user)
    {
        $this->data = new Utils\Data;
        $this->user = $user;
        $this->logSys = new LogSys;
    }

    public function chatSearch()
    {
        $chat = $this->model(Models\Admin\Player\ChatSearch::class);

        $this->user->fetchUser();

        $data = [
            'data' => $this->data,
            'user' => $this->user,
            'logSys' => $this->logSys,
            'chat' => $chat
        ];

        $this->view('pages/ap/player/chatSearch', $data);
    }

    public function edit()
    {
        $edit = $this->model(Models\Admin\Player\EditPlayer::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'edit' => $edit
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
        $item = $this->model(Models\Admin\Player\ItemDelete::class);
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'item' => $item
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
        $jail = $this->model(Models\Admin\Player\Jail::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'jail' => $jail
        ];

        $this->view('pages/ap/player/jail', $data);
    }

    public function linkedGear()
    {
        $player = $this->model(Models\Admin\Player\PlayerLinked::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'player' => $player
        ];

        $this->view('pages/ap/player/linkedGear', $data);
    }

    public function restore()
    {
        $restore = $this->model(Models\Admin\Player\Restore::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'restore' => $restore
        ];

        $this->view('pages/ap/player/restore', $data);
    }

    public function unJail()
    {
        $unJail = $this->model(Models\Admin\Player\UnJail::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'jail' => $unJail
        ];

        $this->view('pages/ap/player/unJail', $data);
    }
}
