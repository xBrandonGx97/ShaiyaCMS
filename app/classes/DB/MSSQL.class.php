<?php
    namespace Classes\DB;
    use \PDO;
    if(!defined('IN_CMS')){die('<b>'.__NAMESPACE__.'\MSSQL</b>: unauthorized access detected, exiting...');}
    
    class MSSQL {
        protected static $host   =   DB_HOST;
        protected static $user   =   DB_USER;
        protected static $pwd   =   DB_PASS;
        protected static $dbname =   DB_NAME;

        private static $dbh;
        public static $stmt;
        private static $error;

        public static function connect(){
            // Set DSN
            $dsn    =   'sqlsrv:Server=' .self::$host. ';Database='.self::$dbname;
            $options    =   array(
              PDO::ATTR_ERRMODE =>  PDO::ERRMODE_EXCEPTION
            );

            // Create PDO instance
            try{
                self::$dbh  =   new PDO($dsn, self::$user, self::$pwd, $options);
            } catch(\PDOException $e){
                self::$error    =   $e->getMessage();
                throw new \Classes\Exception\SystemException($e->getMessage(),0,0,__FILE__,__LINE__);
            }
            return self::$dbh;
        }
        public static function getTable($table){
			switch($table){
				# Main
                # CMS
                case "CMS_PAGES"				    :	return "[ShaiyaCMS].[dbo].[CMS_PAGES]";					    break;
                case "CMS_LANGS"				    :	return "[ShaiyaCMS].[dbo].[CMS_LANGS]";					    break;
				# Logs
				case "DONATE_OPTIONS"			    :	return "[ShaiyaCMS].[dbo].[DONATE_OPTIONS]";				break;
				case "LOG_ACCESS"				    :	return "[ShaiyaCMS].[dbo].[LOG_ACCESS]";					break;
				case "LOG_BOSS_DEATH"			    :	return "[ShaiyaCMS].[dbo].[LOG_BOSS_DEATH]";				break;
				case "LOG_GM_COMMANDS"			    :	return "[ShaiyaCMS].[dbo].[LOG_GM_COMMANDS]";				break;
				case "LOG_PAYMENTS"			        :	return "[ShaiyaCMS].[dbo].[LOG_PAYMENTS]";					break;
				case "LOG_SESSION"				    :	return "[ShaiyaCMS].[dbo].[LOG_SESSION]";					break;
				# Settings
                case "CMS_MAIN"				        :	return "[ShaiyaCMS].[dbo].[CMS_MAIN]";					    break;
                case "CMS_STYLE"				    :	return "[ShaiyaCMS].[dbo].[CMS_STYLE]";					    break;
                case "CMS_THEME"				    :	return "[ShaiyaCMS].[dbo].[CMS_THEME]";					    break;
				# Users
				case "WEB_PRESENCE"				    :	return "[ShaiyaCMS].[dbo].[WEB_PRESENCE]";					break;
				case "SH_USERDATA"				    :	return "[PS_UserData].[dbo].[Users_Master]";				break;
				case "SH_USERLOGIN"				    :	return "[PS_UserData].[dbo].[UserLoginStatus]";				break;
				case "PROFILE"					    :	return "[ShaiyaCMS].[dbo].[Profile]";					    break;
				# ACP
				# Main
				case "HOMEPAGE"					    :	return "[ShaiyaCMS].[dbo].[HOMEPAGE]";						break;
				case "NEWS"						    :	return "[ShaiyaCMS].[dbo].[NEWS]";							break;
				case "PATCHNOTES"				    :	return "[ShaiyaCMS].[dbo].[PATCH_NOTES]";					break;
				case "FORUM"				    	:	return "[ShaiyaCMS].[dbo].[FORUMS]";						break;
				case "TOPICS"				    	:	return "[ShaiyaCMS].[dbo].[FORUM_TOPICS]";					break;
				case "POSTS"				    	:	return "[ShaiyaCMS].[dbo].[FORUM_POSTS]";					break;
				# Account Tools
				case "SH_BANNED"				    :	return "[ShaiyaCMS].[dbo].[BANNED]";						break;
				case "SH_BANNED_PLAYERS"		    :	return "[ShaiyaCMS].[dbo].[BANNED_PLAYERS]";			    break;
				# Player Tools
				case "SH_ITEMS"					    :	return "[PS_GameDefs].[dbo].[Items]";						break;
				case "SH_UMG"					    :	return "[PS_GameData].[dbo].[UserMaxGrow]";					break;
				case "SH_USERBANK"				    :	return "[PS_GameData].[dbo].[UserStoredPointItems]";		break;
				case "SH_USERWH"				    :	return "[PS_GameData].[dbo].[UserStoredItems]";				break;
				# Misc Tools
				case "SH_ACTIONLOG"				    :	return "[PS_GameLog].[dbo].[Actionlog]";				    break;
				case "SH_CHATLOG"				    :	return "[PS_ChatLog].[dbo].[Chatlog]";						break;
				case "SH_CHARDATA"				    :	return "[PS_GameData].[dbo].[Chars]"; 						break;
				case "SH_CHARSKILLS"			    :	return "[PS_GameData].[dbo].[CharSkills]"; 				    break;
				case "SH_CHARAPPSKILLS"			    :	return "[PS_GameData].[dbo].[CharApplySkills]";			    break;
				case "SH_CHARITEMS"				    :	return "[PS_GameData].[dbo].[CharItems]"; 					break;
				case "SH_GUILDS"				    :	return "[PS_GameData].[dbo].[Guilds]";						break;
				case "SH_GUILD_CHARS"			    :	return "[PS_GameData].[dbo].[GuildChars]";					break;
				case "SH_GUILD_DETAILS"			    :	return "[PS_GameData].[dbo].[GuildDetails]"; 				break;
				case "SH_USERPRODUCT"			    :	return "[PS_Billing].[dbo].[Users_Product]";			    break;
				case "SH_MAPS"					    :	return "[PS_GameDefs].[dbo].[MapNames]";				    break;
				case "SH_MOBS"					    :	return "[PS_GameDefs].[dbo].[Mobs]";						break;
				case "SH_MOBITEMS"				    :	return "[PS_GameDefs].[dbo].[MobItems]";					break;
				case "SH_SKILLS"				    :	return "[PS_GameDefs].[dbo].[Skills]"; 					    break;
				case "SH_STATPADDERS"			    :	return "[ShaiyaCMS].[dbo].[StatPadders]";					break;
				case "SH_TICKETS"			        :	return "[ShaiyaCMS].[dbo].[TICKETS]";						break;
				case "SH_MESSAGES"			        :	return "[ShaiyaCMS].[dbo].[MESSAGES]";					    break;
				case "SH_PROMOS"			        :	return "[ShaiyaCMS].[dbo].[PROMOTION_CODES]";				break;
				case "SH_PROMOS_LOGS"			    :	return "[ShaiyaCMS].[dbo].[PROMOTION_CODES_LOGS]";			break;
				case "SH_PVPRWRDS"			        :	return "[ShaiyaCMS].[dbo].[PVP_RWRDS]";					    break;
				# Loot Box
				case "SH_LOOT_BOX"					:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_ITEMS]";			break;
				case "SH_LOOT_BOX_ITEMS_PENDING"	:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_ITEMS_PENDING]";	break;
				case "SH_LOOT_BOX_TIME"				:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_TIME]";				break;
				case "SH_LOOT_BOX_LOGS"				:	return "[ShaiyaCMS].[dbo].[LOOT_BOX_LOGS]";				break;
				# Drop Finder
				case "SH_DROP_FINDER"				:	return "[ShaiyaCMS].[dbo].[DROP_FINDER]";				break;
				# Webmall
                case "PRODUCTS"				        :	return "[ShaiyaCMS].[dbo].[PRODUCTS]";				    break;
			}
		}
        // Prepare statement with query
        public static function query($sql){
            self::$stmt =   self::connect()->prepare($sql);
        }
        // Bind values
        public static function bind($param, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type   =   PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type   =   PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type   =   PDO::PARAM_NULL;
                        break;
                    default:
                        $type   =   PDO::PARAM_STR;
                }
            }

            self::$stmt->bindValue($param, $value, $type);
        }
        // Execute the prepared statement
        public static function execute(){
            return self::$stmt->execute();
        }
        // Get result set as array of objects
        public static function resultSet($type=false){
            self::execute();
            if($type){
                return self::$stmt->fetchAll();
            }else{
                return self::$stmt->fetchAll(PDO::FETCH_OBJ);
            }

        }
        // Get single re cord as object
        public static function single($type=false){
            self::execute();
            if($type){
                return self::$stmt->fetch();
            }else{
                return self::$stmt->fetch(PDO::FETCH_OBJ);
            }
        }
        // Get row count
        public static function rowCount(){
            return self::$stmt->rowCount();
        }
    }
?>