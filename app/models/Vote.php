<?php
	
	class Vote {
		public $fet;
		public $Point	=	250;
		public $time_needed	=	'720';
		public $time	=	12;
		public $referer	=	NULL;
		public $XtremeTop100	=	'http://www.xtremetop100.com/in.php?site=1132367751';
		public $OxigenTop100	=	'';
		public $GamingTop100	=	'';
		public $TopOfGames		=	'';
		public $referer1	=	'http://www.xtremetop100.com/out.php?site=1132367751';
		public $referer2	=	'';
		public $referer3	=	'';
		public $referer4	=	'';
		public $VoteStatus	=	'Not Voted';
		
		public function __construct() {
			$this->MSSQL = new Classes\DB\MSSQL;
			$this->Data = new Classes\Utils\Data;
			$this->User = new Classes\Utils\User;
			$this->User->run();
			$this->User = $this->User->_fetch_User();
			$this->getVoteReferer();
		}
		
		public function getVoteReferer() {
			if (isset($_SERVER['HTTP_REFERER'])) {
				$this->referer	=	$_SERVER['HTTP_REFERER'];
			}else {
				$this->referer	=	NULL;
			}
			$date = date("Y-m-d G:i", time());
			$ip	  = $_SERVER['REMOTE_ADDR'];
			$Point	=	$this->Point;
			if(isset($_POST['Vote'])) {
				$site 	= htmlentities($_POST['site']);
				switch($site) {
					case "nr1": $link = $this->XtremeTop100; break;
					case "nr2": $link = $this->OxigenTop100; break;
					case "nr3": $link = $this->GamingTop100; break;
					case "nr4": $link = $this->TopOfGames; break;
				}
				$this->MSSQL->query('SELECT * FROM PS_UserData.dbo.Users_Master  WHERE UserID=:user');
				$this->MSSQL->bind(':user', $this->User['UserID']);
				$res = $this->MSSQL->resultSet(true);
				$rowCount	=	count($res);
				if($rowCount > 0) {
					$this->MSSQL->query('SELECT * FROM ShaiyaCMS.dbo.VOTES WHERE UserID = :user AND VoteSite = :site AND UserIP = :ip');
					$this->MSSQL->bind(':user', $this->User['UserID']);
					$this->MSSQL->bind(':site', $site);
					$this->MSSQL->bind(':ip', $ip);
					$res = $this->MSSQL->resultSet(true);
					$rowCount	=	count($res);
					foreach($res as $data) {
						$voted_date = $data['Date'];
						$to_time = strtotime($voted_date);
					    $from_time = strtotime($date);
					}
					if($rowCount > 0){
						if (round(abs($to_time - $from_time) / 60,2) > $this->time_needed){
							$this->MSSQL->query('DELETE FROM ShaiyaCMS.dbo.VOTES WHERE UserID = :user AND VoteSite = :site');
							$this->MSSQL->bind(':user', $this->User['UserID']);
							$this->MSSQL->bind(':site', $site);
							$this->MSSQL->execute();
							
							$expire = 365*24*3600;
							$data = sha1($this->User['UserID'].$_SERVER['HTTP_USER_AGENT'].$this->User['UserUID'].$Point.$ip);
							
							setcookie('Vote4DP', $data, time() + $expire, "/",null,null,true);
						    setcookie('VoteID', User::$UserID, time() + $expire, "/",null,null,true);
						    setcookie('VoteSite', $site, time() + $expire, "/",null,null,true);
						    
						    $this->MSSQL->query('INSERT INTO ShaiyaCMS.dbo.VOTES
                                        (UserUID,UserID,UserIP,Date,VoteSite,SetSession,VoteStatus,Cookie)
                                        VALUES (:uid,:user,:ip,:date,:site,:session,:status,:cookie)');
							$this->MSSQL->bind(':uid', $this->User['UserUID']);
							$this->MSSQL->bind(':user', $this->User['UserID']);
							$this->MSSQL->bind(':ip', $ip);
							$this->MSSQL->bind(':date', $date);
							$this->MSSQL->bind(':site', $site);
							$this->MSSQL->bind(':session', 1);
							$this->MSSQL->bind(':status', 'Waiting For Vote');
							$this->MSSQL->bind(':cookie', $data);
							$this->MSSQL->execute();
							
							header('location:' .$link);
						} else {
							echo '<SCRIPT LANGUAGE="JavaScript">alert("Please wait 12 hours before revoting.")</script>';
						}
					} else {
						$expire = 365*24*3600;
						$data = sha1($this->User['UserID'].$_SERVER['HTTP_USER_AGENT'].$this->User['UserUID'].$Point.$ip);
						
						setcookie('Vote4DP', $data, time() + $expire, "/",null,null,true);
						setcookie('VoteID', $this->User['UserID'], time() + $expire, "/",null,null,true);
						setcookie('VoteSite', $site, time() + $expire, "/",null,null,true);
						
						$this->MSSQL->query('INSERT INTO ShaiyaCMS.dbo.VOTES
                                    (UserUID,UserID,UserIP,Date,VoteSite,SetSession,VoteStatus,Cookie)
                                    VALUES (:uid,:user,:ip,:date,:site,:session,:status,:cookie)');
						$this->MSSQL->bind(':uid', $this->User['UserUID']);
						$this->MSSQL->bind(':user', $this->User['UserID']);
						$this->MSSQL->bind(':ip', $ip);
						$this->MSSQL->bind(':date', $date);
						$this->MSSQL->bind(':site', $site);
						$this->MSSQL->bind(':session', 1);
						$this->MSSQL->bind(':status', 'Waiting For Vote');
						$this->MSSQL->bind(':cookie', $data);
						$this->MSSQL->execute();
						
						$this->MSSQL->query('UPDATE ShaiyaCMS.dbo.VOTES
                                        SET VoteWait = :votewait
                                        WHERE UserID = :user');
						$this->MSSQL->bind(':votewait', 1);
						$this->MSSQL->bind(':user', $this->User['UserID']);
						$this->MSSQL->execute();
						
						$this->VoteStatus	=	'Waiting For Vote';
						
						header('location:' .$link);
					}
				} else {
					# user not found
				}
			}
			if(isset($_COOKIE['Vote4DP']) && isset($_COOKIE['VoteID'])) {
				$this->MSSQL->query('SELECT * FROM ShaiyaCMS.dbo.VOTES
                            WHERE UserID = :user AND VoteSite = :site AND UserIP = :ip AND Cookie = :cookie');
				$this->MSSQL->bind(':user', $this->User['UserID']);
				$this->MSSQL->bind(':site', $_COOKIE['VoteSite']);
				$this->MSSQL->bind(':ip', $ip);
				$this->MSSQL->bind(':cookie', $_COOKIE['Vote4DP']);
				$res = $this->MSSQL->resultSet(true);
				$rowCount	=	count($res);
				if($rowCount > 0) {
					foreach($res as $data){
						# site 1
						if ($data['VoteSite'] =='nr1' && $this->referer == $this->referer1){
							$this->MSSQL->query('UPDATE PS_UserData.dbo.Users_Master
                                    SET Point = Point+:point
                                    WHERE UserID = :user');
							$this->MSSQL->bind(':point', $Point);
							$this->MSSQL->bind(':user', $this->User['UserID']);
							$this->MSSQL->execute();
							
							echo '<script language="javascript">alert("Thank you for your vote!")</script>';
							
							$expire = 365*24*3600;
							setcookie('Vote4DP', 'finished', time() + $expire, "/",null,null,true);
						}
						# site 2
						else if ($data['VoteSite'] =='nr2' && $this->referer == $this->referer2){
							$this->MSSQL->query('UPDATE PS_UserData.dbo.Users_Master
                                    SET Point = Point+:point
                                    WHERE UserID = :user');
							$this->MSSQL->bind(':point', $Point);
							$this->MSSQL->bind(':user', $this->User['UserID']);
							$this->MSSQL->execute();
							
							echo '<script language="javascript">alert("Thank you for your vote!")</script>';

                            $expire = 365*24*3600;
                            setcookie('Vote4DP', 'finished', time() + $expire, "/",null,null,true);
						}
						# site 3
						else if ($data['VoteSite'] =='nr3' && $this->referer == $this->referer3){
							$this->MSSQL->query('UPDATE PS_UserData.dbo.Users_Master
                                    SET Point = Point+:point
                                    WHERE UserID = :user');
							$this->MSSQL->bind(':point', $Point);
							$this->MSSQL->bind(':user', $this->User['UserID']);
							$this->MSSQL->execute();
							
							echo '<script language="javascript">alert("Thank you for your vote!")</script>';

                            $expire = 365*24*3600;
                            setcookie('Vote4DP', 'finished', time() + $expire, "/",null,null,true);
						}
						# site 4
						else if ($data['VoteSite'] =='nr4' && $this->referer == $this->referer4){
							$this->MSSQL->query('UPDATE PS_UserData.dbo.Users_Master
                                    SET Point = Point+:point
                                    WHERE UserID = :user');
							$this->MSSQL->bind(':point', $Point);
							$this->MSSQL->bind(':user', $this->User['UserID']);
							$this->MSSQL->execute();
							
							echo '<script language="javascript">alert("Thank you for your vote!")</script>';

                            $expire = 365*24*3600;
                            setcookie('Vote4DP', 'finished', time() + $expire, "/",null,null,true);
						}
					}
				}
			}
		}
	}