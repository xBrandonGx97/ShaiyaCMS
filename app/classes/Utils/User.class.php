<?php
	namespace Classes\Utils;
	
	if(!defined('IN_CMS')){die('<b>'.__NAMESPACE__.'\User</b>: unauthorized access detected, exiting...');}

	use Classes\DB\MSSQL;
	use Classes\Settings\Settings;

	class User{

		# SQL
		private static $sql;private static $stmt;private static $res;private static $fet;
		# Account Info - Shared
		public static $AdminLevel;
		public static $Country;
		public static $DisplayName;
		public static $DOB;
		public static $Email;
		public static $JoinDate;
		public static $LeaveDate;
		public static $LoginStatus;
		public static $Point;
		public static $RegDate;
		public static $Status;
		public static $UseQueue;
		public static $UserUID;
		public static $UserID;
		public static $UserIP;
		public static $is_staff = [
				'16',
				'32',
				'48',
				'64',
				'80',
				'128'
		];
		public static $userFlags = [];
		public static $flags = [
			'CREATE'
		];

		# Status
		private static $ADM;
		private static $GM;
		private static $GS;
		private static $Member;

		# Session
		public static $LoginGuest;

		# Other
		public static $MapID;

		public static function run(){
			if(isset($_SESSION) && isset($_SESSION["User"]["UserUID"]) || isset($_COOKIE['stayLoggedIn'])) {
				$SessionCookieCheck	= isset($_COOKIE['stayLoggedIn']) ? $_COOKIE['UserUID'] : $_SESSION['User']['UserUID'];
				if($_SESSION['Settings']["SITE_TYPE"] == 'SH'){
					self::$sql=("SELECT TOP 1
									[UM].[UserUID],[UM].[UserID],[UM].[Pw],[UM].[Point],[UM].[Status],[UM].[JoinDate],[UM].[LeaveDate],
									[WP].[DisplayName],[WP].[PIN],[WP].[Email],[WP].[ActivationKey],[WP].[UserIP],[WP].[LoginStatus]
								FROM ".MSSQL::getTable("SH_USERDATA")."			AS [UM]
								INNER JOIN ".MSSQL::getTable("WEB_PRESENCE")."	AS [WP] ON [UM].[UserID]=[WP].[UserID]
								WHERE [UM].[UserUID] = :uid
					");
					MSSQL::query(self::$sql);
					MSSQL::bind(':uid', $SessionCookieCheck);
				    self::$fet    =   MSSQL::single(1);
				}

				# Shaiya Data
				self::$JoinDate		=	self::$fet["JoinDate"];
				self::$LeaveDate	=	self::$fet["LeaveDate"];
				self::$Point		=	self::$fet["Point"];
				self::$LoginStatus	=	self::$fet["LoginStatus"];

				# Web Presence
				#$this->Country		=	self::$fet["Country"];
				self::$DisplayName	=	self::$fet["DisplayName"];
				#$this->DOB			=	self::$fet["DateOfBirth"];
				self::$Email		=	self::$fet["Email"];
				self::$Status		=	self::$fet["Status"];
			#	self::$AdminLevel	=	self::$fet["AdminLevel"];
				self::$UserID		=	self::$fet["UserID"];
				self::$UserIP		=	self::$fet["UserIP"];
				self::$UserUID		=	self::$fet["UserUID"];

			#	self::_is_staff(self::$AdminLevel);

				# Cleanup
				self::$sql=null;
				self::$fet=null;
				self::$res=null;
			}

			self::_is_Logged_In();
		}
		public function _class_info($level=false){
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
			}
		}
		public function _get_data($data){
			if($this->$data){
				return $this->$data;
			}
			else{
				die('<b>Class ('.get_class($this).'):</b><br>The requested var, <b>'.$data.'</b>, couldn\'t be found.');
			}
		}
		public function _get_UserInfo($data){
			switch($data){
				case 'JoinDate':
					return date("m/d/Y", strtotime($this->$data));
				break;
				case 'LeaveDate':
					return date("m/d/Y", strtotime($this->$data));
				break;
				case 'LoginDate':
					return date("m/d/Y", strtotime($this->$data));
				break;
				case 'RegDate':
					return date("m/d/Y", strtotime($this->$data));
				break;
				default: return $this->$data;
			}
		}
		public static function _is_staff(){
			if(isset($_SESSION["User"])){
				switch($_SESSION["User"]["Status"]){
					case	'16'	:
						self::$ADM=true;
						return true;
					break;
					case	'32'	:
						self::$GM=true;
						return true;
					break;
					case	'48'	:
						self::$GM=true;
						return true;
					break;
					case	'64'	:
						self::$GM=true;
						return true;
					break;
					case	'80'	:
						self::$GM=true;
						return true;
					break;
					case	'128'	:
						self::$GS=true;
						return true;
					break;
				}
			}

			return false;
		}
		function _is_ADM(){
			if(isset($_SESSION)){
				if($_SESSION["User"]["Status"] == 16){
					return true;
				}
			}

			return false;
		}
		function _is_GM(){
			if($this->Status == 32 || $this->Status == 48 || $this->Status == 64 || $this->Status == 80){
				return true;
			}

			return false;
		}
		function _is_GS(){
			if($this->Status == 128){
				return true;
			}
			return false;
		}
		public static function _is_Logged_In(){
			if(!empty(self::$UserUID) && !empty(self::$UserID) && is_numeric(self::$UserUID)){
				self::$LoginStatus	=	true;
				return true;
			} else {
				self::$LoginStatus	=	false;
				return false;
			}
			/*if(!empty(self::$UserUID) && !empty(self::$UserID) && is_numeric(self::$UserUID)){
				self::$LoginStatus	=	1;
				return true;
			}
			else{
				self::$LoginStatus	=	0;
				return false;
			}*/
		}
		function get_isCharExist() {
			# Char Existence Check
			$sql	=	("SELECT * FROM ".Chars." WHERE UserUID=?");
			$stmt	=	odbc_prepare($cxn,$sql);
			$args	=	array($this->UserUID);
			if(!odbc_execute($stmt,$args)){
				return false;
			}elseif($row=odbc_fetch_array($stmt)){
				return true;
			}
		}
		function get_isLoggedInName(){
			# User Login Check
			$UserLoginStatus=false;
			if(isset($this->UserUID,$this->UserID)){
				$UserLoginStatus = $this->UserID;
			}else{
				$UserLoginStatus = "Guest";
			}
			return $UserLoginStatus;
		}
		function Auth(){
			die('Fix me');
			if(!$this->_is_Logged_In()){
				header('location: /ap');
				die();
			}
		}
		function AuthADM(){
			die('Fix me');
		    if(!$this->_is_ADM()){
		        header('location: /ap');
				die();
            }
        }
        function AuthStaff(){
			die('Fix me');
		    if(!$this->_is_staff()){
		        header('location: /ap');
				die();
            }
        }
		function accessCheck(){
		    if ($this->_is_Logged_In()){
				if(!$this->_is_staff()){
					#Template::doACP_Head("","",false,"12","Access Denied!");
						return '<span style="color:red">Sorry, you don\'t have permission to access this website!</span>';
					#Template::doACP_Foot();
				}
			}
        }
		public static function get_Status($Status){
			switch($Status){
				case '0':	return 'Player'; break;
				case '10':	return 'Administrator'; break;
				case '16':	return 'Administrator'; break;
				case '32':	return 'GameMaster'; break;
				case '48':	return 'GameMaster'; break;
				case '64':	return 'GameMaster Assistant'; break;
				case '80':	return 'GameSage'; break;
			}
		}
		function get_Faction($Faction){
			switch($Faction){
				case '0'	:	return	'Alliance of Light';		break;
				case '1'	:	return	'Union of Fury';			break;
			}
		}
        public static function get_Map($Map){
			switch($Map){
				case 0	:	return 'D-Water'; 						break;
				case 1	:	return 'Erina'; 						break;
				case 2	:	return 'Reikeuseu'; 					break;
				case 3	:	return 'D1'; 							break;
				case 4	:	return 'D1'; 							break;
				case 5	:	return 'Cornwell\'s Ruin'; 				break;
				case 6	:	return 'Cornwell\'s Ruin'; 				break;
				case 7	:	return 'Argilla Ruin'; 					break;
				case 8	:	return 'Argilla Ruin'; 					break;
				case 9	:	return 'D2'; 							break;
				case 10	:	return 'D2'; 							break;
				case 11	:	return 'Kimu Room'; 					break;
				case 12	:	return 'Cloron\'s Lair'; 				break;
				case 13	:	return 'Cloron\'s Lair'; 				break;
				case 14	:	return 'Cloron\'s Lair'; 				break;
				case 15	:	return 'Fantasma\'s Lair'; 				break;
				case 16	:	return 'Fantasma\'s Lair'; 				break;
				case 17	:	return 'Fantasma\'s Lair'; 				break;
				case 18	:	return 'Proelium'; 						break;
				case 19	:	return 'Willieoseu'; 					break;
				case 20	:	return 'Keuraijen'; 					break;
				case 21	:	return 'Maitreyan FL2'; 				break;
				case 22	:	return 'Maitreyan FL2'; 				break;
				case 23	:	return 'Aidion Nekria FL2'; 			break;
				case 24	:	return 'Aidion Nekria FL2'; 			break;
				case 25	:	return 'Elemental Cave'; 				break;
				case 26	:	return 'Ruber Chaos'; 					break;
				case 27	:	return 'Ruber Chaos'; 					break;
				case 28	:	return 'Adellia'; 						break;
				case 29	:	return 'Adeurian'; 						break;
				case 30	:	return 'Cantabilian'; 					break;
				case 31	:	return 'Paros Temple'; 					break;
				case 32	:	return 'Rapioru Maze'; 					break;
				case 33	:	return 'Fedion Temple'; 				break;
				case 34	:	return 'Khalamus House'; 				break;
				case 35	:	return 'Apulune'; 						break;
				case 36	:	return 'Iris'; 							break;
				case 37	:	return 'Cave of Stigma'; 				break;
				case 38	:	return 'Aurizen Ruin'; 					break;
				case 39	:	return 'Secret Battle Arena'; 			break;
				case 40	:	return 'Underground Stadium'; 			break;
				case 41	:	return 'Prison'; 						break;
				case 42	:	return 'Auction House'; 				break;
				case 43	:	return 'Skulleron'; 					break;
				case 44	:	return 'Astenes'; 						break;
				case 45	:	return 'Deep Desert 1'; 				break;
				case 46	:	return 'Deep Desert 2'; 				break;
				case 47	:	return 'Stable Erde'; 					break;
				case 48	:	return 'Cryptic Throne'; 				break;
				case 49	:	return 'Cryptic Throne'; 				break;
				case 50	:	return 'GRB'; 							break;
				case 51	:	return 'Guild House'; 					break;
				case 52	:	return 'Guild House'; 					break;
				case 53	:	return 'Guild Management Office'; 		break;
				case 54	:	return 'Guild Management Office'; 		break;
				case 55	:	return 'Sky City'; 						break;
				case 56	:	return 'Sky City'; 						break;
				case 57	:	return 'Sky City'; 						break;
				case 58	:	return 'Sky City'; 						break;
				case 59	:	return 'Garden of Goddess'; 			break;
				case 60	:	return 'World Cup'; 					break;
				case 61	:	return 'Garden of Goddess'; 			break;
				case 62	:	return 'Khalamus House'; 				break;
				case 63	:	return 'Aurizen Ruin'; 					break;
				case 64	:	return 'Oblivian Island'; 				break;
				case 65	:	return 'Caelum Sacra'; 					break;
				case 66	:	return 'Caelum Sacra'; 					break;
				case 67	:	return 'Caelum Sacra Boss Room'; 		break;
				case 68	:	return 'Valdemar Regnum'; 				break;
				case 69	:	return 'Palaion Regnum'; 				break;
				case 70	:	return 'Kanos Illium'; 					break;
				case 71	:	return 'Queen Servus'; 					break;
				case 72	:	return 'Queen Caput'; 					break;
				case 73	:	return 'Zeharr\'s Mine'; 				break;
				case 74	:	return 'Dimension\'s Crack'; 			break;
				case 75	:	return 'Pantanssa'; 					break;
				case 76	:	return 'Theodores'; 					break;
				case 77	:	return 'Arcanus Ruins'; 				break;
				case 78	:	return 'Arcanus Ruins FL2'; 			break;
				case 79	:	return 'Hypnosis Ruins'; 				break;
				case 80	:	return 'Wedding Map'; 					break;
				case 81	:	return 'Canyon of Greed'; 				break;
				case 82	:	return 'Unknown'; 						break;
				case 83	:	return 'Unknown'; 						break;
				case 84	:	return 'Unknown'; 						break;
				case 85	:	return 'Unknown'; 						break;
				case 86	:	return 'Unknown'; 						break;
			}
		}
		public static function _fetch_UserGameInfo($UserUID,$col=false){
			$return=false;

			$sql	=	('SELECT * FROM '.MSSQL::getTable("SH_USERDATA").' WHERE UserUID=:uid ');
			MSSQL::query($sql);
			MSSQL::bind(':uid', $UserUID);

			if(MSSQL::$stmt->execute()){
				$return=array();
				$cnt=0;

				while($results=MSSQL::$stmt->fetch()){
					foreach($results as $key=>$value){
						if($col){
							if($key==$col){
								$return=$results[$col];
								break;
							}
							else{
								$return = 'Datatype Invalid';
							}
						}
						else{
							$return[$key]=$value;
						}
					}
					$cnt++;
				}
			}

			return $return;
		}
		public static function _fetch_UserWebInfo($UserUID,$col=false){

			$return=false;

			$sql	=	('SELECT * FROM '.MSSQL::getTable("WEB_PRESENCE").' WHERE UserID=:uid ');
			MSSQL::query($sql);
			MSSQL::bind(':uid', $UserUID);

			if(MSSQL::$stmt->execute()){
				$return=array();
				$cnt=0;

				while($results=MSSQL::$stmt->fetch(\PDO::FETCH_OBJ)){
					foreach($results as $key=>$value){
						if($col){
							if($key==$col){
								$return=$results[$col];
								break;
							}
							else{
								$return = 'Datatype Invalid';
							}
						}
						else{
							$return[$key]=$value;
						}
					}
					$cnt++;
				}
			}

			return $return;
		}
		public static function _fetch_User() {
			return get_class_vars(get_called_class());
			
		}
		public static function checkUserFlags() {
			$sql=("
					SELECT TOP 1 * FROM ShaiyaCMS.dbo.FORUM_USER_PERMS WHERE [User] = :user
			");
			MSSQL::query($sql);
			MSSQL::bind(':user', $_SESSION['User']['UserID']);
			$res = MSSQL::single();
			self::$userFlags    =   $res->Perms;
			self::$userFlags    =   explode("~",$res->Perms);;
		}
		# MISC
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		public function _Mthds(){
			$class_methods	=	get_class_methods($this);
			echo '<div class="col-md-12">';
				echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
				echo '<pre>';
				foreach($class_methods as $method_name){
					echo $method_name.'<br>';
				}
				echo '</pre>';
			echo '</div>';
			exit();
		}

	}