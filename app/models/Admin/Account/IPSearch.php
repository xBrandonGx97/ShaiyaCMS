<?php

namespace App\Models\Admin\Account;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class IPSearch
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->charName = isset($_POST['CharName']) ? $this->data->purify(trim($_POST['CharName'])) : false;
        $this->charID = isset($_POST['CharID']) ? $this->data->purify(trim($_POST['CharID'])) : false;
    }

    public function getCharIp()
    {
        $chars = DB::table(table('shCharData') . ' as c')
          ->select('u.UserIp')
          ->join(table('shUserData') . ' as u', 'u.UserID', '=', 'c.UserID')
          ->where('c.CharName', $this->charName)
          ->get();
        return $chars;
    }

    public function getUsersByIp()
    {
        $chars = DB::table(table('shUserData'))
          ->select('UserID', 'UserUID', 'UserIp')
          ->where('UserIp', $this->getCharIp()[0]->UserIp)
          ->get();
        return $chars;
    }

    public function getCharFromIpSearch()
    {
        $char = DB::table(table('shCharData'))
          ->select('CharName', 'Slot')
          ->where('UserUID', $this->charID)
          ->where('Del', 0)
          ->orderBy('Slot', 'ASC')
          ->get();
        return $char;
    }
}
