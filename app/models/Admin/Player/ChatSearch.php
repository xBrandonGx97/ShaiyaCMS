<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class ChatSearch
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->charName = isset($_POST['char']) ? $this->data->purify(trim($_POST['char'])) : false;
    }

    public function getChatData()
    {
        $chat = DB::table(table('shChatLog') . ' as cl')
            ->select()
            ->join(table('shCharData') . ' as  c', 'cl.CharID', '=', 'c.CharID')
            ->where('c.CharName', $this->charName)
            ->orderBy('cl.ChatTime', 'DESC')
            ->get();
        return $chat;
    }
}
