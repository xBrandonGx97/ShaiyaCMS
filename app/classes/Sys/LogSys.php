<?php

namespace Classes\Sys;

use Classes\Utils as Utils;
use Illuminate\Database\Capsule\Manager as DB;

class LogSys
{
    public function createLog(string $action): void
    {
         $browser = new Utils\Browser;
         $session = new Utils\Session;

         $log = DB::table(table('logAccess'))
            ->insert([
               'UserID' => $session->get('User', 'UserID'),
               'UserIP' => $browser->ip(),
               'Action' => $action
            ]);
    }
}
