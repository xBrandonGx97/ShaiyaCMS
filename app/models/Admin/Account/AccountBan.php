<?php

namespace App\Models\Admin\Account;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class AccountBan
{
    public $userUID;
    private $errors = [];
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->charName = isset($_POST['CharName']) ? $this->data->purify(trim($_POST['CharName'])) : false;
        $this->reason = isset($_POST['Reason']) ? $this->data->purify(trim($_POST['Reason'])) : false;
        $this->len = isset($_POST['Length']) ? $this->data->purify(trim($_POST['Length'])) : false;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
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

    public function setUserToBanned()
    {
        try {
            $banShaiya = DB::table(table('shUserData'))
              ->where('UserUID', $this->getUserUID()[0]->UserUID)
              ->whereNotIn('Status', [16,32,48,64,80])
              ->update(['Status' => -1]);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed ban on Character: '.$this->charName);
            return 'Could not ban user. Please try again.';
        }
        if ($banShaiya) {
            $this->logSys->createLog('Banned Character: '.$this->charName);
            $this->insertBannedLog();
            return 'Ban successful.';
        } else {
            $this->logSys->createLog('Attempted to ban staff member: '.$this->charName);
            return 'You can not ban a staff member.';
        }
    }

    public function insertBannedLog()
    {
        try {
            $banWeb = DB::table(table('banned'))
              ->whereNotIn('Status', [16,32,48,64,80])
              ->insert([
                'CharName' => $this->charName,
                'Reason' => $this->reason,
                'Duration' => $this->len,
                'UserUID' => $this->getUserUID()[0]->UserUID,
                'BannedBy' => $this->user->UserID
              ]);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed ban on Character: '.$this->charName);
            return 'Could not ban user. Please try again.';
        }
    }

    public function checkErrors(): array
    {
        if (empty($this->charName)) {
            $this->errors[] .= 'Character\'s name can not be empty.';
        } elseif (empty($this->reason)) {
            $this->errors[] .= 'Reason can not be empty.';
        } elseif (strlen($this->reason) < 1) {
            $this->errors[] .= 'Reason is too short.';
        } elseif (strlen($this->charName) < 1) {
            $this->errors[] .= 'Character\'s name is too short.';
        }
        return $this->errors;
    }
}
