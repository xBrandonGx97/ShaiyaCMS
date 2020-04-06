<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class EditPlayer
{
    private $count = 0;

    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->userId = isset($_POST['userId']) ? $this->data->purify(trim($_POST['userId'])) : false;

        $this->logSys = new LogSys;
    }

    public function getUser()
    {
        $char = DB::table(table('shCharData'))
            ->select()
            ->where('CharName', $this->userId)
            ->limit(1)
            ->get();
        return $char;
    }

    public function getCharId($char)
    {
        $id = DB::table(table('shCharData'))
            ->select('CharID')
            ->where('CharName', $char)
            ->limit(1)
            ->get();
        return $id[0]->CharID;
    }

    public function getLoginStatus()
    {
        $status = DB::table(table('shCharData'))
            ->select('LoginStatus')
            ->where('CharName', $this->userId)
            ->limit(1)
            ->get();
        if (count($status) > 0) {
            foreach ($status as $res) {
                return (int)$res->LoginStatus;
            }
        }
    }

    public function getColumns()
    {
        return ['UserID', 'UserUID', 'CharID', 'CharName', 'Slot', 'Family', 'Grow', 'Hair', 'Face', 'Size', 'Job', 'Sex', 'Level', 'StatPoint', 'SkillPoint', 'Str', 'Dex', 'Rec', 'Int',  'Luc', 'Wis', 'Dir', 'Exp', 'Money', 'Map', 'PosX', 'PosY', 'Posz', 'K1', 'K2', 'K3', 'K4', 'KillLevel', 'DeadLevel', 'OldCharName', 'LoginStatus'];
    }

    public function getGreyedColumns()
    {
        return ['UserUID', 'UserID', 'CharID', 'Slot', 'KillLevel', 'DeadLevel'];
    }

    public function getCount()
    {
        return $this->count;
    }

    public function updateCount()
    {
        $this->count++;
    }

    public function updateColumns($column, $value)
    {
        try {
            $update = DB::table(table('shCharData'))
            ->where('CharID', $this->getCharId($this->userId))
            ->update([$column => $value]);
            //$this->logSys->createLog('Removed guild leader of guild: ' . $this->guildName . ' old leader: ' . $this->oldGuildLeader);
        } catch (\Illuminate\Database\QueryException $e) {
            //$this->logSys->createLog('Failed to removed guild leader of guild: ' . $this->guildName . ' old leader: ' . $this->oldGuildLeader);
            //return 'Could not remove guild leader.';
        }
    }

    public function getNewValue($value)
    {
        return isset($_POST[$value]) ? $this->data->purify(trim($_POST[$value])) : false;
    }
}
