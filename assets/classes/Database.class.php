<?php
	class Database{
		private $Type	=	"DEV";

		protected $dns;
		protected $dbname;
		protected $user;
		protected $pw;

		# Public Vars
		public $conn	=	NULL;

		function __construct(){
			$this->load_params();
			$this->db_open_conn();
		}
		function load_params(){
			require_once('Db_Info.class.php');
		}
		function db_open_conn(){
			try {
				$this->conn = new PDO('sqlsrv:Server='.$this->dns.';Database='.$this->dbname,$this->user,$this->pwd);
			} catch (PDOException $e) {
#				echo 'Connection failed: ' . $e->getMessage();
				throw new SystemException('Database is <b>unavailable</b> or <b>offline</b>!',0,0,__FILE__,__LINE__);
			}
		}
		function db_close_conn(){
			$this->conn = NULL;
		}
		function get_TABLE($table){
			switch($table){
				# LOGS
				case "LOG_ACCESS"					:	return "[ShaiyaCMS].[dbo].[LOG_ACCESS]";						break;
				case "LOG_BOSS_DEATH"				:	return "[ShaiyaCMS].[dbo].[LOG_BOSS_DEATH]";					break;
				case "LOG_DONATE"					:	return "[ShaiyaCMS].[dbo].[LOG_DONATE]";						break;
				case "LOG_GIFT"						:	return "[ShaiyaCMS].[dbo].[LOG_GIFT]";							break;
				case "LOG_GM_COMMANDS"				:	return "[ShaiyaCMS].[dbo].[LOG_GM_COMMANDS]";					break;
				case "LOG_PAYMENTS"					:	return "[ShaiyaCMS].[dbo].[LOG_PAYMENTS]";						break;
				case "LOG_SESSION"					:	return "[ShaiyaCMS].[dbo].[LOG_SESSION]";						break;
				# MAIN
				case "HOMEPAGE"						:	return "[ShaiyaCMS].[dbo].[HOMEPAGE]";							break;
				case "NEWS"							:	return "[ShaiyaCMS].[dbo].[NEWS]";								break;
				case "PATCHNOTES"					:	return "[ShaiyaCMS].[dbo].[PATCH_NOTES]";						break;
				case "DONATE"						:	return "[ShaiyaCMS].[dbo].[DONATE]";							break;
				case "DONATE_OPTIONS"				:	return "[ShaiyaCMS].[dbo].[DONATE_OPTIONS]";					break;
				case "WEB_PRESENCE"					:	return "[ShaiyaCMS].[dbo].[WEB_PRESENCE]";						break;
				# SETTINGS
				case "SETTINGS_COLORS"				:	return "[ShaiyaCMS].[dbo].[SETTINGS_COLORS]";					break;
				case "SETTINGS_MAIN"				:	return "[ShaiyaCMS].[dbo].[SETTINGS_MAIN]";						break;
				case "SETTINGS_PLUGINS"				:	return "[ShaiyaCMS].[dbo].[SETTINGS_PLUGINS]";					break;
				case "SETTINGS_SOCIAL"				:	return "[ShaiyaCMS].[dbo].[SETTINGS_SOCIAL]";					break;
				case "SETTINGS_STYLE"				:	return "[ShaiyaCMS].[dbo].[SETTINGS_STYLE]";					break;
				case "SETTINGS_THEME"				:	return "[ShaiyaCMS].[dbo].[SETTINGS_THEME]";					break;
				case "SETTINGS_PAGES"				:	return "[ShaiyaCMS].[dbo].[SETTINGS_PAGES]";					break;
				# SHAIYA
				case "SH_BANNED_PLAYERS"			:	return "[ShaiyaCMS].[dbo].[BANNED_PLAYERS]";					break;
				case "SH_BANNED"					:	return "[ShaiyaCMS].[dbo].[BANNED]";							break;
				case "SH_ACTIONLOG"					:	return "[PS_GameLog].[dbo].[Actionlog]";						break;
				case "SH_CHATLOG"					:	return "[PS_ChatLog].[dbo].[Chatlog]";							break;
				case "SH_CHARDATA"					:	return "[PS_GameData].[dbo].[Chars]"; 							break;
				case "SH_CHARSKILLS"				:	return "[PS_GameData].[dbo].[CharSkills]"; 						break;
				case "SH_CHARAPPSKILLS"				:	return "[PS_GameData].[dbo].[CharApplySkills]";			 		break;
				case "SH_CHARITEMS"					:	return "[PS_GameData].[dbo].[CharItems]"; 						break;
				case "SH_GUILDS"					:	return "[PS_GameData].[dbo].[Guilds]";							break;
				case "SH_GUILD_CHARS"				:	return "[PS_GameData].[dbo].[GuildChars]";						break;
				case "SH_GUILD_DETAILS"				:	return "[PS_GameData].[dbo].[GuildDetails]"; 					break;
				case "SH_USERBANK"					:	return "[PS_GameData].[dbo].[UserStoredPointItems]";			break;
				case "SH_USERWH"					:	return "[PS_GameData].[dbo].[UserStoredItems]";					break;
				case "SH_ITEMS"						:	return "[PS_GameDefs].[dbo].[Items]";							break;
				case "SH_MAPS"						:	return "[PS_GameDefs].[dbo].[MapNames]";						break;
				case "SH_MOBS"						:	return "[PS_GameDefs].[dbo].[Mobs]";							break;
				case "SH_MOBITEMS"					:	return "[PS_GameDefs].[dbo].[MobItems]";						break;
				case "SH_SKILLS"					:	return "[PS_GameDefs].[dbo].[Skills]"; 							break;
				case "SH_UMG"						:	return "[PS_GameData].[dbo].[UserMaxGrow]";						break;
				case "SH_USERDATA"					:	return "[PS_UserData].[dbo].[Users_Master]";					break;
				case "SH_USERLOGIN"					:	return "[PS_UserData].[dbo].[UserLoginStatus]";					break;
				case "SH_STATPADDERS"				:	return "[ShaiyaCMS].[dbo].[StatPadders]";						break;
				# Loot Box
				case "SH_LOOT_BOX"					:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_ITEMS]";					break;
				case "SH_LOOT_BOX_ITEMS_PENDING"	:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_ITEMS_PENDING]";			break;
				case "SH_LOOT_BOX_TIME"				:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_TIME]";						break;
				case "SH_LOOT_BOX_LOGS"				:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_LOGS]";						break;
				# Drop Finder
				case "SH_DROP_FINDER"				:	return "[ShaiyaCMS].[dbo].[DROP_FINDER]";						break;
			}
		}
		function do_QUERY($t1,$t2,$t3,$t4){
			$return = false;

			$sql = ("
						SELECT ".$t1."
						FROM ".$this->get_TABLE($t2)."
						WHERE ".$t3."=?
			");
			$stmt=$this->db->conn->prepare($sql);
			$args = array($t4);
			$stmt->execute($args);

			try{
				while($data=$stmt->fetch()){
					$return = $data[$t1];
				}
			}catch (PDOException $e) {

			}

			return $return;
		}
		# MISC
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>