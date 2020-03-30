<?php

namespace Classes\Utils;
use Illuminate\Database\Capsule\Manager as db;

class Panels
{

    // maybe make model instead?
    public function getNewlyRegistered()
    {
        $query = db::table(table('shUserData'))
                        ->selectRaw('COUNT(*) AS \'Login\'')
                        ->whereRaw('JoinDate >= DATEADD(day, -14, GETDATE())')
                        ->limit(1)
                        ->get();
        return $query[0]->Login;
    }

    public function getTotalAccounts()
    {
        $query = db::table(table('shUserData'))
                        ->selectRaw('COUNT(*) AS \'Count\'')
                        ->limit(1)
                        ->get();
        return $query[0]->Count;
    }

    public function getOnlineLastDate($dateDiff)
    {
        $query = db::table(table('shUserLoginStatus'))
                        ->selectRaw('COUNT(*) AS \'Login\'')
                        ->whereRaw('LogoutTime >= DATEADD(day, -'.$dateDiff.', GETDATE())')
                        ->limit(1)
                        ->get();
        return $query[0]->Login;
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
                        ->limit(1)
                        ->get();
        return $query[0]->Login;
    }

    public function actionLogs($limit = 8)
    {
        $query = db::table(table('logAccess'))
                        ->select()
                        ->limit($limit)
                        ->orderBy('ActionTime', 'DESC')
                        ->get();
        return $query;
    }

    public function gmLogs($limit = 7)
    {
        $query = db::table(table('logGmCommands'))
                        ->select()
                        ->limit($limit)
                        ->orderBy('ActionTime', 'DESC')
                        ->get();
        return $query;
    }

    public function newUsers($limit = 200)
    {
        $query = db::table(table('shCharData') . ' as C')
                        ->selectRaw('MAX([UM].[UserUID]) AS UserUID, MAX([UM].[UserID]) AS UserID, MAX([C].[Faction]) AS Faction, MAX([UM].[Point]) AS Point, MAX([UM].[JoinDate]) AS JoinDate, MAX([ULS].[LogOutTime]) AS LogOutTime, MAX([UM].[Status]) AS Status')
                        ->join(table('shUserData') . ' as  UM', 'C.UserUID', '=', 'UM.UserUID')
                        ->leftJoin(table('shUserLoginStatus') . ' as  ULS', 'C.UserUID', '=', 'ULS.UserUID')
                        ->limit($limit)
                        ->groupBy('UM.UserID')
                        ->orderBy('JoinDate', 'DESC')
                        ->get();
        return $query;
    }
}
