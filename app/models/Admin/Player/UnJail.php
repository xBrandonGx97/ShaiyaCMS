<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class UnJail
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->charName = isset($_POST['CharName']) ? $this->data->purify(trim($_POST['CharName'])) : false;

        $this->logSys = new LogSys;
    }

    public function getChar()
    {
        $char = DB::table(table('shCharData'))
            ->select('UserUID', 'UserID', 'CharID', 'CharName', 'PosX', 'PosY', 'PosZ')
            ->where('CharName', $this->charName)
            ->orWhere('UserID', $this->charName)
            ->limit(1)
            ->get();
        return $char;
    }

    public function unJailPlayer()
    {
        try {
            $update = DB::table(table('shCharData'))
            ->where('UserUID', $this->getChar()[0]->UserUID)
            ->update(['Map' => 42, 'PosX' => 55, 'PosY' => 3, 'PosZ' => 54]);
            $this->logSys->createLog('Un-jailed' . ' ' . $this->charName);
            return 'Un-jailed' . ' ' . $this->charName;
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to un-jail' . ' ' . $this->charName);
            return 'Could not Un-jail player.';
        }
    }
}
