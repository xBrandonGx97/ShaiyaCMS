<?php

namespace App\Models\Admin\Account;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class AccountUnBan
{
    public $userUID;
    private $errors = [];

    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->charName = isset($_POST['CharName']) ? $this->data->purify(trim($_POST['CharName'])) : false;
        $this->logSys = new LogSys;
    }

    public function getUserUID()
    {
        $char = DB::table(table('shCharData'))
            ->select('UserUID')
            ->where('CharName', $this->charName)
            ->where('del', 0)
            ->limit(1)
            ->get();
        return $char;
    }

    public function checkIfBanned()
    {
        $banned = DB::table(table('shUserData'))
            ->select('UserID')
            ->where('UserUID', $this->getUserUID()[0]->UserUID)
            ->whereIn('Status', [-1, -5])
            ->get();
        return $banned;
    }

    public function checkIfBannedLog()
    {
        $banned = DB::table(table('banned'))
            ->select()
            ->where('CharName', $this->charName)
            ->get();
        return $banned;
    }

    public function unBanUser()
    {
        try {
            $unBan = DB::table(table('shUserData'))
                ->where('UserUID', $this->getUserUID()[0]->UserUID)
                ->whereNotIn('Status', [16, 32, 48, 64, 80])
                ->update(['Status' => 0]);
            $this->logSys->createLog('Un-Banned Character: ' . $this->charName);
            $this->deleteBannedLog();
            return $this->charName.' has been successfully unbanned.';
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed un-ban on Character: ' . $this->charName);
            return 'Could not un-ban user. Please try again.';
        }
    }

    public function deleteBannedLog()
    {
        try {
            $banWeb = DB::table(table('banned'))
                ->where('CharName', $this->charName)
                ->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed un-ban on Character: ' . $this->charName);
            return 'Could not un-ban user. Please try again.';
        }
    }
}
