<?php

namespace App\Models;

use Classes\Utils as Utils;

class User
{
    public function __construct()
    {
            $this->MSSQL = new \Classes\DB\MSSQL;
            $this->Data = new Utils\Data;
            $this->session = new Utils\Session;
            $this->User = new Utils\User($this->session);
            $this->User->run();
            $this->User = $this->User->_fetch_User();
    }

    public function getUsers()
    {
    }

    public function ifUserExists()
    {
    }

    public function doesUserExist($id)
    {
        $sql = ('
					SELECT [U].[UserUID],[U].[UserID],[WP].[DisplayName] FROM PS_UserData.dbo.Users_Master AS [U]
					INNER JOIN ShaiyaCMS.dbo.WEB_PRESENCE AS [WP] ON [U].[UserID] = [WP].[UserID]
					WHERE [U].[UserUID]=:uid
		');
        $this->MSSQL->query($sql);
        $this->MSSQL->bind(':uid', $id);
        $res = $this->MSSQL->resultSet();
        return $res;
    }
}
