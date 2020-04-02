<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class ItemDelete
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->guildName = isset($_POST['guild']) ? $this->data->purify(trim($_POST['guild'])) : false;

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

    public function removeGuildLeader()
    {
        try {
            $update = DB::table(table('shGuildChars'))
            ->where('GuildLevel', 1)
            ->where('GuildID', $this->guildId)
            ->update(['GuildLevel' => 8]);
            $this->logSys->createLog('Removed guild leader of guild: ' . $this->guildName . ' old leader: ' . $this->oldGuildLeader);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to removed guild leader of guild: ' . $this->guildName . ' old leader: ' . $this->oldGuildLeader);
            return 'Could not remove guild leader.';
        }
    }
}
