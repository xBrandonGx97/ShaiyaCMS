<?php
	class Database{
		public static $host = '127.0.0.1';
		public static $dbName = 'PS_UserData';
		public static $User = 'UserID';
		public static $Pwd = 'Pwd';

		public static function connect(){
			 try{
				$conn = new PDO('sqlsrv:Server='.self::$host.';Database='.self::$dbName,self::$User,self::$Pwd);
			}catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
			return $conn;
		}
		public static function query($query){
			$sql = ('
						'.$query.'
			');
			$stmt = self::connect()->prepare($sql);
			$stmt ->execute();
		}
		public static function select($query){
			$sql = ('
						'.$query.'
			');
			$stmt = self::connect()->prepare($sql);
			$stmt ->execute();
			$data	=	$stmt->fetchAll();
			if($data){
				return $data;
			}
		}
		public static function update($DatabaseName,$SetColumn,$SetValue,$WhereColumn,$WhereValue,$IfExecute){
			$sql = ('
						UPDATE '.self::getTable($DatabaseName).'
						SET '.$SetColumn.'	=	?
						WHERE '.$WhereColumn.'	=	?
			');
			$stmt = self::connect()->prepare($sql);
			$args	=	array($SetValue,$WhereValue);
			if($IfExecute){
				if($stmt->execute($args)){
					echo 'Success';
				}else{
					echo 'Failure';
				}
			}else{
				$stmt->execute($args);
			}
		}
		public static function insert($DatabaseName,$SetColumn,$SetValue,$WhereColumn,$WhereValue,$IfExecute){

		}
		public static function getTable($table){
			switch($table){
				# Main

				# Logs
				case "LOG_ACCESS"				:	return "[ShaiyaCMS].[dbo].[LOG_ACCESS]";					break;
				case "LOG_BOSS_DEATH"			:	return "[ShaiyaCMS].[dbo].[LOG_BOSS_DEATH]";				break;
				case "LOG_GM_COMMANDS"			:	return "[ShaiyaCMS].[dbo].[LOG_GM_COMMANDS]";				break;
				case "LOG_SESSION"				:	return "[ShaiyaCMS].[dbo].[LOG_SESSION]";					break;
				# Users
				case "WEB_PRESENCE"				:	return "[ShaiyaCMS].[dbo].[WEB_PRESENCE]";					break;
				case "SH_USERDATA"				:	return "[PS_UserData].[dbo].[Users_Master]";				break;
				case "SH_USERLOGIN"				:	return "[PS_UserData].[dbo].[UserLoginStatus]";				break;
				case "PROFILE"						:	return "[ShaiyaCMS].[dbo].[Profile]";					break;
				# ACP
				# Main
				case "HOMEPAGE"					:	return "[ShaiyaCMS].[dbo].[HOMEPAGE]";						break;
				case "NEWS"						:	return "[ShaiyaCMS].[dbo].[NEWS]";							break;
				case "PATCHNOTES"				:	return "[ShaiyaCMS].[dbo].[PATCH_NOTES]";					break;
				# Account Tools
				case "SH_BANNED"				:	return "[ShaiyaCMS].[dbo].[BANNED]";						break;
				case "SH_BANNED_PLAYERS"			:	return "[ShaiyaCMS].[dbo].[BANNED_PLAYERS]";			break;
				# Player Tools
				case "SH_ITEMS"					:	return "[PS_GameDefs].[dbo].[Items]";						break;
				case "SH_UMG"					:	return "[PS_GameData].[dbo].[UserMaxGrow]";					break;
				case "SH_USERBANK"				:	return "[PS_GameData].[dbo].[UserStoredPointItems]";		break;
				case "SH_USERWH"				:	return "[PS_GameData].[dbo].[UserStoredItems]";				break;
				# Misc Tools
				case "SH_ACTIONLOG"					:	return "[PS_GameLog].[dbo].[Actionlog]";				break;
				case "SH_CHATLOG"				:	return "[PS_ChatLog].[dbo].[Chatlog]";						break;
				case "SH_CHARDATA"				:	return "[PS_GameData].[dbo].[Chars]"; 						break;
				case "SH_CHARSKILLS"				:	return "[PS_GameData].[dbo].[CharSkills]"; 				break;
				case "SH_CHARAPPSKILLS"				:	return "[PS_GameData].[dbo].[CharApplySkills]";			break;
				case "SH_CHARITEMS"				:	return "[PS_GameData].[dbo].[CharItems]"; 					break;
				case "SH_GUILDS"				:	return "[PS_GameData].[dbo].[Guilds]";						break;
				case "SH_GUILD_CHARS"			:	return "[PS_GameData].[dbo].[GuildChars]";					break;
				case "SH_GUILD_DETAILS"			:	return "[PS_GameData].[dbo].[GuildDetails]"; 				break;
				case "SH_USERPRODUCT"				:	return "[PS_Billing].[dbo].[Users_Product]";			break;
				case "SH_MAPS"						:	return "[PS_GameDefs].[dbo].[MapNames]";				break;
				case "SH_MOBS"					:	return "[PS_GameDefs].[dbo].[Mobs]";						break;
				case "SH_MOBITEMS"				:	return "[PS_GameDefs].[dbo].[MobItems]";					break;
				case "SH_SKILLS"					:	return "[PS_GameDefs].[dbo].[Skills]"; 					break;
				case "SH_STATPADDERS"			:	return "[ShaiyaCMS].[dbo].[StatPadders]";					break;
				# Loot Box
				case "SH_LOOT_BOX"					:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_ITEMS]";					break;
				case "SH_LOOT_BOX_ITEMS_PENDING"	:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_ITEMS_PENDING]";			break;
				case "SH_LOOT_BOX_TIME"				:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_TIME]";						break;
				case "SH_LOOT_BOX_LOGS"				:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_LOGS]";						break;
				# Drop Finder
				case "SH_DROP_FINDER"				:	return "[ShaiyaCMS].[dbo].[DROP_FINDER]";				break;
			}
		}
	}