<?php

namespace App\Models\Admin\Account;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class AccountEdit
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->userUid = isset($_POST['UserUID']) ? $this->data->purify(trim($_POST['UserUID'])) : false;
        $this->userId = isset($_POST['userId']) ? $this->data->purify(trim($_POST['userId'])) : false;

        $this->logSys = new LogSys;
    }

    public function getUser()
    {
        $user = DB::table(table('shUserData'))
            ->select()
            ->where('UserID', $this->userId)
            ->limit(1)
            ->get();
        return $user;
    }

    public function updateUser()
    {
        try {
            foreach ($this->getColumns() as $value) {
                if (!in_array($value, $this->getGreyedColumns())) {
                    $update = DB::table(table('shUserData'))
                        ->where('UserUID', $this->userUid)
                        ->update([$value => $this->getNewValue($value)]);
                }
            }
            $this->logSys->createLog('Edited user: ' . $this->userId);
            return 'Edited user: ' . $this->userId;
        } catch (\Illuminate\Database\QueryException $e) {
            $this->logSys->createLog('Failed to edit user: ' . $this->userId);
            /* foreach ($this->getColumns() as $value) {
                if (!in_array($value, $this->getGreyedColumns())) {
                    echo $value . '=>' . $this->getNewValue($value) . '<br>';
                }
            } */
            return 'Failed to edit user.';
        }
    }

    public function getColumns()
    {
        return ['UserUID', 'UserID', 'JoinDate', 'Admin', 'AdminLevel', 'UseQueue', 'Status', 'Leave', 'LeaveDate', 'UserType', 'UserIp', 'Point'];
    }

    public function getGreyedColumns()
    {
        return ['UserUID', 'UserID', 'JoinDate', 'UseQueue', 'Leave', 'LeaveDate', 'UserIp'];
    }

    public function getStatuses()
    {
        return [-1, -5, 0, 16, 32, 48, 64, 80, 128];
    }

    public function getUserTypes()
    {
        return ['N', 'A'];
    }

    public function getNewValue($value)
    {
        return isset($_POST[$value]) ? $this->data->purify(trim($_POST[$value])) : false;
    }
}
