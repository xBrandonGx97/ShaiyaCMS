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
        $guild = $this->model(Models\Admin\Misc\DisbandGuild::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guild
        ];

        $this->view('pages/ap/misc/disbandGuild', $data);
    }

    public function guildLeaderChange()
    {
        $guildLeaderChange = $this->model(Models\Admin\Misc\GuildLeaderChange::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guildLeaderChange
        ];

        $this->view('pages/ap/misc/guildLeaderChange', $data);
    }

    public function guildNameChange()
    {
        $guildNameChange = $this->model(Models\Admin\Misc\GuildNameChange::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guildNameChange
        ];

        $this->view('pages/ap/misc/guildNameChange', $data);
    }

    public function guildSearch()
    {
        $guildSearch = $this->model(Models\Admin\Misc\GuildSearch::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guildSearch
        ];

        $this->view('pages/ap/misc/guildSearch', $data);
    }

    public function itemList()
    {
        $itemList = $this->model(Models\Admin\Misc\ItemList::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'items' => $itemList
        ];

        $this->view('pages/ap/misc/itemList', $data);
    }

    public function itemSearch()
    {
        $items = $this->model(Models\Admin\Misc\ItemSearch::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'items' => $items
        ];

        $this->view('pages/ap/misc/itemSearch', $data);
    }

    public function mobList()
    {
        $mobList = $this->model(Models\Admin\Misc\MobList::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'mobs' => $mobList
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
        $stat = $this->model(Models\Admin\Misc\StatPadders::class);

        $this->user->fetchUser();

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'stat' => $stat
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
