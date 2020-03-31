<?php

namespace App\Models\User;

use Classes\Utils as Utils;

class User
{
    public function __construct()
    {
            $this->db = new \Classes\DB\MSSQL;
            $this->data = new Utils\Data;
            $this->session = new Utils\Session;
            $this->user = new Utils\User($this->session);
            $this->user->fetchUser();
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
        $this->db->query($sql);
        $this->db->bind(':uid', $id);
        $res = $this->db->resultSet();
        return $res;
    }
}
