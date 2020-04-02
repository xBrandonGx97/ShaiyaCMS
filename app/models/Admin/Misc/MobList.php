<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;

class MobList
{
    public function getMobs()
    {
        $items = DB::table(table('shMobs'))
            ->select()
            ->where('MobName', 'NOT LIKE', '%Error Monster%')
            ->where('MobName', 'NOT LIKE', '%WING%')
            ->where('MobName', 'NOT LIKE', '%?%')
            ->orderBy('MobID')
            ->get();
        return $items;
    }
}
