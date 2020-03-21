<?php

   namespace Classes\DB;

    use \PDO;
    use Illuminate\Database\Capsule\Manager as Capsule;

    if (!defined('IN_CMS')) {
        die('<b>' . __NAMESPACE__ . '\MSSQL</b>: unauthorized access detected, exiting...');
    }

    class MSSQL
    {
        private static $dbh;
        public static $stmt;
        private static $error;

        private static $connection = [];

        public static function connect()
        {
            $config = $GLOBALS['config']['database'];
            // Set DSN
            $dsn = 'sqlsrv:Server=' . $config['host'] . ';Database=' . $config['name'];

            // Create PDO instance
            try {
                self::$dbh = new PDO($dsn, $config['user'], $config['pass'], $config['options']);
            } catch (\PDOException $e) {
                self::$error = $e->getMessage();
                throw new \Classes\Exception\SystemException($e->getMessage(), 0, 0, __FILE__, __LINE__);
            }
            // Update array
            self::addConnection('conn', self::$dbh);
            self::addConnection('conn2', self::$dbh);

            return self::$dbh;
        }

        public static function addConnection($name, $connection)
        {
            self::$connection[$name] = $connection;
        }

        public static function getTable($table)
        {
            switch ($table) {
                // Main
                // CMS
                case 'CMS_PAGES':	return '[ShaiyaCMS].[dbo].[CMS_PAGES]';					    break;
                case 'CMS_LANGS':	return '[ShaiyaCMS].[dbo].[CMS_LANGS]';					    break;
                // Logs
                case 'DONATE_OPTIONS':	return '[ShaiyaCMS].[dbo].[DONATE_OPTIONS]';				break;
                case 'LOG_ACCESS':	return '[ShaiyaCMS].[dbo].[LOG_ACCESS]';					break;
                case 'LOG_BOSS_DEATH':	return '[ShaiyaCMS].[dbo].[LOG_BOSS_DEATH]';				break;
                case 'LOG_GM_COMMANDS':	return '[ShaiyaCMS].[dbo].[LOG_GM_COMMANDS]';				break;
                case 'LOG_PAYMENTS':	return '[ShaiyaCMS].[dbo].[LOG_PAYMENTS]';					break;
                case 'LOG_SESSION':	return '[ShaiyaCMS].[dbo].[LOG_SESSION]';					break;
                // Settings
                case 'CMS_MAIN':	return 'ShaiyaCMS.dbo.CMS_MAIN';					    break;
                case 'CMS_STYLE':	return '[ShaiyaCMS].[dbo].[CMS_STYLE]';					    break;
                case 'CMS_THEME':	return '[ShaiyaCMS].[dbo].[CMS_THEME]';					    break;
                // Users
                case 'WEB_PRESENCE':	return 'ShaiyaCMS.dbo.WEB_PRESENCE';					break;
                case 'SH_USERDATA':	return 'PS_UserData.dbo.Users_Master';				break;
                case 'SH_USERLOGIN':	return '[PS_UserData].[dbo].[UserLoginStatus]';				break;
                case 'PROFILE':	return '[ShaiyaCMS].[dbo].[Profile]';					    break;
                case 'USER_SOCIALS':	return '[ShaiyaCMS].[dbo].[USER_SOCIALS]';			break;
                case 'USER_PRIVACY':	return '[ShaiyaCMS].[dbo].[USER_PRIVACY]';			break;
                // ACP
                // Main
                case 'HOMEPAGE':	return '[ShaiyaCMS].[dbo].[HOMEPAGE]';						break;
                case 'NEWS':	return 'ShaiyaCMS.dbo.NEWS';							break;
                case 'PATCHNOTES':	return '[ShaiyaCMS].[dbo].[PATCH_NOTES]';					break;
                // Forum
                case 'FORUMS':	return '[ShaiyaCMS].[dbo].[FORUMS]';						break;
                case 'TOPICS':	return '[ShaiyaCMS].[dbo].[FORUM_TOPICS]';					break;
                case 'POSTS':	return '[ShaiyaCMS].[dbo].[FORUM_POSTS]';					break;
                case 'FORUM_LIKES':	return '[ShaiyaCMS].[dbo].[FORUM_POST_LIKES]';				break;
                case 'FORUM_PERMS':	return '[ShaiyaCMS].[dbo].[FORUM_PERMS]';					break;
                case 'FORUM_PERMS':	return '[ShaiyaCMS].[dbo].[FORUM_PERMS]';					break;
                case 'FORUM_ROLES':	return '[ShaiyaCMS].[dbo].[FORUM_ROLES]';					break;
                case 'FORUM_ROLE_FLAGS':	return '[ShaiyaCMS].[dbo].[FORUM_ROLE_FLAGS]';				break;
                case 'FORUM_USER_NAMES':	return '[ShaiyaCMS].[dbo].[FORUM_USER_NAMES]';				break;
                case 'FORUM_USER_ROLES':	return '[ShaiyaCMS].[dbo].[FORUM_USER_ROLES]';				break;
                case 'FORUM_USER_SIGNATURES':	return '[ShaiyaCMS].[dbo].[FORUM_USER_SIGNATURES]';			break;
                case 'FORUM_USER_SOCIALS':	return '[ShaiyaCMS].[dbo].[FORUM_USER_SOCIALS]';			break;
                // Account Tools
                case 'SH_BANNED':	return '[ShaiyaCMS].[dbo].[BANNED]';						break;
                case 'SH_BANNED_PLAYERS':	return '[ShaiyaCMS].[dbo].[BANNED_PLAYERS]';			    break;
                // Player Tools
                case 'SH_ITEMS':	return '[PS_GameDefs].[dbo].[Items]';						break;
                case 'SH_UMG':	return '[PS_GameData].[dbo].[UserMaxGrow]';					break;
                case 'SH_USERBANK':	return '[PS_GameData].[dbo].[UserStoredPointItems]';		break;
                case 'SH_USERWH':	return '[PS_GameData].[dbo].[UserStoredItems]';				break;
                // Misc Tools
                case 'SH_ACTIONLOG':	return '[PS_GameLog].[dbo].[Actionlog]';				    break;
                case 'SH_CHATLOG':	return '[PS_ChatLog].[dbo].[Chatlog]';						break;
                case 'SH_CHARDATA':	return 'PS_GameData.dbo.Chars'; 						break;
                case 'SH_CHARSKILLS':	return '[PS_GameData].[dbo].[CharSkills]'; 				    break;
                case 'SH_CHARAPPSKILLS':	return '[PS_GameData].[dbo].[CharApplySkills]';			    break;
                case 'SH_CHARITEMS':	return '[PS_GameData].[dbo].[CharItems]'; 					break;
                case 'SH_GUILDS':	return '[PS_GameData].[dbo].[Guilds]';						break;
                case 'SH_GUILD_CHARS':	return '[PS_GameData].[dbo].[GuildChars]';					break;
                case 'SH_GUILD_DETAILS':	return '[PS_GameData].[dbo].[GuildDetails]'; 				break;
                case 'SH_USERPRODUCT':	return '[PS_Billing].[dbo].[Users_Product]';			    break;
                case 'SH_MAPS':	return '[PS_GameDefs].[dbo].[MapNames]';				    break;
                case 'SH_MOBS':	return '[PS_GameDefs].[dbo].[Mobs]';						break;
                case 'SH_MOBITEMS':	return '[PS_GameDefs].[dbo].[MobItems]';					break;
                case 'SH_SKILLS':	return '[PS_GameDefs].[dbo].[Skills]'; 					    break;
                case 'SH_STATPADDERS':	return '[ShaiyaCMS].[dbo].[StatPadders]';					break;
                case 'SH_TICKETS':	return '[ShaiyaCMS].[dbo].[TICKETS]';						break;
                case 'SH_MESSAGES':	return '[ShaiyaCMS].[dbo].[MESSAGES]';					    break;
                case 'SH_PROMOS':	return '[ShaiyaCMS].[dbo].[PROMOTION_CODES]';				break;
                case 'SH_PROMOS_LOGS':	return '[ShaiyaCMS].[dbo].[PROMOTION_CODES_LOGS]';			break;
                case 'SH_PVPRWRDS':	return '[ShaiyaCMS].[dbo].[PVP_RWRDS]';					    break;
                // Loot Box
                case 'SH_LOOT_BOX':	return '[ShaiyaCMS].[dbo].[LOOT_BOX_ITEMS]';			break;
                case 'SH_LOOT_BOX_ITEMS_PENDING':	return '[ShaiyaCMS].[dbo].[LOOT_BOX_ITEMS_PENDING]';	break;
                case 'SH_LOOT_BOX_TIME':	return '[ShaiyaCMS].[dbo].[LOOT_BOX_TIME]';				break;
                case 'SH_LOOT_BOX_LOGS':	return '[ShaiyaCMS].[dbo].[LOOT_BOX_LOGS]';				break;
                // Drop Finder
                case 'SH_DROP_FINDER':	return '[ShaiyaCMS].[dbo].[DROP_FINDER]';				break;
                // Webmall
                case 'PRODUCTS':	return '[ShaiyaCMS].[dbo].[PRODUCTS]';				    break;
            }
        }

        // Prepare statement with query
        public static function query1($sql)
        {
            self::$stmt = self::connect()->prepare($sql);
        }

        // Bind values
        public static function bind($param, $value, $type = null)
        {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            self::$stmt->bindValue($param, $value, $type);
        }

        // Execute the prepared statement
        public static function execute()
        {
            return self::$stmt->execute();
        }

        // Get result set as array of objects
        public static function resultSet($type = false)
        {
            self::execute();
            if ($type == 1) {
                return self::$stmt->fetchAll();
            } elseif ($type == 2) {
                return self::$stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return self::$stmt->fetchAll(PDO::FETCH_OBJ);
            }
        }

        // Get single re cord as object
        public static function single($type = false)
        {
            self::execute();
            if ($type) {
                return self::$stmt->fetch();
            } else {
                return self::$stmt->fetch(PDO::FETCH_OBJ);
            }
        }

        // Get row count
        public static function rowCount()
        {
            return self::$stmt->rowCount();
        }

        public static function count($stmt)
        {
            //return count($stmt);
            return count(self::$stmt);
        }

        public static function query($name = 'conn')
        {
            if (self::$dbh || self::$dbh == null) {
                self::connect();
            }
            return new queryBuilder(self::$connection[$name]);
        }

        public static function initCapsule()
        {
            $config = $GLOBALS['config']['database'];

            $capsule = new Capsule;

            $capsule->addConnection([
                'driver' => $config['driver'],
                'host' => $config['host'],
                'database' => $config['name'],
                'username' => $config['user'],
                'password' => $config['pass']
            ]);

            // Make this Capsule instance available globally via static methods
            $capsule->setAsGlobal();

            // Setup the Eloquent ORM
            $capsule->bootEloquent();
        }
    }
