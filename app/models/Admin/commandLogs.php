<?php

namespace App\Models\Admin;

use Classes\Sys\LogSys;
use Illuminate\Database\Capsule\Manager as DB;

class CommandLogs
{
    public $count = 1;
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;

        //$logSys = new LogSys;
        //$logSys->createLog('Visited Command Logs Page');
    }

    public function getCommandLogs()
    {
        $logs = DB::table(table('logGmCommands'))
             ->select()
             ->orderBy('ActionTime', 'DESC')
             ->get();
        return $logs;
    }
}
