<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class ItemSearchName
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->name = isset($_POST["search"]) ? $this->data->purify(trim($_POST["search"])) : false;
    }
    public function getItems()
    {
        $items = DB::table(table('shItems'))
            ->select()
            ->where('ItemName', 'LIKE', '%'.$this->name.'%')
            ->where('ItemName', 'NOT LIKE', '%?%')
            ->orderBy('ItemID')
            ->get();
        return $items;
    }
}
