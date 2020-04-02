<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;

class ItemList
{
    public function getItems()
    {
        $items = DB::table(table('shItems'))
            ->select()
            ->where('ItemName', 'NOT LIKE', '%?%')
            ->get();
        return $items;
    }
}
