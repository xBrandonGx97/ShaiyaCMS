<?php

namespace App\Models;

use Classes\Utils as Utils;

class Friends
{
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
        $this->user = $this->user->_fetch_User();
    }

    public function ifFriendsExist($user1, $user2)
    {
        //check if friends exist before adding friend
        $sql = ('
				    SELECT * FROM ShaiyaCMS.dbo.USER_FRIENDS
					WHERE ToUser = :touser AND FromUser = :fromuser
					OR ToUser = :touser2 AND FromUser = :fromuser2
		');
        $this->db->query($sql);
        $this->db->bind(':touser', $user1);
        $this->db->bind(':fromuser', $user2);
        $this->db->bind(':touser2', $user2);
        $this->db->bind(':fromuser2', $user1);
        $res = $this->db->resultSet();
        return $res;
    }

    public function addFriend($user1, $user2)
    {
        $sql = ('
					INSERT INTO ShaiyaCMS.dbo.USER_FRIENDS
					(ToUser,FromUser)
					VALUES(:touser,:fromuser)
		');
        $this->db->query($sql);
        $this->db->bind(':touser', $user1);
        $this->db->bind(':fromuser', $user2);
        $this->db->execute();
    }

    public function removeFriend($user1, $user2)
    {
        $sql = ('
					DELETE FROM ShaiyaCMS.dbo.USER_FRIENDS
					WHERE ToUser = :touser AND FromUser = :fromuser AND Pending = :pending
					OR ToUser = :touser2 AND FromUser = :fromuser2 AND Pending = :pending2
		');
        $this->db->query($sql);
        $this->db->bind(':touser', $user1);
        $this->db->bind(':fromuser', $user2);
        $this->db->bind(':pending', 0);
        $this->db->bind(':touser2', $user2);
        $this->db->bind(':fromuser2', $user1);
        $this->db->bind(':pending2', 0);
        $this->db->execute();
    }

    public function blockUser($user1, $user2)
    {
    }

    public function isFriends($user1, $user2)
    {
    }

    public function isFriendRequestPending($user1, $user2)
    {
        $sql = ('
					SELECT * FROM ShaiyaCMS.dbo.USER_FRIENDS
					WHERE ToUser = :touser AND FromUser = :fromuser AND Pending = :pending
					OR ToUser = :touser2 AND FromUser = :fromuser2 AND Pending = :pending2
		');
        $this->db->query($sql);
        $this->db->bind(':touser', $user1);
        $this->db->bind(':fromuser', $user2);
        $this->db->bind(':pending', 1);
        $this->db->bind(':touser2', $user2);
        $this->db->bind(':fromuser2', $user1);
        $this->db->bind(':pending2', 1);
        $res = $this->db->resultSet();
        return $res;
    }

    public function checkFriendRequests($user)
    {
        $sql = ('
					SELECT * FROM ShaiyaCMS.dbo.USER_FRIENDS
					WHERE ToUser = :touser AND Pending = :pending
		');
        $this->db->query($sql);
        $this->db->bind(':touser', $user);
        $this->db->bind(':pending', 1);
        $res = $this->db->resultSet();
        return $res;
    }

    public function acceptFriendRequest($user1, $user2)
    {
        $sql = ('
					UPDATE ShaiyaCMS.dbo.USER_FRIENDS
					SET Pending = :pending
					WHERE ToUser = :touser AND FromUser = :fromuser AND Pending = :status
					OR ToUser = :touser2 AND FromUser = :fromuser2 AND Pending = :status2
		');
        $this->db->query($sql);
        $this->db->bind(':pending', 0);
        $this->db->bind(':touser', $user1);
        $this->db->bind(':fromuser', $user2);
        $this->db->bind(':touser2', $user2);
        $this->db->bind(':fromuser2', $user1);
        $this->db->bind(':status', 1);
        $this->db->bind(':status2', 1);
        $this->db->execute();
    }

    public function checkFriends($user)
    {
        $sql = ('
					SELECT [FR].[FromUser],[FR].[ToUser],[FR].[Pending],[WP].[DisplayName] FROM ShaiyaCMS.dbo.USER_FRIENDS AS [FR]
					INNER JOIN PS_UserData.dbo.Users_Master AS [U] ON [FR].[FromUser] = [U].[UserUID]
					INNER JOIN ShaiyaCMS.dbo.WEB_PRESENCE AS [WP] ON [U].[UserID] = [WP].[UserID]
					WHERE ToUser = :touser AND Pending = :pending
					OR FromUser = :touser2 AND Pending = :pending2
		');
        $this->db->query($sql);
        $this->db->bind(':touser', $user);
        $this->db->bind(':pending', 0);
        $this->db->bind(':touser2', $user);
        $this->db->bind(':pending2', 0);
        $res = $this->db->resultSet();
            return $res;
    }

    public function cancelRequest($user1, $user2)
    {
        $sql = ('
					DELETE FROM ShaiyaCMS.dbo.USER_FRIENDS
					WHERE ToUser = :touser AND FromUser = :fromuser AND Pending = :pending
					OR ToUser = :touser2 AND FromUser = :fromuser2 AND Pending = :pending2
		');
        $this->db->query($sql);
        $this->db->bind(':touser', $user1);
        $this->db->bind(':fromuser', $user2);
        $this->db->bind(':touser2', $user2);
        $this->db->bind(':fromuser2', $user1);
        $this->db->bind(':pending', 1);
        $this->db->bind(':pending2', 1);
        $this->db->execute();
    }
}
