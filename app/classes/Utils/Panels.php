<?php

namespace Classes\Utils;
use Illuminate\Database\Capsule\Manager as db;

class Panels
{

    public function getNewlyRegistered()
    {
        $query = db::table(table('shUserData'))
                        ->selectRaw('COUNT(*) AS \'Login\'')
                        ->whereRaw('JoinDate >= DATEADD(day, -14, GETDATE())')
                        ->get();
        return $query;
    }

    public function getTotalAccounts()
    {
        $query = db::table(table('shUserData'))
                        ->selectRaw('COUNT(*) AS \'Count\'')
                        ->get();
        return $query;
    }

    // These can be cleaned up, just different dates

    public function getOnlineLastDate($dateDiff)
    {
        $query = db::table(table('shUserLoginStatus'))
                        ->selectRaw('COUNT(*) AS \'Login\'')
                        ->whereRaw('LogoutTime >= DATEADD(day, -'.$dateDiff.', GETDATE())')
                        ->get();
        return $query;
    }

    public function getOnlineLast1()
    {
        return $this->getOnlineLastDate(1);
    }

    public function getOnlineLast7()
    {
        return $this->getOnlineLastDate(7);
    }

    public function getOnlineLast14()
    {
        return $this->getOnlineLastDate(14);
    }

    public function getOnlineLast30()
    {
        return $this->getOnlineLastDate(30);
    }

    public function getOnlineCurrent()
    {
        $query = db::table(table('shCharData'))
                        ->selectRaw('COUNT(*) AS \'Login\'')
                        ->where('LoginStatus', 1)
                        ->get();
        return $query;
    }

    public function actionLogs()
    {
        //
    }

    public function gmLogs()
    {
        //
    }

    public function newUsers()
    {
        //
    }
}
