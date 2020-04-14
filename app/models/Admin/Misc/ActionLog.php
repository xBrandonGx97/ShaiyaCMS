<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class ActionLog
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->actionType = isset($_POST['actionType']) ? $this->data->purify(trim($_POST['actionType'])) : false;
        $this->userId = isset($_POST['user']) ? $this->data->purify(trim($_POST['user'])) : false;
        $this->startDate = isset($_POST['startDate']) ? $this->data->purify(trim($_POST['startDate'])) : false;
        $this->endDate = isset($_POST['endDate']) ? $this->data->purify(trim($_POST['endDate'])) : false;

        $this->logSys = new LogSys;
    }

    public function getActionData()
    {
        if ($this->userId) {
            if ($this->startDate && $this->endDate) {
                if ($this->actionType == 'all') {
                    $action = DB::table(table('shActionLog'))
                        ->select()
                        ->where('UserID', $this->userId)
                        ->whereBetween('ActionTime', [$this->getStartDate(), $this->getEndDate()])
                        ->limit(150)
                        ->get();
                } else {
                    $action = DB::table(table('shActionLog'))
                        ->select()
                        ->where('ActionType', $this->actionType)
                        ->where('UserID', $this->userId)
                        ->whereBetween('ActionTime', [$this->getStartDate(), $this->getEndDate()])
                        ->limit(150)
                        ->get();
                }
            } else {
                if ($this->actionType == 'all') {
                    $action = DB::table(table('shActionLog'))
                        ->select()
                        ->where('UserID', $this->userId)
                        ->limit(150)
                        ->orderBy('ActionTime', 'DESC')
                        ->get();
                } else {
                    $action = DB::table(table('shActionLog'))
                        ->select()
                        ->where('ActionType', $this->actionType)
                        ->where('UserID', $this->userId)
                        ->limit(150)
                        ->orderBy('ActionTime', 'DESC')
                        ->get();
                }
            }
            $log = 'Searched for an action: ' . $this->actionType . ' ' . 'by user: '.$this->userId;
        } else {
            if ($this->startDate && $this->endDate) {
                if ($this->actionType == 'all') {
                    $action = DB::table(table('shActionLog'))
                        ->select()
                        ->whereBetween('ActionTime', [$this->getStartDate(), $this->getEndDate()])
                        ->limit(150)
                        ->get();
                } else {
                    $action = DB::table(table('shActionLog'))
                        ->select()
                        ->where('ActionType', $this->actionType)
                        ->whereBetween('ActionTime', [$this->getStartDate(), $this->getEndDate()])
                        ->limit(150)
                        ->get();
                }
            } else {
                if ($this->actionType == 'all') {
                    $action = DB::table(table('shActionLog'))
                        ->select()
                        ->limit(150)
                        ->orderBy('ActionTime', 'DESC')
                        ->get();
                } else {
                    $action = DB::table(table('shActionLog'))
                        ->select()
                        ->where('ActionType', $this->actionType)
                        ->limit(150)
                        ->orderBy('ActionTime', 'DESC')
                        ->get();
                }
            }
            $log = 'Searched for an action: ' . $this->actionType;
        }
        $this->logSys->createLog($log);
        return $action;
    }

    public function insertLog()
    {
        //
    }

    public function getStartDate()
    {
        $this->startDate = str_replace('/', '-', $this->startDate);
        return date('Y-m-d', strtotime($this->startDate));
    }

    public function getEndDate()
    {
        $this->endDate = str_replace('/', '-', $this->endDate);
        return date('Y-m-d', strtotime($this->endDate));
    }
}
