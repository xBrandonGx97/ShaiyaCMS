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
        $this->charId = isset($_POST['CharID']) ? $this->data->purify(trim($_POST['CharID'])) : false;
        $this->userId = isset($_POST['userId']) ? $this->data->purify(trim($_POST['userId'])) : false;
        $this->itemUid = isset($_POST['ItemUID']) ? $this->data->purify(trim($_POST['ItemUID'])) : false;

        $this->logSys = new LogSys;
    }

    public function getChar()
    {
        $char = DB::table(table('shCharData'))
            ->select()
            ->where('CharName', $this->userId)
            ->where('Del', 0)
            ->get();
        return $char;
    }

    public function getItems()
    {
        $items = DB::table(table('shCharItems') . ' as ci')
            ->select('i.ItemName', 'ci.Bag', 'ci.Slot', 'ci.Count', 'ci.ItemUID')
            ->join(table('shItems') . ' as  i', 'i.ItemID', '=', 'ci.ItemID')
            ->where('ci.CharID', $this->charId)
            ->orderBy('ci.Bag')
            ->get();
        return $items;
    }

    public function deleteItem()
    {
        try {
            $this->logSys->createLog('Deleted item: '.$this->itemIdToItemName() . ' from '. $this->userId.'\'s character.');

            $item = DB::table(table('shCharItems'))
            ->where('ItemUID', $this->itemUid)
            ->delete();

            return 'Item deleted successfully.';
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to delete item: '.$this->itemIdToItemName() . ' from '. $this->userId.'\'s character.');
            return 'Failed to delete item.';
        }
    }

    public function getBag($bagSlot)
    {
        $bag = [
            0 => 'Equipped',
            1 => 'Bag 1',
            2 => 'Bag 2',
            3 => 'Bag 3',
            4 => 'Bag 4',
            5 => 'Bag 5'
        ];
        return $bag[$bagSlot];
    }

    public function itemUidToItemId()
    {
        $id = DB::table(table('shCharItems'))
            ->select('ItemID')
            ->where('ItemUID', $this->itemUid)
            ->limit(1)
            ->get();
        return $id[0]->ItemID;
    }

    public function itemIdToItemName()
    {
        $name = DB::table(table('shItems'))
            ->select('ItemName')
            ->where('ItemID', $this->itemUidToItemId())
            ->limit(1)
            ->get();
        return $name[0]->ItemName;
    }
}
