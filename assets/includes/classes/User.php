<?php
    Class User{
		public static $UserUID			=	NULL;
        public static $DisplayName		=	NULL;
        public static $UserID			=	NULL;
        public static $Pw				=	NULL;
        public static $Email			=	NULL;
        public static $ActivationKey	=	NULL;
        public static $Status		=	NULL;
        public static $LoginStatus		=	NULL;
		public static $UserIP			=	NULL;
		public static $UserLoginStatus	=	NULL;
		public static function initUser(){
			if(isset($_SESSION) && isset($_SESSION["UserUID"])){
                $sql    =   ('
                                SELECT * FROM '.Database::getTable('WEB_PRESENCE').' WHERE UserUID=?
                ');
                $stmt   =   Database::connect()->prepare($sql);
                $args   =   array($_SESSION['UserUID']);
                $stmt->execute($args);
				$fet    =   $stmt->fetch();
				self::$UserUID			=	$fet['UserUID'];
                self::$DisplayName 		=   $fet['DisplayName'];
                self::$UserID 			=   $fet['UserID'];
                self::$Pw 				=   $fet['Pw'];
                self::$Email 			=   $fet['Email'];
                self::$ActivationKey 	=   $fet['ActivationKey'];
                self::$Status 			=   $fet['Status'];
                self::$LoginStatus 		=   $fet['LoginStatus'];
                self::$UserIP 			=   $fet['UserIP'];
			}
			if(!isset($_SESSION["UserID"])){
				self::$DisplayName 		=   'Guest';
			}
			self::get_isLoggedInName();
		}
		# Access Checks
        public static function LoggedIn(){
            if(isset(self::$UserID) && !empty(self::$UserID)){
                self::$LoginStatus=true;
                return true;
            }else{
                self::$LoginStatus=false;
                return false;
            }
		}
		public static function get_isLoggedInName(){
			# User Login Check
			if(isset(self::$UserUID,self::$UserID)){
				self::$UserLoginStatus = self::$UserID;
			}else{
				self::$UserLoginStatus = "Guest";
			}
		}
		public static function AccessCheck(){
			if (self::LoggedIn()){
				if(!self::isStaff()){
					Template::doACP_Head("","",false,"12","Access Denied!");
						echo '<span style="color:red">Sorry, you don\'t have permission to access this website!</span>';
					Template::doACP_Foot();
				}
			}
		}
		public static function AccessCheckByUser(){
			if (self::LoggedIn()){
				if(!self::isAccessUser()){
					Template::doACP_Head("","",false,"12","Access Denied!");
						echo '<span style="color:red">Sorry, you don\'t have permission to access this website!</span>';
					Template::doACP_Foot();
				}
			}
		}
		public static function Auth(){
			if(!self::LoggedIn()){
				header('location: ./');
				die();
			}
		}
		public static function AuthStaff(){
			if(!self::isStaff()){
				header("Location: ./dashboard");
				die();
			}
		}
		public static function AuthGM(){
			if(!self::AllGM()){
				header("Location: ./dashboard");
				die();
			}
		}
		public static function AuthADM(){
			if(!self::isAdmin()){
				header("Location: ./dashboard");
				die();
			}
		}
		public static function isAdmin(){
			if(self::$Status == 16 || self::$Status == 17){
				return true;
			}
			return false;
		}
		public static function AllGM(){
			if(self::$Status == 17 || self::$Status == 16 || self::$Status == 32 || self::$Status == 48 || self::$Status == 64 || self::$Status == 80){
				return true;
			}
			else{
				return false;
			}
		}
		public static function isGameMaster(){
			if(self::$Status == 32 || self::$Status == 64 || self::$Status == 80){
				return true;
			}
			return false;
		}
		public static function isGameSage(){
			if(self::$Status == 128){
				return true;
			}
			return false;
		}
		public static function isStaff(){
			if(self::$Status == 16 || self::$Status == 17 || self::$Status == 32 || self::$Status == 48 || self::$Status == 64 || self::$Status == 80 || self::$Status == 128){
				return true;
			}
			return false;
		}
		public static function isAccessUser(){
			if(self::$UserID == 'Velocity' || self::$UserID == 'Velocity1' || self::$UserID == 'Velocity2'){
				return true;
			}
			return false;
		}
		# User Info
		public static function get_Status($Status){
			switch($Status){
				case '0'	:	return 'Player'; 				break;
				case '17'	:	return 'Developer'; 			break;
				case '16'	:	return 'Administrator'; 		break;
				case '32'	:	return 'GameMaster'; 			break;
				case '64'	:	return 'GameMaster Assistant'; 	break;
				case '80'	:	return 'GameSage'; 				break;
				case '128'	:	return 'GameSage'; 				break;
			}
		}
		public static function get_Mode($Grow){
			switch($Grow){
				case '0'	:	return 'Easy Mode'; 			break;
				case '1'	:	return 'Normal Mode'; 			break;
				case '2'	:	return 'Hard Mode'; 			break;
				case '3'	:	return 'Ultimate Mode'; 		break;
			}
		}
		public static function get_Class_L($Class){
			switch($Class){
				case '0'	:	return 'Fighter'; 				break;
				case '1'	:	return 'Defender'; 				break;
				case '2'	:	return 'Archer'; 				break;
				case '3'	:	return 'Ranger'; 				break;
				case '4'	:	return 'Mage'; 					break;
				case '5'	:	return 'Priest'; 				break;
			}
		}
		public static function get_Class_D($Class){
			switch($Class){
				case '0'	:	return 'Warrior'; 				break;
				case '1'	:	return 'Guardian'; 				break;
				case '2'	:	return 'Hunter'; 				break;
				case '3'	:	return 'Assassin'; 				break;
				case '4'	:	return 'Pagan'; 				break;
				case '5'	:	return 'Oracle'; 				break;
			}
		}
		public static function get_LoginStatus($Status){
			switch($Status){
				case '0'	:	return '<span class="skyblue">Offline</span>'; 				break;
				case '1'	:	return '<span class="green">Online</span>'; 				break;
			}
		}
		public static function get_Faction($Faction){
			switch($Faction){
				case '0'	:	return	'Alliance of Light';		break;
				case '1'	:	return	'Union of Fury';			break;
			}
		}
		public static function get_Map($Map){
			switch($Map){
				case '0'	:	return 'D-Water'; 						break;
				case '1'	:	return 'Erina'; 						break;
				case '2'	:	return 'Reikeuseu'; 					break;
				case '3'	:	return 'D1'; 							break;
				case '4'	:	return 'D1'; 							break;
				case '5'	:	return 'Cornwell\'s Ruin'; 				break;
				case '6'	:	return 'Cornwell\'s Ruin'; 				break;
				case '7'	:	return 'Argilla Ruin'; 					break;
				case '8'	:	return 'Argilla Ruin'; 					break;
				case '9'	:	return 'D2'; 							break;
				case '10'	:	return 'D2'; 							break;
				case '11'	:	return 'Kimu Room'; 					break;
				case '12'	:	return 'Cloron\'s Lair'; 				break;
				case '13'	:	return 'Cloron\'s Lair'; 				break;
				case '14'	:	return 'Cloron\'s Lair'; 				break;
				case '15'	:	return 'Fantasma\'s Lair'; 				break;
				case '16'	:	return 'Fantasma\'s Lair'; 				break;
				case '17'	:	return 'Fantasma\'s Lair'; 				break;
				case '18'	:	return 'Proelium'; 						break;
				case '19'	:	return 'Willieoseu'; 					break;
				case '20'	:	return 'Keuraijen'; 					break;
				case '21'	:	return 'Maitreyan FL2'; 				break;
				case '22'	:	return 'Maitreyan FL2'; 				break;
				case '23'	:	return 'Aidion Nekria FL2'; 			break;
				case '24'	:	return 'Aidion Nekria FL2'; 			break;
				case '25'	:	return 'Elemental Cave'; 				break;
				case '26'	:	return 'Ruber Chaos'; 					break;
				case '27'	:	return 'Ruber Chaos'; 					break;
				case '28'	:	return 'Adellia'; 						break;
				case '29'	:	return 'Adeurian'; 						break;
				case '30'	:	return 'Cantabilian'; 					break;
				case '31'	:	return 'Paros Temple'; 					break;
				case '32'	:	return 'Rapioru Maze'; 					break;
				case '33'	:	return 'Fedion Temple'; 				break;
				case '34'	:	return 'Khalamus House'; 				break;
				case '35'	:	return 'Apulune'; 						break;
				case '36'	:	return 'Iris'; 							break;
				case '37'	:	return 'Cave of Stigma'; 				break;
				case '38'	:	return 'Aurizen Ruin'; 					break;
				case '39'	:	return 'Secret Battle Arena'; 			break;
				case '40'	:	return 'Underground Stadium'; 			break;
				case '41'	:	return 'Prison'; 						break;
				case '42'	:	return 'Auction House'; 				break;
				case '43'	:	return 'Skulleron'; 					break;
				case '44'	:	return 'Astenes'; 						break;
				case '45'	:	return 'Deep Desert 1'; 				break;
				case '46'	:	return 'Deep Desert 2'; 				break;
				case '47'	:	return 'Stable Erde'; 					break;
				case '48'	:	return 'Cryptic Throne'; 				break;
				case '49'	:	return 'Cryptic Throne'; 				break;
				case '50'	:	return 'GRB'; 							break;
				case '51'	:	return 'Guild House'; 					break;
				case '52'	:	return 'Guild House'; 					break;
				case '53'	:	return 'Guild Management Office'; 		break;
				case '54'	:	return 'Guild Management Office'; 		break;
				case '55'	:	return 'Sky City'; 						break;
				case '56'	:	return 'Sky City'; 						break;
				case '57'	:	return 'Sky City'; 						break;
				case '58'	:	return 'Sky City'; 						break;
				case '59'	:	return 'Garden of Goddess'; 			break;
				case '60'	:	return 'World Cup'; 					break;
				case '61'	:	return 'Garden of Goddess'; 			break;
				case '62'	:	return 'Khalamus House'; 				break;
				case '63'	:	return 'Aurizen Ruin'; 					break;
				case '64'	:	return 'Oblivian Island'; 				break;
				case '65'	:	return 'Caelum Sacra'; 					break;
				case '66'	:	return 'Caelum Sacra'; 					break;
				case '67'	:	return 'Caelum Sacra Boss Room'; 		break;
				case '68'	:	return 'Valdemar Regnum'; 				break;
				case '69'	:	return 'Palaion Regnum'; 				break;
				case '70'	:	return 'Kanos Illium'; 					break;
				case '71'	:	return 'Queen Servus'; 					break;
				case '72'	:	return 'Queen Caput'; 					break;
				case '73'	:	return 'Zeharr\'s Mine'; 				break;
				case '74'	:	return 'Dimension\'s Crack'; 			break;
				case '75'	:	return 'Pantanssa'; 					break;
				case '76'	:	return 'Theodores'; 					break;
				case '77'	:	return 'Arcanus Ruins'; 				break;
				case '78'	:	return 'Arcanus Ruins FL2'; 			break;
				case '79'	:	return 'Hypnosis Ruins'; 				break;
				case '80'	:	return 'Wedding Map'; 					break;
				case '81'	:	return 'Canyon of Greed'; 				break;
				case '82'	:	return 'Unknown'; 						break;
				case '83'	:	return 'Unknown'; 						break;
				case '84'	:	return 'Unknown'; 						break;
				case '85'	:	return 'Unknown'; 						break;
				case '86'	:	return 'Unknown'; 						break;
			}
		}
    }
?>