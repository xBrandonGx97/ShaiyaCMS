<?php

namespace App\Models\Community;

use Illuminate\Database\Capsule\Manager as Eloquent;

class GuildRankings
{
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function getGuildRankings()
    {
        $rankings = Eloquent::table(table('shGuilds') . ' as [G]')
             ->select()
             ->join(table('shGuildDetails') . ' as  [GD]', '[GD].GuildID', '=', '[G].GuildID')
             ->where('DEL', '0')
             ->where('GuildPoint', '!=', '0')
             ->limit(15)
             ->orderBy('GuildPoint', 'DESC')
             ->get();
        return $rankings;
    }
}
