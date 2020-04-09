<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class DisbandGuild
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->guildId = isset($_POST['GuildID']) ? $this->data->purify(trim($_POST['GuildID'])) : false;
        $this->guildName = isset($_POST['guild']) ? $this->data->purify(trim($_POST['guild'])) : false;

        $this->logSys = new LogSys;
    }

    public function checkGuild()
    {
        $guild = DB::table(table('shGuilds'))
            ->select('GuildID', 'GuildName')
            ->where('GuildName', $this->guildName)
            ->where('Del', 0)
            ->get();
        return $guild;
    }

    public function getGuildData()
    {
        $guild = DB::table(table('shGuilds'))
              ->select()
              ->where('GuildID', $this->guildId)
              ->where('Del', 0)
              ->get();
        return $guild;
    }

    public function disbandGuild()
    {
        try {
            $update = DB::table(table('shGuilds'))
            ->where('GuildID', $this->guildId)
            ->update(['Del' => 1, 'DeleteDate' => \Carbon\Carbon::now()]);
            $this->logSys->createLog('Disbanded guild: ' . $this->getGuildName());
            return 'Disbanded guild.';
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to disband guild: ' . $this->getGuildName());
            return 'Failed to disband guild.';
        }
    }

    public function getColumns()
    {
        return ['GuildID', 'GuildName', 'MasterUserID', 'MasterCharID', 'MasterName', 'Country', 'TotalCount', 'GuildPoint', 'Del', 'CreateDate', 'DeleteDate'];
    }

    public function getGuildName()
    {
        return isset($_POST['GuildName']) ? $this->data->purify(trim($_POST['GuildName'])) : false;
    }
}
