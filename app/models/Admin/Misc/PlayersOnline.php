<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class PlayersOnline
{
    public $count = 1;
    public function getPlayersOnline()
    {
        $players = DB::table(table('shCharData') . ' as c')
            ->select('c.CharName', 'c.Level', 'c.Map', 'c.PosX', 'c.PosY', 'umg.Country as Faction', 'u.UserIp')
            ->join(table('shUserData') . ' as  u', 'c.UserUID', '=', 'u.UserUID')
            ->join(table('shUmg') . ' as  umg', 'u.UserUID', '=', 'umg.UserUID')
            ->where('c.LoginStatus', 1)
            ->where('c.Del', 0)
            ->get();
        return $players;
    }

    public function getPlayersCount()
    {
        $count = DB::select(DB::raw('SELECT (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE Family IN (0, 1) AND LoginStatus = 1) AS \'Light\', (SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE Family IN (2, 3) AND LoginStatus = 1) AS \'Fury\''));
        return $count;
    }
}
