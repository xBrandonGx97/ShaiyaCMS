<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Eloquent;

class guild_rankings
{
    public function __construct()
    {
        $this->MSSQL = new \Classes\DB\MSSQL;
    }

    public function getGuildRankings()
    {
        $rankings = Eloquent::table(table('SH_GUILDS') . ' as [G]')
             ->select()
             ->join(table('SH_GUILD_DETAILS') . ' as  [GD]', '[GD].GuildID', '=', '[G].GuildID')
             ->where('DEL', '0')
             ->where('GuildPoint', '!=', '0')
             ->limit(15)
             ->orderBy('GuildPoint', 'DESC')
             ->get();

        /* $sql = (
                '
                            SELECT TOP 15* FROM ' . $this->MSSQL->getTable('SH_GUILDS') . ' AS [G]
                            INNER JOIN ' . $this->MSSQL->getTable('SH_GUILD_DETAILS') . ' AS [GD] ON [GD].[GuildID] = [G].[GuildID]
                            WHERE DEL=:del AND GuildPoint!=:point ORDER BY GuildPoint DESC'
            );
        $this->MSSQL->query($sql);
        $this->MSSQL->bind(':del', 0);
        $this->MSSQL->bind(':point', 0);
        $res = $this->MSSQL->resultSet(); */
        return $rankings;
    }
}
