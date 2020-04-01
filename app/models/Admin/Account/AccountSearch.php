<?php

namespace App\Models\Admin\Account;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class AccountSearch
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->userID = isset($_POST['UserID']) ? $this->data->purify(trim($_POST['UserID'])) : false;
    }

    public function getData()
    {
        $chars = DB::table(table('shCharData') . ' as c')
          ->select(['c.CharName', 'c.CharID', 'u.Status'])
          ->join(table('shUserData') . ' as u', 'u.UserID', '=', 'c.UserID')
          ->where('u.UserID', $this->userID)
          ->get();
        return $chars;
    }

    public function getUserStatus()
    {
        $status = DB::table(table('shUserData'))
            ->select('Status')
            ->where('UserID', $this->userID)
            ->get();
        return $status[0]->Status;
    }
}
