<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class Jail
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
            ->select('UserUID', 'UserID', 'CharID', 'CharName', 'Map', 'PosX', 'PosY', 'PosZ')
            ->where('CharName', $this->charName)
            ->limit(1)
            ->get();
        return $char;
    }

    public function jailPlayer()
    {
        try {
            $update = DB::table(table('shCharData'))
            ->where('UserUID', 'uid')
            ->update(['Map' => 41, 'PosX' => 46, 'PosY' => 3, 'PosZ' => 45]);
            $this->logSys->createLog('');
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('');
            return 'Could not remove guild leader.';
        }
    }
}
