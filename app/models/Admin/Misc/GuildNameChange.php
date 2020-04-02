<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class GuildNameChange
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->guildName = isset($_POST['guild']) ? $this->data->purify(trim($_POST['guild'])) : false;
        $this->newGuildName = isset($_POST['newname']) ? $this->data->purify(trim($_POST['newname'])) : false;
        $this->guildId = isset($_POST['guild-id']) ? $this->data->purify(trim($_POST['guild-id'])) : false;

        $this->logSys = new LogSys;
    }

    public function getGuildData()
    {
        $guild = DB::table(table('shGuilds'))
            ->select()
            ->where('GuildName', $this->guildName)
            ->get();
        return $guild;
    }

    public function updateGuildName()
    {
        try {
            $update = DB::table(table('shGuilds'))
            ->where('GuildID', $this->guildId)
            ->update(['GuildName' => $this->newGuildName]);
            $this->logSys->createLog('Changed name of guild: ' . $this->guildName .' to: '.$this->newGuildName);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to change name of guild: ' . $this->guildName .' to: '.$this->newGuildName);
            return 'Could not change name of guild. Please try again.';
        }
    }
}
