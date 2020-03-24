<?php

   namespace Classes\Utils;

    use Classes\DB\MSSQL;
    use Illuminate\Database\Capsule\Manager as Eloquent;

    class User
    {
        // SQL
        private $sql;
        private $stmt;
        private $res;
        private $fet;
        // Account Info - Shared
        public $AdminLevel;
        public $Country;
        public $DisplayName;
        public $DOB;
        public $Email;
        public $JoinDate;
        public $LeaveDate;
        public $LoginStatus;
        public $Point;
        public $RegDate;
        public $Status;
        public $UseQueue;
        public $UserUID;
        public $UserID;
        public $UserIP;
        public $is_staff = [
            '16',
            '32',
            '48',
            '64',
            '80',
            '128'
        ];
        public $userFlags = [];
        public $flags = [
            'CREATE'
        ];

        // Status
        private $ADM;
        private $GM;
        private $GS;
        private $Member;

        // Socials
        public $Discord;
        public $Skype;
        public $Steam;

        // Privacy
        public $DisplayProfile;
        public $DisplaySocials;

        // Forum
        public $userTitle;

        // Session
        public $LoginGuest;

        // Other
        public $MapID;

        public function __construct(Session $session)
        {
            $this->session = $session;
            $this->run();
        }

        public function run()
        {
            //Session::flush();
            if (isset($_SESSION) && isset($_SESSION['User']['UserUID']) || isset($_COOKIE['stayLoggedIn'])) {
                $SessionCookieCheck = isset($_COOKIE['stayLoggedIn']) ? $_COOKIE['UserUID'] : $_SESSION['User']['UserUID'];
                if ($_SESSION['Settings']['SITE_TYPE'] == 'SH') {
                    $query = Eloquent::table(table('SH_USERDATA') . ' as [UM]')
                            ->select(['[UM].UserUID', '[UM].UserID', '[UM].Pw', '[UM].Point', '[UM].Status', '[UM].JoinDate', '[UM].LeaveDate', '[WP].DisplayName', '[WP].PIN', '[WP].Email', '[WP].ActivationKey', '[WP].UserIP', '[WP].LoginStatus', '[WP].UserTitle', '[US].Discord', '[US].Skype', '[US].Steam', '[UP].DisplayProfile', '[UP].DisplaySocials'])
                            ->join(table('WEB_PRESENCE') . ' as  [WP]', '[UM].UserID', '=', '[WP].UserID')
                            ->join(table('USER_SOCIALS') . ' as  [US]', '[UM].UserUID', '=', '[US].UserUID')
                            ->join(table('USER_PRIVACY') . ' as  [UP]', '[UM].UserUID', '=', '[UP].UserUID')
                            ->where('[UM].UserUID', $SessionCookieCheck)
                            ->limit(1)
                            ->get();

                    foreach ($query as $fet) {
                        // Shaiya Data
                        $this->JoinDate = $fet->JoinDate;
                        $this->LeaveDate = $fet->LeaveDate;
                        $this->Point = $fet->Point;
                        $this->LoginStatus = $fet->LoginStatus;

                        // Web Presence
                        $this->DisplayName = $fet->DisplayName;
                        $this->Email = $fet->Email;
                        $this->Status = $fet->Status;
                        $this->UserID = $fet->UserID;
                        $this->UserIP = $fet->UserIP;
                        $this->UserUID = $fet->UserUID;

                        $this->Discord = $fet->Discord;
                        $this->Skype = $fet->Skype;
                        $this->Steam = $fet->Steam;

                        $this->userTitle = $fet->UserTitle;

                        $this->DisplayProfile = $fet->DisplayProfile;
                        $this->DisplaySocials = $fet->DisplaySocials;
                    }

                    /* self::$sql = ('SELECT TOP 1
                                    [UM].[UserUID],[UM].[UserID],[UM].[Pw],[UM].[Point],[UM].[Status],[UM].[JoinDate],[UM].[LeaveDate],
                                    [WP].[DisplayName],[WP].[PIN],[WP].[Email],[WP].[ActivationKey],[WP].[UserIP],[WP].[LoginStatus], [WP].[UserTitle],
                                    [US].[Discord],[US].[Skype],[US].[Steam],[UP].[DisplayProfile],[UP].[DisplaySocials]
                                FROM ' . MSSQL::getTable('SH_USERDATA') . '			AS [UM]
                                INNER JOIN ' . MSSQL::getTable('WEB_PRESENCE') . '	AS [WP] ON [UM].[UserID]=[WP].[UserID]
                                INNER JOIN ' . MSSQL::getTable('USER_SOCIALS') . '	AS [US] ON [UM].[UserUID]=[US].[UserUID]
                                INNER JOIN ' . MSSQL::getTable('USER_PRIVACY') . '	AS [UP] ON [UM].[UserUID]=[UP].[UserUID]
                                WHERE [UM].[UserUID] = :uid
                    ');
                    MSSQL::query(self::$sql);
                    MSSQL::bind(':uid', $SessionCookieCheck);
                    self::$fet = MSSQL::single(1); */
                }

                // Shaiya Data
                /* self::$JoinDate = self::$fet['JoinDate'];
                self::$LeaveDate = self::$fet['LeaveDate'];
                self::$Point = self::$fet['Point'];
                self::$LoginStatus = self::$fet['LoginStatus'];

                // Web Presence
                //$this->Country		=	self::$fet["Country"];
                self::$DisplayName = self::$fet['DisplayName'];
                //$this->DOB			=	self::$fet["DateOfBirth"];
                self::$Email = self::$fet['Email'];
                self::$Status = self::$fet['Status'];
                //	self::$AdminLevel	=	self::$fet["AdminLevel"];
                self::$UserID = self::$fet['UserID'];
                self::$UserIP = self::$fet['UserIP'];
                self::$UserUID = self::$fet['UserUID'];

                self::$Discord = self::$fet['Discord'];
                self::$Skype = self::$fet['Skype'];
                self::$Steam = self::$fet['Steam'];

                self::$userTitle = self::$fet['UserTitle'];

                self::$DisplayProfile = self::$fet['DisplayProfile'];
                self::$DisplaySocials = self::$fet['DisplaySocials']; */

                //	self::_is_staff(self::$AdminLevel);

                // Cleanup
                $this->sql = null;
                $this->fet = null;
                $this->res = null;
            }

            $this->_is_Logged_In();
            //self::initPasswordHash();
        }

        public function _class_info($level = false)
        {
            switch ($level) {
                case 1:	return $this->_Props($level);	break;
                case 2:	return $this->_Mthds($level);	break;
            }
        }

        public function _get_data($data)
        {
            if ($this->$data) {
                return $this->$data;
            } else {
                die('<b>Class (' . get_class($this) . '):</b><br>The requested var, <b>' . $data . '</b>, couldn\'t be found.');
            }
        }

        public function _get_UserInfo($data)
        {
            switch ($data) {
                case 'JoinDate':
                    return date('m/d/Y', strtotime($this->$data));
                break;
                case 'LeaveDate':
                    return date('m/d/Y', strtotime($this->$data));
                break;
                case 'LoginDate':
                    return date('m/d/Y', strtotime($this->$data));
                break;
                case 'RegDate':
                    return date('m/d/Y', strtotime($this->$data));
                break;
                default: return $this->$data;
            }
        }

        public function _is_staff()
        {
            if (isset($_SESSION['User'])) {
                switch ($_SESSION['User']['Status']) {
                    case	'16':
                        $this->ADM = true;
                        return true;
                    break;
                    case	'32':
                        $this->GM = true;
                        return true;
                    break;
                    case	'48':
                        $this->GM = true;
                        return true;
                    break;
                    case	'64':
                        $this->GM = true;
                        return true;
                    break;
                    case	'80':
                        $this->GM = true;
                        return true;
                    break;
                    case	'128':
                        $this->GS = true;
                        return true;
                    break;
                }
            }

            return false;
        }

        public function _is_ADM()
        {
            if (isset($_SESSION)) {
                if ($_SESSION['User']['Status'] == 16) {
                    return true;
                }
            }

            return false;
        }

        public function _is_GM()
        {
            if ($this->Status == 32 || $this->Status == 48 || $this->Status == 64 || $this->Status == 80) {
                return true;
            }

            return false;
        }

        public function _is_GS()
        {
            if ($this->Status == 128) {
                return true;
            }
            return false;
        }

        public function _is_Logged_In()
        {
            if (!empty($this->UserUID) && !empty($this->UserID) && is_numeric($this->UserUID)) {
                $this->LoginStatus = true;
                return true;
            } else {
                $this->LoginStatus = false;
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

        public function get_isCharExist()
        {
            // Char Existence Check
            $sql = ('SELECT * FROM ' . Chars . ' WHERE UserUID=?');
            $stmt = odbc_prepare($cxn, $sql);
            $args = [$this->UserUID];
            if (!odbc_execute($stmt, $args)) {
                return false;
            } elseif ($row = odbc_fetch_array($stmt)) {
                return true;
            }
        }

        public function get_isLoggedInName()
        {
            // User Login Check
            $UserLoginStatus = false;
            if (isset($this->UserUID,$this->UserID)) {
                $UserLoginStatus = $this->UserID;
            } else {
                $UserLoginStatus = 'Guest';
            }
            return $UserLoginStatus;
        }

        public function Auth()
        {
            die('Fix me');
            if (!$this->_is_Logged_In()) {
                header('location: /ap');
                die();
            }
        }

        public function AuthADM()
        {
            die('Fix me');
            if (!$this->_is_ADM()) {
                header('location: /ap');
                die();
            }
        }

        public function AuthStaff()
        {
            die('Fix me');
            if (!$this->_is_staff()) {
                header('location: /ap');
                die();
            }
        }

        public function accessCheck()
        {
            if ($this->_is_Logged_In()) {
                if (!$this->_is_staff()) {
                    //Template::doACP_Head("","",false,"12","Access Denied!");
                    return '<span style="color:red">Sorry, you don\'t have permission to access this website!</span>';
                    //Template::doACP_Foot();
                }
            }
        }

        public function get_Status($Status)
        {
            switch ($Status) {
                case '0':	return 'Player'; break;
                case '10':	return 'Administrator'; break;
                case '16':	return 'Administrator'; break;
                case '32':	return 'GameMaster'; break;
                case '48':	return 'GameMaster'; break;
                case '64':	return 'GameMaster Assistant'; break;
                case '80':	return 'GameSage'; break;
            }
        }

        public function get_Faction($Faction)
        {
            switch ($Faction) {
                case '0':	return	'Alliance of Light';		break;
                case '1':	return	'Union of Fury';			break;
            }
        }

        public function get_Class($Faction, $Class)
        {
            if ($Faction == 0) {
                switch ($Class) {
                    case 0:	return 'Fighter'; 				break;
                    case 1:	return 'Defender'; 				break;
                    case 2:	return 'Archer'; 				break;
                    case 3:	return 'Ranger'; 				break;
                    case 4:	return 'Mage'; 					break;
                    case 5:	return 'Priest'; 				break;
                }
            } else {
                switch ($Class) {
                    case 0:	return 'Warrior'; 				break;
                    case 1:	return 'Guardian'; 				break;
                    case 2:	return 'Hunter'; 				break;
                    case 3:	return 'Assassin'; 				break;
                    case 4:	return 'Pagan'; 				break;
                    case 5:	return 'Oracle'; 				break;
                }
            }
        }

        public function get_Map($Map)
        {
            switch ($Map) {
                case 0:	return 'D-Water'; 						break;
                case 1:	return 'Erina'; 						break;
                case 2:	return 'Reikeuseu'; 					break;
                case 3:	return 'D1'; 							break;
                case 4:	return 'D1'; 							break;
                case 5:	return 'Cornwell\'s Ruin'; 				break;
                case 6:	return 'Cornwell\'s Ruin'; 				break;
                case 7:	return 'Argilla Ruin'; 					break;
                case 8:	return 'Argilla Ruin'; 					break;
                case 9:	return 'D2'; 							break;
                case 10:	return 'D2'; 							break;
                case 11:	return 'Kimu Room'; 					break;
                case 12:	return 'Cloron\'s Lair'; 				break;
                case 13:	return 'Cloron\'s Lair'; 				break;
                case 14:	return 'Cloron\'s Lair'; 				break;
                case 15:	return 'Fantasma\'s Lair'; 				break;
                case 16:	return 'Fantasma\'s Lair'; 				break;
                case 17:	return 'Fantasma\'s Lair'; 				break;
                case 18:	return 'Proelium'; 						break;
                case 19:	return 'Willieoseu'; 					break;
                case 20:	return 'Keuraijen'; 					break;
                case 21:	return 'Maitreyan FL2'; 				break;
                case 22:	return 'Maitreyan FL2'; 				break;
                case 23:	return 'Aidion Nekria FL2'; 			break;
                case 24:	return 'Aidion Nekria FL2'; 			break;
                case 25:	return 'Elemental Cave'; 				break;
                case 26:	return 'Ruber Chaos'; 					break;
                case 27:	return 'Ruber Chaos'; 					break;
                case 28:	return 'Adellia'; 						break;
                case 29:	return 'Adeurian'; 						break;
                case 30:	return 'Cantabilian'; 					break;
                case 31:	return 'Paros Temple'; 					break;
                case 32:	return 'Rapioru Maze'; 					break;
                case 33:	return 'Fedion Temple'; 				break;
                case 34:	return 'Khalamus House'; 				break;
                case 35:	return 'Apulune'; 						break;
                case 36:	return 'Iris'; 							break;
                case 37:	return 'Cave of Stigma'; 				break;
                case 38:	return 'Aurizen Ruin'; 					break;
                case 39:	return 'Secret Battle Arena'; 			break;
                case 40:	return 'Underground Stadium'; 			break;
                case 41:	return 'Prison'; 						break;
                case 42:	return 'Auction House'; 				break;
                case 43:	return 'Skulleron'; 					break;
                case 44:	return 'Astenes'; 						break;
                case 45:	return 'Deep Desert 1'; 				break;
                case 46:	return 'Deep Desert 2'; 				break;
                case 47:	return 'Stable Erde'; 					break;
                case 48:	return 'Cryptic Throne'; 				break;
                case 49:	return 'Cryptic Throne'; 				break;
                case 50:	return 'GRB'; 							break;
                case 51:	return 'Guild House'; 					break;
                case 52:	return 'Guild House'; 					break;
                case 53:	return 'Guild Management Office'; 		break;
                case 54:	return 'Guild Management Office'; 		break;
                case 55:	return 'Sky City'; 						break;
                case 56:	return 'Sky City'; 						break;
                case 57:	return 'Sky City'; 						break;
                case 58:	return 'Sky City'; 						break;
                case 59:	return 'Garden of Goddess'; 			break;
                case 60:	return 'World Cup'; 					break;
                case 61:	return 'Garden of Goddess'; 			break;
                case 62:	return 'Khalamus House'; 				break;
                case 63:	return 'Aurizen Ruin'; 					break;
                case 64:	return 'Oblivian Island'; 				break;
                case 65:	return 'Caelum Sacra'; 					break;
                case 66:	return 'Caelum Sacra'; 					break;
                case 67:	return 'Caelum Sacra Boss Room'; 		break;
                case 68:	return 'Valdemar Regnum'; 				break;
                case 69:	return 'Palaion Regnum'; 				break;
                case 70:	return 'Kanos Illium'; 					break;
                case 71:	return 'Queen Servus'; 					break;
                case 72:	return 'Queen Caput'; 					break;
                case 73:	return 'Zeharr\'s Mine'; 				break;
                case 74:	return 'Dimension\'s Crack'; 			break;
                case 75:	return 'Pantanssa'; 					break;
                case 76:	return 'Theodores'; 					break;
                case 77:	return 'Arcanus Ruins'; 				break;
                case 78:	return 'Arcanus Ruins FL2'; 			break;
                case 79:	return 'Hypnosis Ruins'; 				break;
                case 80:	return 'Wedding Map'; 					break;
                case 81:	return 'Canyon of Greed'; 				break;
                case 82:	return 'Unknown'; 						break;
                case 83:	return 'Unknown'; 						break;
                case 84:	return 'Unknown'; 						break;
                case 85:	return 'Unknown'; 						break;
                case 86:	return 'Unknown'; 						break;
            }
        }

        public function _fetch_UserGameInfo($UserUID, $col = false)
        {
            $return = false;

            $sql = ('SELECT * FROM ' . MSSQL::getTable('SH_USERDATA') . ' WHERE UserUID=:uid ');
            MSSQL::query($sql);
            MSSQL::bind(':uid', $UserUID);

            if (MSSQL::$stmt->execute()) {
                $return = [];
                $cnt = 0;

                while ($results = MSSQL::$stmt->fetch()) {
                    foreach ($results as $key => $value) {
                        if ($col) {
                            if ($key == $col) {
                                $return = $results[$col];
                                break;
                            } else {
                                $return = 'Datatype Invalid';
                            }
                        } else {
                            $return[$key] = $value;
                        }
                    }
                    $cnt++;
                }
            }

            return $return;
        }

        public function _fetch_UserWebInfo($UserUID, $col = false)
        {
            $return = false;

            $sql = ('SELECT * FROM ' . MSSQL::getTable('WEB_PRESENCE') . ' WHERE UserID=:uid ');
            MSSQL::query($sql);
            MSSQL::bind(':uid', $UserUID);

            if (MSSQL::$stmt->execute()) {
                $return = [];
                $cnt = 0;

                while ($results = MSSQL::$stmt->fetch(\PDO::FETCH_OBJ)) {
                    foreach ($results as $key => $value) {
                        if ($col) {
                            if ($key == $col) {
                                $return = $results[$col];
                                break;
                            } else {
                                $return = 'Datatype Invalid';
                            }
                        } else {
                            $return[$key] = $value;
                        }
                    }
                    $cnt++;
                }
            }

            return $return;
        }

        public function _fetch_User()
        {
            return get_class_vars(get_called_class());
        }

        public function checkUserFlags()
        {
            $sql = ('
					SELECT TOP 1 * FROM ShaiyaCMS.dbo.FORUM_USER_PERMS WHERE [User] = :user
			');
            MSSQL::query($sql);
            MSSQL::bind(':user', $_SESSION['User']['UserID']);
            $res = MSSQL::single();
            $this->userFlags = $res->Perms;
            $this->userFlags = explode('~', $res->Perms);
            ;
        }

        public function initPrivacy()
        {
            if (isset($_SESSION['User']['UserUID'])) {
                $privacy = Eloquent::table(table('USER_PRIVACY'))
                            ->select()
                            ->where('UserUID', $this->session->get('User', 'UserUID'))
                            ->first();
                if (!is_null($privacy)) {
                    try {
                        $privacyIns = Eloquent::table(table('USER_PRIVACY'))
                            ->insert([
                                'UserUID' => $this->session->get('User', 'UserUID'),
                                'DisplayProfile' => 'Public',
                                'DisplaySocials' => 'Public'
                            ]);
                    } catch (\Exception $e) {
                        echo 'problem inserting.';
                    }
                }
                //var_dump($privacy);

                /* $sql = ('
                        SELECT * FROM ShaiyaCMS.dbo.USER_PRIVACY
                        WHERE UserUID = :user
                ');
                MSSQL::query($sql);
                MSSQL::bind(':user', $_SESSION['User']['UserUID']);
                $res = MSSQL::resultSet();
                $rowCount = count($res);
                if (!$rowCount > 0) {
                    $sql = ('
                            INSERT INTO ShaiyaCMS.dbo.USER_PRIVACY
                            (UserUID,DisplayProfile, DisplaySocials)
                            VALUES(:user,:dprofile,:dsocials)
                    ');
                    MSSQL::query($sql);
                    MSSQL::bind(':user', $_SESSION['User']['UserUID']);
                    MSSQL::bind(':dprofile', 'Public');
                    MSSQL::bind(':dsocials', 'Public');
                    MSSQL::execute();
                } */
            }
        }

        public function initSocials()
        {
            if (isset($_SESSION['User']['UserUID'])) {
                $socials = Eloquent::table(table('USER_SOCIALS'))
                            ->select()
                            ->where('UserUID', $this->session->get('User', 'UserUID'))
                            ->first();
                if (!is_null($socials)) {
                    try {
                        $socialsIns = Eloquent::table(table('USER_SOCIALS'))
                            ->insert([
                                'UserUID' => $this->session->get('User', 'UserUID')
                            ]);
                    } catch (\Exception $e) {
                        echo 'problem inserting.';
                    }
                }

                /* $sql = ('
                        SELECT * FROM ShaiyaCMS.dbo.USER_SOCIALS
                        WHERE UserUID = :user
                ');
                MSSQL::query($sql);
                MSSQL::bind(':user', $_SESSION['User']['UserUID']);
                $res = MSSQL::resultSet();
                $rowCount = count($res);
                if (!$rowCount > 0) {
                    $sql = ('
                            INSERT INTO ShaiyaCMS.dbo.USER_SOCIALS
                            (UserUID)
                            VALUES(:user)
                    ');
                    MSSQL::query($sql);
                    MSSQL::bind(':user', $_SESSION['User']['UserUID']);
                    MSSQL::execute();
                } */
            }
        }

        public function initPasswordHash()
        {
            $sql = ('
					SELECT [WP].[UserUID],[WP].[UserID],[U].[PwPlain],[WP].[Pw] FROM ShaiyaCMS.dbo.WEB_PRESENCE AS [WP]
					INNER JOIN PS_UserData.dbo.Users_Master AS [U] ON [WP].[UserID] = [U].[UserID]
			');
            foreach (MSSQL::connect()->query($sql) as $user) {
                $default_hash = password_hash($user['PwPlain'], PASSWORD_DEFAULT);
                MSSQL::connect()->exec("UPDATE ShaiyaCMS.dbo.WEB_PRESENCE SET Pw='{$default_hash}' WHERE UserUID='{$user['UserUID']}';");
            }
        }

        public function updateLoginStatus($status)
        {
            $data = [
                'LoginStatus' => $status
            ];
            try {
                $loginStatus = Eloquent::table(table('WEB_PRESENCE'))
                    ->where('UserID', $this->session->get('User', 'UserID'))
                    ->update($data);
            } catch (\Exception $e) {
                echo 'problem inserting.';
            }
        }

        // MISC
        public function _Props()
        {
            echo '<div class="col-md-12">';
            echo '<b>Properties for class (' . get_class($this) . '):</b><br>';
            echo '<pre>';
            echo print_r(get_object_vars($this));
            echo '</pre>';
            echo '</div>';
            exit();
        }

        public function _Mthds()
        {
            $class_methods = get_class_methods($this);
            echo '<div class="col-md-12">';
            echo '<b>Class (' . get_class($this) . ') Methods:</b> <br>';
            echo '<pre>';
            foreach ($class_methods as $method_name) {
                echo $method_name . '<br>';
            }
            echo '</pre>';
            echo '</div>';
            exit();
        }
    }
