<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class GuildLeaderChange
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->guildName = isset($_POST['guild']) ? $this->data->purify(trim($_POST['guild'])) : false;
        $this->newGuildLeader = isset($_POST['newlead']) ? $this->data->purify(trim($_POST['newlead'])) : false;
        $this->oldGuildLeader = isset($_POST['oldlead']) ? $this->data->purify(trim($_POST['oldlead'])) : false;
        $this->guildId = isset($_POST['guild-id']) ? $this->data->purify(trim($_POST['guild-id'])) : false;
        $this->newGuildLeader = explode(',', $this->newGuildLeader);

        $this->logSys = new LogSys;
    }

    public function getGuildData()
    {
        $guild = DB::table(table('shCharData') . ' as c')
            ->select('g.MasterName', 'g.GuildID', 'c.CharName', 'c.UserUID', 'c.UserID', 'c.CharID')
            ->join(table('shGuildChars') . ' as  gc', 'c.CharID', '=', 'gc.CharID')
            ->join(table('shGuilds') . ' as  g', 'gc.GuildID', '=', 'g.GuildID')
            ->where('gc.GuildLevel', 2)
            ->where('g.GuildName', $this->guildName)
            ->get();
        return $guild;
    }

    public function runGuildLeaderChange()
    {
        $this->removeGuildLeader();
        $this->updateGuildLeader();
        $this->updateGuildLevel();
    }

    public function removeGuildLeader()
    {
        try {
            $update = DB::table(table('shGuildChars'))
            ->where('GuildLevel', 1)
            ->where('GuildID', $this->guildId)
            ->update(['GuildLevel' => 8]);
            $this->logSys->createLog('Removed guild leader of guild: ' . $this->guildName .' old leader: '.$this->oldGuildLeader);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to removed guild leader of guild: ' . $this->guildName .' old leader: '.$this->oldGuildLeader);
            return 'Could not remove guild leader.';
        }
    }

    public function updateGuildLeader()
    {
        try {
            $update = DB::table(table('shGuilds'))
            ->where('GuildName', $this->guildName)
            ->update(['MasterUserID' => $this->newGuildLeader[1], 'MasterCharID' => $this->newGuildLeader[3], 'MasterName' => $this->newGuildLeader[2]]);
            $this->logSys->createLog('Updated guild leader of guild: ' . $this->guildName .' to: '.$this->newGuildLeader[2]);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to update guild leader of guild: ' . $this->guildName .' to: '.$this->newGuildLeader[2]);
            return 'Could not update guild leader.';
        }
    }

    public function updateGuildLevel()
    {
        try {
            $update = DB::table(table('shGuildChars'))
            ->where('CharID', $this->newGuildLeader[3])
            ->update(['GuildLevel' => 1]);
            $this->logSys->createLog('Update guild level of new guild leader: ' . $this->newGuildLeader[2] .' to: 1');
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to update guild level of new guild leader: ' . $this->newGuildLeader[2] .' to: 1');
            return 'Could not update not guild level of new guild leader. Please try again.';
        }
    }
}
