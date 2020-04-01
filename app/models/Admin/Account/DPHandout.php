<?php

namespace App\Models\Admin\Account;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class DPHandout
{
    public function __construct()
    {
        $this->data = new Utils\Data;
    }

    public function getChar()
    {
        $CharName = isset($_POST['UserID']) ? $this->data->purify(trim($_POST['UserID'])) : false;
        $chars = DB::table(table('shCharData'))
          ->select()
          ->where('CharName', $CharName)
          ->get();
        return $chars;
    }

    public function updateChar($res): void
    {
        $CharName = isset($_POST['UserID']) ? $this->data->purify(trim($_POST['UserID'])) : false;
        $DP = isset($_POST['DP']) ? $this->data->purify(trim($_POST['DP'])) : false;
        try {
            $user = DB::table(table('shCharData') . ' as C')
              ->select(['UM.UserID', 'UM.Point'])
              ->join(table('shUserData') . ' as  UM', 'UM.UserID', '=', 'C.UserID')
              ->where('C.CharName', $CharName)
              ->get();
            foreach ($user as $user) {
                $point = $user->Point;
            }
            $newPoints = $DP + $point;
            $update = DB::table(table('shUserData'))
              ->where('UserID', $res->UserID)
              ->update(['Point' => $newPoints]);
            echo 'Successfully added: ' . $DP . ' Point(s) to: ' . $CharName . '\'s account.';
        } catch (\Exception $e) {
            echo 'Failed to update user\'s points.';
        }
    }
}
