<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class ItemEdit
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

    public function getItemInfo()
    {
        $items = DB::select(DB::raw('SELECT c.Count,c.ItemID,c.Type,c.TypeID,c.Gem1,c.Gem2,c.Gem3,c.Gem4,c.Gem5,c.Gem6,
        SUBSTRING(c.Craftname, 1, 2) AS Str, SUBSTRING(c.Craftname, 3, 2) AS Dex, SUBSTRING(c.Craftname, 5, 2) AS Rec,
        SUBSTRING(c.Craftname, 7, 2) AS Int, SUBSTRING(c.Craftname, 9, 2) AS Wis, SUBSTRING(c.Craftname, 11, 2) AS Luc, SUBSTRING(c.Craftname, 13, 2) AS HP, SUBSTRING(c.Craftname, 15, 2) AS MP, SUBSTRING(c.Craftname, 17, 2) AS SP,
        SUBSTRING(c.Craftname, 19, 2) AS Enchant, c.ItemUID, i.ItemName, i.ReqWis, i.Type
        FROM ' . table('shCharItems') . ' c INNER JOIN ' . table('shItems') . ' i on i.ItemID = c.ItemID
        WHERE c.ItemUID = ?'), [$this->itemUid]);
        return $items;
    }

    public function updateItem()
    {
        try {
            $update = DB::table(table('shCharItems'))
            ->where('ItemUID', $this->itemUid)
            ->update(['ItemID' => $this->getItemId(), 'Type' => $this->getType(), 'TypeID' => $this->getTypeId(), 'Gem1' => $this->getGem1(), 'Gem2' => $this->getGem2(), 'Gem3' => $this->getGem3(), 'Gem4' => $this->getGem4(), 'Gem5' => $this->getGem5(), 'Gem6' => $this->getGem6(), 'Count' => $this->getCount(), 'Craftname' => $this->getCraftname()]);
            $this->logSys->createLog('Edited item: ' . $this->getItemName() . ' of character: ' . $this->getCharNameFromCharId());
            return 'Edited item: ' . $this->getItemName();
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to edit item: ' . $this->getItemName() . ' of character: ' . $this->getCharNameFromCharId());
            return 'Failed to edit item.';
        }
    }

    public function getGearTypes()
    {
        return [16, 17, 18, 19, 20, 21, 31, 32, 33, 34, 35, 36, 67, 68, 69, 70, 71, 72, 73, 74, 76, 77, 82, 83, 84, 85, 86, 87, 88, 89, 91, 92];
    }

    public function getColumns()
    {
        return ['ItemName', 'ItemUID', 'ItemID', 'Type', 'TypeID', 'Gem1', 'Gem2', 'Gem3', 'Gem4', 'Gem5', 'Gem6', 'Str', 'Dex', 'Rec', 'Int', 'Wis', 'Luc', 'HP', 'MP', 'SP', 'Enchant', 'Count'];
    }

    public function getGreyedColumns()
    {
        return ['ItemName', 'ItemUID'];
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

    private function getCharNameFromCharId()
    {
        $name = DB::table(table('shCharData'))
            ->select('CharName')
            ->where('CharID', $this->charId)
            ->limit(1)
            ->get();
        return $name[0]->CharName;
    }

    private function getItemId()
    {
        return isset($_POST['ItemID']) ? $this->data->purify(trim($_POST['ItemID'])) : false;
    }

    private function getItemName()
    {
        return isset($_POST['ItemName']) ? $this->data->purify(trim($_POST['ItemName'])) : false;
    }

    private function getType()
    {
        return isset($_POST['Type']) ? $this->data->purify(trim($_POST['Type'])) : false;
    }

    private function getTypeId()
    {
        return isset($_POST['TypeID']) ? $this->data->purify(trim($_POST['TypeID'])) : false;
    }

    private function getGem1()
    {
        return isset($_POST['Gem1']) ? $this->data->purify(trim($_POST['Gem1'])) : false;
    }

    private function getGem2()
    {
        return isset($_POST['Gem2']) ? $this->data->purify(trim($_POST['Gem2'])) : false;
    }

    private function getGem3()
    {
        return isset($_POST['Gem3']) ? $this->data->purify(trim($_POST['Gem3'])) : false;
    }

    private function getGem4()
    {
        return isset($_POST['Gem4']) ? $this->data->purify(trim($_POST['Gem4'])) : false;
    }

    private function getGem5()
    {
        return isset($_POST['Gem5']) ? $this->data->purify(trim($_POST['Gem5'])) : false;
    }

    private function getGem6()
    {
        return isset($_POST['Gem6']) ? $this->data->purify(trim($_POST['Gem6'])) : false;
    }

    private function getCount()
    {
        return isset($_POST['Count']) ? $this->data->purify(trim($_POST['Count'])) : false;
    }

    private function getStr()
    {
        return isset($_POST['Str']) ? $this->data->purify(trim($_POST['Str'])) : false;
    }

    private function getDex()
    {
        return isset($_POST['Dex']) ? $this->data->purify(trim($_POST['Dex'])) : false;
    }

    private function getRec()
    {
        return isset($_POST['Rec']) ? $this->data->purify(trim($_POST['Rec'])) : false;
    }

    private function getInt()
    {
        return isset($_POST['Int']) ? $this->data->purify(trim($_POST['Int'])) : false;
    }

    private function getWis()
    {
        return isset($_POST['Wis']) ? $this->data->purify(trim($_POST['Wis'])) : false;
    }

    private function getLuc()
    {
        return isset($_POST['Luc']) ? $this->data->purify(trim($_POST['Luc'])) : false;
    }

    private function getHp()
    {
        return isset($_POST['HP']) ? $this->data->purify(trim($_POST['HP'])) : false;
    }

    private function getMp()
    {
        return isset($_POST['MP']) ? $this->data->purify(trim($_POST['MP'])) : false;
    }

    private function getSp()
    {
        return isset($_POST['SP']) ? $this->data->purify(trim($_POST['SP'])) : false;
    }

    private function getEnchant()
    {
        return isset($_POST['Enchant']) ? $this->data->purify(trim($_POST['Enchant'])) : false;
    }

    private function getCraftname()
    {
        return $this->getStr() . $this->getDex() . $this->getRec() . $this->getInt() . $this->getWis() . $this->getLuc() . $this->getHp() . $this->getMp() . $this->getSp() . $this->getEnchant();
    }

    public function getNewValue($value)
    {
        return isset($_POST[$value]) ? $this->data->purify(trim($_POST[$value])) : false;
    }
}
