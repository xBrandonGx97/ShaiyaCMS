<?php

namespace Classes\DB;
use Illuminate\Database\Capsule\Manager as Eloquent;

class SQL
{
    public function viewData()
    {
        $query = Eloquent::table(table('SH_USERDATA'))
            ->select('UserID')
            ->get();
        return $query;

        /* $sql = ('
				    SELECT UserID from PS_UserData.dbo.Users_Master
		');
        MSSQL::query($sql);
        $data = MSSQL::resultSet(2);
        return $data; */
    }
}
