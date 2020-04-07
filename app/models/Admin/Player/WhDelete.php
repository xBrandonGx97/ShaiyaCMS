<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class WhDelete
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->charName = isset($_POST['charName']) ? $this->data->purify(trim($_POST['charName'])) : false;
        $this->userId = isset($_POST['UserID']) ? $this->data->purify(trim($_POST['UserID'])) : false;
        $this->userUid = isset($_POST['UserUID']) ? $this->data->purify(trim($_POST['UserUID'])) : false;
        $this->itemName = isset($_POST['ItemName']) ? $this->data->purify(trim($_POST['ItemName'])) : false;
        $this->itemUid = isset($_POST['ItemUID']) ? $this->data->purify(trim($_POST['ItemUID'])) : false;

        $this->logSys = new LogSys;
    }

    public function getChar()
    {
        $char = DB::table(table('shCharData'))
            ->select()
            ->where('CharName', $this->charName)
            ->where('Del', 0)
            ->get();
        return $char;
    }

    public function getItems()
    {
        $items = DB::table(table('shUserWh') . ' as ci')
            ->select('i.ItemName', 'ci.Slot', 'ci.Count', 'ci.ItemUID', 'ci.UserUID')
            ->join(table('shItems') . ' as  i', 'i.ItemID', '=', 'ci.ItemID')
            ->where('ci.UserUID', $this->userUid)
            ->orderBy('ci.Slot')
            ->get();
        return $items;
    }

    public function deleteItem()
    {
        try {
            $this->logSys->createLog('Deleted item: ' . $this->itemName . ' from ' . $this->userId . '\'s account (warehouse).');

            $item = DB::table(table('shUserWh'))
            ->where('ItemUID', $this->itemUid)
            ->delete();

            return 'Item deleted successfully.';
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to delete item: ' . $this->itemName . ' from ' . $this->userId . '\'s account (warehouse).');
            return 'Failed to delete item.';
        }
    }
}
