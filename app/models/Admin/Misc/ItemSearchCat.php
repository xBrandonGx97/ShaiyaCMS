<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class ItemSearchCat
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->type = isset($_POST["ItemID"]) ? $this->data->purify(trim($_POST["ItemID"])) : false;
    }
    public function getItems()
    {
        $items = DB::table(table('shItems'))
            ->select()
            ->where('Type', $this->type)
            ->where('ItemName', 'NOT LIKE', '%?%')
            ->orderBy('ItemID')
            ->get();
        return $items;
    }
}
