<?php

namespace Classes\DB;

class SQL
{
    public function viewData()
    {
        $sql = ('
				    SELECT UserID from PS_UserData.dbo.Users_Master
		');
        MSSQL::query($sql);
        $data = MSSQL::resultSet(2);
        return $data;
    }
}
