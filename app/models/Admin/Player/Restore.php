<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class Restore
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->userID = isset($_POST['userId']) ? $this->data->purify(trim($_POST['userId'])) : false;
        $this->charID = isset($_POST['char']) ? $this->data->purify(trim($_POST['char'])) : false;
        $this->char =  explode(',', $this->charID);

        $this->logSys = new LogSys;
    }

    public function getDeadChars()
    {
        $chars = DB::table(table('shUmg') . ' as umg')
            ->select('umg.Country', 'c.Family', 'c.CharName', 'c.CharID', 'c.Job', 'c.Level')
            ->join(table('shCharData') . ' as  c', 'umg.UserUID', '=', 'c.UserUID')
            ->where('c.UserID', $this->userID)
            ->where('c.del', 1)
            ->get();
        return $chars;
    }

    public function getSlot()
    {
        $slot = DB::select(DB::raw('SELECT MIN(Slots.Slot) AS OpenSlot FROM (SELECT 0 AS Slot UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) AS Slots LEFT JOIN (SELECT c.Slot FROM '.table("shCharData").' AS c WHERE c.UserID = ? AND c.Del = ?) AS Chars ON Chars.Slot = Slots.Slot WHERE Chars.Slot IS NULL'), ['ibolangpo', 0]);
        return $slot;
    }

    public function updateRestore()
    {
        try {
            $update = DB::table(table('shCharData'))
            ->where('CharID', $this->char[1])
            ->update(['Del' => 0, 'Slot' => $this->getSlot()[0]->OpenSlot, 'Map' => 42, 'PosX' => 63, 'PosZ' => 57, 'DeleteDate' => null, 'RemainTime' => 0]);
            $this->logSys->createLog('Resurrected character: '.$this->char[0]);
            return 'Resurrected character: '.$this->char[0];
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to resurrect char: '.$this->char[0]);
            return 'Could not resurrect character.';
        }
    }
}
