<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class GuildSearch
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->guildName = isset($_POST["Guild"]) ? $this->data->purify(trim($_POST["Guild"])) : false;
    }

    public function getGuildData()
    {
        $guild = DB::table(table('shGuildChars') . ' as gc')
            ->select('g.GuildName', 'gc.GuildLevel', 'c.CharName', 'gc.JoinDate')
            ->join(table('shGuilds') . ' as  g', 'gc.GuildID', '=', 'g.GuildID')
            ->join(table('shCharData') . ' as  c', 'gc.CharID', '=', 'c.CharID')
            ->where('gc.Del', 0)
            ->where('c.Del', 0)
            ->where('g.Del', 0)
            ->where('g.GuildName', $this->guildName)
            ->orderBy('gc.GuildLevel')
            ->get();
        return $guild;
    }
}
