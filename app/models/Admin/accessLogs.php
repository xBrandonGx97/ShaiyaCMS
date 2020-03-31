<?php

namespace App\Models\Admin;

use Classes\Sys\LogSys;
use Illuminate\Database\Capsule\Manager as DB;

class AccessLogs
{
    public $count = 1;
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;

        //$logSys = new LogSys;
        //$logSys->createLog('Visited Access Logs Page');
    }

    public function getAccessLogs()
    {
        $logs = DB::table(table('logAccess'))
             ->select()
             ->orderBy('ActionTime', 'DESC')
             ->get();
        return $logs;
    }

    public function categorySwitch()
    {
    }
}
