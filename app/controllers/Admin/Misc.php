<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class Misc extends Controller
{
    public function __construct(Utils\User $user)
    {
            $this->data = new Utils\Data;
            $this->user = $user;
            $this->logSys = new LogSys;
    }

    public function disbandGuild()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/misc/disbandGuild', $data);
    }

    public function guildLeaderChange()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/misc/guildLeaderChange', $data);
    }

    public function guildNameChange()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/misc/guildNameChange', $data);
    }

    public function guildSearch()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/misc/guildSearch', $data);
    }

    public function itemList()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/misc/itemList', $data);
    }

    public function itemSearch()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/misc/itemSearch', $data);
    }

    public function mobList()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/misc/mobList', $data);
    }

    public function playersOnline()
    {
        $playersOnline = $this->model(Models\Admin\Misc\PlayersOnline::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'players' => $playersOnline
        ];

        $this->view('pages/ap/misc/playersOnline', $data);
    }

    public function statPadders()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/misc/statPadders', $data);
    }

    public function worldChat()
    {
        $worldChat = $this->model(Models\Admin\Misc\WorldChat::class);

        $this->user->fetchUser();

        $data = [
            'data' => $this->data,
            'user' => $this->user,
            'logSys' => $this->logSys,
            'chat' => $worldChat
        ];

        $this->view('pages/ap/misc/worldChat', $data);
    }
}
