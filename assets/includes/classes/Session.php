<?php
	class Session{

		public static $CMS_SESSION;
		public static $LoggedIn;

		public static function LOGIN(){
			self::$LoggedIn=true;
		}
		public static function LOGOUT(){
			self::$LoggedIn=false;
		}
		public static function IS_LOGGED_IN(){
			return self::$LoggedIn;
		}
		public static function CREATE_SESSION($data){
			self::$CMS_SESSION	=	hash("sha512",$_SERVER["REMOTE_ADDR"].$_SESSION["uid"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			self::LOGIN();

			return self::$CMS_SESSION;
		}
		public static function CHECK_SESSION(){
			$CHECK	=	hash("sha512",$_SERVER["REMOTE_ADDR"].$_SESSION["uid"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			if($CHECK !== self::$CMS_SESSION){
				session_destroy();
				header('location: ./home');
				exit();
			}
			else{
				return true;
			}
		}
		public static function STORE_SESSION($Action){
			$sql = ("
						INSERT INTO ".Database::getTable("LOG_SESSION")."
							(UserUID,UserID,AcctStatus,Action,OS,Browser,BrowserVer,UserIP)
						VALUES
							(:uuid,:uid,:status,:action,:os,:browser,:useragent,:userip)
				");
			$stmt=Database::connect()->prepare($sql);
			$stmt->execute(array(
						':uuid' => $_SESSION['uuid'],
						':uid' => $_SESSION['uid'],
						':status' => $_SESSION['Status'],
						':action' => $Action,
						':os' => Browser::$OS_Platform,
						':browser' => Browser::$BrowserType,
						':useragent' => Browser::$UserAgent,
						':userip' => Browser::$UserIP,
						':cms_sid' => $_SESSION['CMS_SID']
			));

			#if($this->Setting->SITE_TYPE == "SHAIYA"){
/*
				$sql	=	('
								UPDATE '.Database::getTable("SH_USERDATA").'
								SET JoinDate	=	?,
									Leave		=	?
								WHERE UserUID	=	?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(date('Y-m-d H:i:s'),1,$_SESSION['UserUID']);
				odbc_execute($stmt,$args);
*/
			#}
		}
		public static function CLOSE_SESSION($UserUID){
			$sql = ('
						UPDATE '.Database::getTable("LOG_SESSION").'
						SET LogoutDate	=	?
						WHERE UserUID	=	?
			');
			$stmt=Database::connect()->prepare($sql);
			$args	=	array(date('Y-m-d H:i:s'),$UserUID);
			$stmt->execute($args);

			#if($this->Setting->SITE_TYPE == "SHAIYA"){
/*
				$sql	=	('
								UPDATE '.Database::getTable("SH_USERDATA").'
								SET LeaveDate	=	?,
									Leave		=	?
								WHERE UserUID	=	?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(date('Y-m-d H:i:s'),0,$UserUID);
				odbc_execute($stmt,$args);
*/
			#}
			self::LOGOUT();
			session_name("shCMS");
			session_regenerate_id(true);
			session_start();
			session_unset();
			session_destroy();
		}
	}