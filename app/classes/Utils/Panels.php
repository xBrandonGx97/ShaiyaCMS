<?php

namespace Classes\Utils;

use Illuminate\Database\Capsule\Manager as db;

class Panels
{
    // maybe make model instead?
    public function getNewlyRegistered($dateDiff = null)
    {
        if ($dateDiff) {
            $query = db::table(table('shUserData'))
                ->selectRaw('COUNT(*) AS \'Login\'')
                ->whereRaw('JoinDate >= DATEADD(day, -' . $dateDiff . ', GETDATE())')
                ->limit(1)
                ->get();
        } else {
            $query = db::table(table('shUserData'))
                ->selectRaw('COUNT(*) AS \'Login\'')
                ->limit(1)
                ->get();
        }
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

    public function getOnline($dateDiff = null)
    {
        if ($dateDiff) {
            $query = db::table(table('shUserLoginStatus'))
                ->selectRaw('COUNT(*) AS \'Login\'')
                ->whereRaw('LogoutTime >= DATEADD(day, -' . $dateDiff . ', GETDATE())')
                ->limit(1)
                ->get();
        } else {
            $query = db::table(table('shCharData'))
                ->selectRaw('COUNT(*) AS \'Login\'')
                ->where('LoginStatus', 1)
                ->limit(1)
                ->get();
        }
        return $query[0]->Login;
    }

    public function getSpentPoints($dateDiff = null)
    {
        if ($dateDiff) {
            $query = db::table(table('shPointLog'))
                ->selectRaw('COUNT(UsePoint) AS \'SpentPoints\'')
                ->whereRaw('UseDate >= DATEADD(day, -' . $dateDiff . ', GETDATE())')
                ->limit(1)
                ->get();
        } else {
            $query = db::table(table('shPointLog'))
                ->selectRaw('COUNT(UsePoint) AS \'SpentPoints\'')
                ->limit(1)
                ->get();
        }
        return $query[0]->SpentPoints;
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
