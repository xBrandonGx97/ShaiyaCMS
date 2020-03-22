<?php
	class Session{

		public $CMS_SESSION;
		public $LoggedIn;

		public function __construct($Database,$Browser,$Setting,$User){
			$this->db		=	$Database;
			$this->Browser	=	$Browser;
			$this->Setting	=	$Setting;
			$this->User		=	$User;
		}
		function LOGIN(){
			$this->LoggedIn=true;
		}
		function LOGOUT(){
			$this->LoggedIn=false;
		}
		function IS_LOGGED_IN(){
			return $this->LoggedIn;
		}
		function CREATE_SESSION($data){
			$this->CMS_SESSION	=	hash("sha512",$_SERVER["REMOTE_ADDR"].$_SESSION["uid"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			$this->LOGIN();

			return $this->CMS_SESSION;
		}
		function CHECK_SESSION(){
			$CHECK	=	hash("sha512",$_SERVER["REMOTE_ADDR"].$_SESSION["uid"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			if($CHECK !== $this->CMS_SESSION){
				session_destroy();
				header('location: ?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD');
				exit();
			}
			else{
				return true;
			}
		}
		function STORE_SESSION($Action){
			$sql = ("
						INSERT INTO ".$this->db->get_TABLE("LOG_SESSION")."
							(UserUID,UserID,AcctStatus,Action,OS,Browser,BrowserVer,UserIP)
						VALUES
							(:uuid,:uid,:status,:action,:os,:browser,:useragent,:userip)
				");
			$stmt=$this->db->conn->prepare($sql);
			$stmt->execute(array(
						':uuid' => $_SESSION['uuid'],
						':uid' => $_SESSION['uid'],
						':status' => $_SESSION['Status'],
						':action' => $Action,
						':os' => $this->Browser->OS_Platform,
						':browser' => $this->Browser->BrowserType,
						':useragent' => $this->Browser->UserAgent,
						':userip' => $this->Browser->UserIP,
						':cms_sid' => $_SESSION['CMS_SID']
			));

			if($this->Setting->SITE_TYPE == "SHAIYA"){
/*
				$sql	=	('
								UPDATE '.$this->db->get_TABLE("SH_USERDATA").'
								SET JoinDate	=	?,
									Leave		=	?
								WHERE UserUID	=	?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(date('Y-m-d H:i:s'),1,$_SESSION['UserUID']);
				odbc_execute($stmt,$args);
*/
			}
		}
		function CLOSE_SESSION($UserUID){
			$sql = ('
						UPDATE '.$this->db->get_TABLE("LOG_SESSION").'
						SET LogoutDate	=	?
						WHERE UserUID	=	?
			');
			$stmt=$this->db->conn->prepare($sql);
			$args	=	array(date('Y-m-d H:i:s'),$UserUID);
			$stmt->execute($args);

			if($this->Setting->SITE_TYPE == "SHAIYA"){
/*
				$sql	=	('
								UPDATE '.$this->db->get_TABLE("SH_USERDATA").'
								SET LeaveDate	=	?,
									Leave		=	?
								WHERE UserUID	=	?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(date('Y-m-d H:i:s'),0,$UserUID);
				odbc_execute($stmt,$args);
*/
			}
			$this->LOGOUT();
			session_regenerate_id(true);
			session_start();
			session_unset();
			session_destroy();
		}
	}

/*
	$member = new Member();
	$member->username = "Fred";
	echo $member->username . " is " . ( $member->isLoggedIn() ? "logged in" : "logged out" ) . "<br>";
	$member->login();
	echo $member->username . " is " . ( $member->isLoggedIn() ? "logged in" : "logged out" ) . "<br>";
	$member->logout();
	echo $member->username . " is " . ( $member->isLoggedIn() ? "logged in" : "logged out" ) . "<br>";
 */