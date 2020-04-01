<?php

namespace App\Models\Admin\Account;

use Illuminate\Database\Capsule\Manager as DB;

class BannedUsers
{
    public function getBannedUsers()
    {
        $banned = DB::table(table('banned'))
          ->select()
          ->orderBy('BanDate', 'DESC')
          ->get();
        return $banned;
    }
}
