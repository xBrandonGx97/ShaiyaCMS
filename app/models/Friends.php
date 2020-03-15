<?php
	
	class Friends {
		public function __construct() {
			$this->MSSQL = new Classes\DB\MSSQL;
			$this->Data = new Classes\Utils\Data;
			$this->User = new Classes\Utils\User;
			$this->User->run();
			$this->User = $this->User->_fetch_User();
		}
		public function ifFriendsExist($user1, $user2) {
			//check if friends exist before adding friend
			$sql	=	('
							SELECT * FROM ShaiyaCMS.dbo.USER_FRIENDS
							WHERE ToUser = :touser AND FromUser = :fromuser
							OR ToUser = :touser2 AND FromUser = :fromuser2
			');
			$this->MSSQL->query($sql);
			$this->MSSQL->bind(':touser', $user1);
			$this->MSSQL->bind(':fromuser', $user2);
			$this->MSSQL->bind(':touser2', $user2);
			$this->MSSQL->bind(':fromuser2', $user1);
			$res = $this->MSSQL->resultSet();
			return $res;
		}
		public function addFriend($user1, $user2) {
			$sql	=	('
							INSERT INTO ShaiyaCMS.dbo.USER_FRIENDS
							(ToUser,FromUser)
							VALUES(:touser,:fromuser)
			');
			$this->MSSQL->query($sql);
			$this->MSSQL->bind(':touser', $user1);
			$this->MSSQL->bind(':fromuser', $user2);
			$this->MSSQL->execute();
		}
		public function removeFriend($user1, $user2) {
			$sql	=	('
							DELETE FROM ShaiyaCMS.dbo.USER_FRIENDS
							WHERE ToUser = :touser AND FromUser = :fromuser AND Pending = :pending
							OR ToUser = :touser2 AND FromUser = :fromuser2 AND Pending = :pending2
			');
			$this->MSSQL->query($sql);
			$this->MSSQL->bind(':touser', $user1);
			$this->MSSQL->bind(':fromuser', $user2);
			$this->MSSQL->bind(':pending', 0);
			$this->MSSQL->bind(':touser2', $user2);
			$this->MSSQL->bind(':fromuser2', $user1);
			$this->MSSQL->bind(':pending2', 0);
			$this->MSSQL->execute();
		}
		public function blockUser($user1, $user2) {
		
		}
		public function isFriends($user1, $user2) {
		
		}
		public function isFriendRequestPending($user1, $user2) {
			$sql	=	('
							SELECT * FROM ShaiyaCMS.dbo.USER_FRIENDS
							WHERE ToUser = :touser AND FromUser = :fromuser AND Pending = :pending
							OR ToUser = :touser2 AND FromUser = :fromuser2 AND Pending = :pending2
			');
			$this->MSSQL->query($sql);
			$this->MSSQL->bind(':touser', $user1);
			$this->MSSQL->bind(':fromuser', $user2);
			$this->MSSQL->bind(':pending', 1);
			$this->MSSQL->bind(':touser2', $user2);
			$this->MSSQL->bind(':fromuser2', $user1);
			$this->MSSQL->bind(':pending2', 1);
			$res = $this->MSSQL->resultSet();
			return $res;
		}
		public function checkFriendRequests($user) {
			$sql	=	('
							SELECT * FROM ShaiyaCMS.dbo.USER_FRIENDS
							WHERE ToUser = :touser AND Pending = :pending
			');
			$this->MSSQL->query($sql);
			$this->MSSQL->bind(':touser', $user);
			$this->MSSQL->bind(':pending', 1);
			$res = $this->MSSQL->resultSet();
			return $res;
		}
		public function acceptFriendRequest($user1, $user2) {
			$sql	=	('
							UPDATE ShaiyaCMS.dbo.USER_FRIENDS
							SET Pending = :pending
							WHERE ToUser = :touser AND FromUser = :fromuser AND Pending = :status
							OR ToUser = :touser2 AND FromUser = :fromuser2 AND Pending = :status2
			');
			$this->MSSQL->query($sql);
			$this->MSSQL->bind(':pending', 0);
			$this->MSSQL->bind(':touser', $user1);
			$this->MSSQL->bind(':fromuser', $user2);
			$this->MSSQL->bind(':touser2', $user2);
			$this->MSSQL->bind(':fromuser2', $user1);
			$this->MSSQL->bind(':status', 1);
			$this->MSSQL->bind(':status2', 1);
			$this->MSSQL->execute();
		}
		public function checkFriends($user) {
			$sql	=	('
							SELECT [FR].[FromUser],[FR].[ToUser],[FR].[Pending],[WP].[DisplayName] FROM ShaiyaCMS.dbo.USER_FRIENDS AS [FR]
							INNER JOIN PS_UserData.dbo.Users_Master AS [U] ON [FR].[FromUser] = [U].[UserUID]
							INNER JOIN ShaiyaCMS.dbo.WEB_PRESENCE AS [WP] ON [U].[UserID] = [WP].[UserID]
							WHERE ToUser = :touser AND Pending = :pending
							OR FromUser = :touser2 AND Pending = :pending2
			');
			$this->MSSQL->query($sql);
			$this->MSSQL->bind(':touser', $user);
			$this->MSSQL->bind(':pending', 0);
			$this->MSSQL->bind(':touser2', $user);
			$this->MSSQL->bind(':pending2', 0);
			$res = $this->MSSQL->resultSet();
			return $res;
		}
		public function cancelRequest($user1, $user2) {
			$sql	=	('
							DELETE FROM ShaiyaCMS.dbo.USER_FRIENDS
							WHERE ToUser = :touser AND FromUser = :fromuser AND Pending = :pending
							OR ToUser = :touser2 AND FromUser = :fromuser2 AND Pending = :pending2
			');
			$this->MSSQL->query($sql);
			$this->MSSQL->bind(':touser', $user1);
			$this->MSSQL->bind(':fromuser', $user2);
			$this->MSSQL->bind(':touser2', $user2);
			$this->MSSQL->bind(':fromuser2', $user1);
			$this->MSSQL->bind(':pending', 1);
			$this->MSSQL->bind(':pending2', 1);
			$this->MSSQL->execute();
		}
	}