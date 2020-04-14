<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class ManageGuilds
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->guildName = isset($_POST["Guild"]) ? $this->data->purify(trim($_POST["Guild"])) : false;
    }

    public function getGuildData()
    {
        $guild = DB::table(table('shGuilds') . ' as g')
            ->select()
            ->join(table('shGuildDetails') . ' as  gd', 'g.GuildID', '=', 'gd.GuildID')
            ->where('g.Del', 0)
            ->orderBy('g.GuildID')
            ->get();
        return $guild;
    }

    public function getGuildCharsByGuild($id)
    {
        $chars = DB::table(table('shGuildChars') . ' as gc')
            ->select()
            ->join(table('shCharData') . ' as  c', 'gc.CharID', '=', 'c.CharID')
            ->where('gc.GuildID', $id)
            ->where('gc.Del', 0)
            ->where('gc.GuildLevel', '!=', 0)
            ->orderBy('gc.GuildLevel', 'ASC')
            ->get();
        return $chars;
    }
}
