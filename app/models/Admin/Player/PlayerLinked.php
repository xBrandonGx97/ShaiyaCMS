<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class PlayerLinked
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->userId = isset($_POST['userId']) ? $this->data->purify(trim($_POST['userId'])) : false;

        $this->logSys = new LogSys;
    }

    public function getCharId()
    {
        $charId = DB::table(table('shCharData'))
            ->select('CharID')
            ->where('CharName', $this->userId)
            ->where('Del', 0)
            ->limit(1)
            ->get();
        if (count($charId) > 0) {
            foreach ($charId as $char) {
                $charId = $char->CharID;
            }
        } else {
            $charId = null;
        }
        return $charId;
    }

    public function getItems()
    {
        $items = DB::table(table('shCharItems') . ' as ci')
            ->select('i.ItemName', 'ci.ItemUID', 'ci.Gem1', 'ci.Gem2', 'ci.Gem3', 'ci.Gem4', 'ci.Gem5', 'ci.Gem6')
            ->join(table('shItems') . ' as  i', 'i.ItemID', '=', 'ci.ItemId')
            ->where('CharID', $this->getCharId())
            ->where('Bag', 0)
            ->get();
            /* $items->transform(function ($item) {
                return (array)$item;
            }); */
        /* return $items->toArray(); */
        return $items;
    }

    public function getLapis()
    {
        $lapis = DB::table(table('shItems'))
            ->select('ItemName', 'TypeID')
            ->where('Type', 30)
            ->get();
        return $lapis;
    }

    public function lapisIdToName($id)
    {
        $name = DB::table(table('shItems'))
            ->select('ItemName')
            ->where('Type', 30)
            ->where('TypeID', $id)
            ->limit(1)
            ->get();
        return $name[0]->ItemName;
    }
}
