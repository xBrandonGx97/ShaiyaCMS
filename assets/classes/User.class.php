<?php
	class User{

		private $sql=NULL;
		private $res=NULL;
		private $fet=NULL;

		public $UserUID=NULL;
		public $UserID=NULL;
		public $Status=NULL;
		public $UseQueue=NULL;
		public $RegDate=NULL;
		public $LeaveDate=NULL;
		public $Point=NULL;
		public $UserIP=NULL;
		public $Email=NULL;

		public $LoginStatus=NULL;
		public $LoginGuest=NULL;

		public $UserLoginStatus=NULL;

		function __construct($Browser,$Data,$db,$Setting,$Template){
			$this->Browser	=	$Browser;
			$this->Data		=	$Data;
			$this->db		=	$db;
			$this->Setting	=	$Setting;
			$this->Tpl		=	$Template;

			if(isset($_SESSION) && isset($_SESSION["uid"])){
				$this->sql = ("
								SELECT TOP 1 *
								FROM ".$this->db->get_TABLE("SH_USERDATA")."
								WHERE UserID = '".$_SESSION["uid"]."'
				");
				$this->query=$this->db->conn->prepare($this->sql);
				$this->query->execute();
				$this->fet = $this->query->FETCH();

				$this->UserUID		=	$this->fet["UserUID"];
				$this->UserID		=	$this->fet["UserID"];
			#	$this->RegDate		=	$this->fet["RegDate"];
				$this->LeaveDate	=	$this->fet["LeaveDate"];
				$this->Status		=	$this->fet["Status"];
				$this->UserIP		=	$this->fet["UserIp"];
				$this->Point		=	$this->fet["Point"];
				$this->Email		=	$this->fet["Email"];
			}

			$this->LoggedIn();
			$this->get_isLoggedInName();
		}
		function isAdmin(){
			if($this->Status == 16 || $this->Status == 17){
				return true;
			}
			return false;
		}
		function AllGM(){
			if($this->Status == 17 || $this->Status == 16 || $this->Status == 32 || $this->Status == 48 || $this->Status == 64 || $this->Status == 80){
				return true;
			}
			else{
				return false;
			}
		}
		function isGameMaster(){
			if($this->Status == 32 || $this->Status == 64 || $this->Status == 80){
				return true;
			}
			return false;
		}
		function isGameSage(){
			if($this->Status == 128){
				return true;
			}
			return false;
		}
		function isStaff(){
			if($this->Status == 16 || $this->Status == 17 || $this->Status == 32 || $this->Status == 48 || $this->Status == 64 || $this->Status == 80 || $this->Status == 128){
				return true;
			}
			return false;
		}
		function LoggedIn(){
			if(!empty($this->UserUID) && !empty($this->UserID) && is_numeric($this->UserUID)){
				$this->LoginStatus	=	1;
				return true;
			}
			else{
				$this->LoginStatus	=	0;
				return false;
			}
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
		function get_isLoggedIn(){
			# User Login Check
			if(isset($this->UserUID) && isset($this->UserID) && is_numeric($this->UserUID)){
				return true;
			}
			return false;
		}
		function get_isLoggedInName(){
			# User Login Check
			if(isset($this->UserUID,$this->UserID)){
				$this->UserLoginStatus = $this->UserID;
			}else{
				$this->UserLoginStatus = "Guest";
			}
		}
		function Auth(){
			if(!$this->LoggedIn()){
				header('location: ?'.$this->Setting->PAGE_PREFIX.'=LOGIN1');
				die();
			}
		}
		function AuthCMS(){
			if(!$this->LoggedIn()){
				header('location: ?'.$this->Setting->PAGE_PREFIX.'=LOGIN');
				die();
			}
		}
		function AccessCheck(){
			if ($this->LoggedIn()) {
				if(!$this->isStaff()){
					$this->Tpl->_do_ACP_pageHeader("","",false,"12","Access Denied!");
						echo '<span style="color:red">Sorry, you don\'t have permission to access this website!</span>';
					$this->Tpl->_do_ACP_pageFooter();
				}
			}
		}
		function AuthStaff(){
			if(!$this->isStaff()){
				header("Location: ?".$this->Setting->PAGE_PREFIX."=DASHBOARD");
				die();
			}
		}
		function AuthGM(){
			if(!$this->AllGM()){
				header("Location: ?".$this->Setting->PAGE_PREFIX."=DASHBOARD");
				die();
			}
		}
		function AuthADM(){
			if(!$this->isAdmin()){
				header("Location: ?".$this->Setting->PAGE_PREFIX."=DASHBOARD");
				die();
			}
		}
		function get_Status($Status){
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
		function get_Mode($Grow){
			switch($Grow){
				case '0'	:	return 'Easy Mode'; 			break;
				case '1'	:	return 'Normal Mode'; 			break;
				case '2'	:	return 'Hard Mode'; 			break;
				case '3'	:	return 'Ultimate Mode'; 		break;
			}
		}
		function get_Class_L($Class){
			switch($Class){
				case '0'	:	return 'Fighter'; 				break;
				case '1'	:	return 'Defender'; 				break;
				case '2'	:	return 'Archer'; 				break;
				case '3'	:	return 'Ranger'; 				break;
				case '4'	:	return 'Mage'; 					break;
				case '5'	:	return 'Priest'; 				break;
			}
		}
		function get_Class_D($Class){
			switch($Class){
				case '0'	:	return 'Warrior'; 				break;
				case '1'	:	return 'Guardian'; 				break;
				case '2'	:	return 'Hunter'; 				break;
				case '3'	:	return 'Assassin'; 				break;
				case '4'	:	return 'Pagan'; 				break;
				case '5'	:	return 'Oracle'; 				break;
			}
		}
		function get_LoginStatus($Status){
			switch($Status){
				case '0'	:	return '<span class="skyblue">Offline</span>'; 				break;
				case '1'	:	return '<span class="green">Online</span>'; 				break;
			}
		}
		function get_Faction($Faction){
			switch($Faction){
				case '0'	:	return	'Alliance of Light';		break;
				case '1'	:	return	'Union of Fury';			break;
			}
		}
		function get_Map($Map){
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
		function get_UserInfo($UserUID,$col=false){
			$return=false;

			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE("SH_USERDATA").'
							WHERE UserUID=?
			');
			$stmt=$this->db->conn->prepare($sql);
			$args = array($UserUID);
			$stmt->execute($args);

			try{
				$return=array();
				$cnt=0;
				while($results=$stmt->fetch()){
					foreach($results as $key=>$value){
						if($col){
							if($key==$col){
								$return=$results[$col];
								break;
							}
							else{$return = 'Datatype Invalid';}
						}
						else{$return[$key]=$value;}
					}
					$cnt++;
				}
			return $return;
			}catch (PDOException $e) {

			}
		}
		function enc_recovery_key(){}
		function dec_recovery_key(){}
		function pagination($page,$max_page,$url="",$number=4,$get_name="page"){
			$a		=	"";
			$b		=	"";
			$sheet	=	"";
			# function for showing next pages
			if(preg_match("/\?/",$url )){$appendix = "&amp;";}
			else{$appendix = "?";}
			if(substr($url,-1,1)=="&"){
				$url = substr_replace($url,"",-1,1);
			}elseif(substr($url,-1,1)=="?"){
				$appendix	= "?";
				$url		= substr_replace($url,"",-1,1);
			}
			if($number %2 != 0){
				$number++;
				$a			= $page - ($number/2);
				$b			= 0;
				$sheet	= array();
			}
			while($b<=$number){
				if($a>0&&$a<=$max_page){
					$sheet[]=$a;
					$b++;
				}elseif($a>$max_page&&($a-$number-2)>=0){ 
					$sheet	=	array();
					$a		-=	($number+2);
					$b		=	0;
				}elseif($a>$max_page&&($a-$number-2)<0){
					break;
				}
				$a++;
			}
			$return = "";
			if(!in_array(1,$sheet) && count($sheet) > 1){
				if(!in_array(2,$sheet)){
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=1\"><img src=\"left.png\" alt=\"\"></a></li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=1\">1</a></li>";
				}
			}
			foreach($sheet as $sheets){
				if($sheets==$page){
					$return	.=	"<li class=\"page-item\">$sheets</li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$sheets\">$sheets</a></li>";
				}
			}
			if(!in_array($max_page,$sheet)&&count($sheet)>1){
				if(!in_array(($max_page-1),$sheet)){
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$max_page\"><img src=\"next.png\" alt=\"\"></a></li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$max_page\">$max_page</a></li>";
				}
			}
			if(empty($return)){
				return "<li class=\"page-item\">1</li>";
			}else{
				return $return;
			}
		}
		function _do_avatar($UserUID,$UserID){
			$placeholder = 'shaiya_darkness.jpg';

			$sql	=	("
							SELECT UserUID
							FROM ".$this->db->get_TABLE("WEB_PRESENCE")."
							WHERE UserUID=?
			");
			$stmt=$this->db->conn->prepare($sql);
			$args = array($UserUID);
			$stmt->execute($args);
			$result = $stmt->fetchAll();
			$rowCount = count($result);

			try{
				if($rowCount==0){
					$sql	=	("
									INSERT INTO  ".$this->db->get_TABLE("WEB_PRESENCE")."
										(UserUID,UserID,Header,Avatar)
									VALUES
										(?,?,?,?)
					");
					$stmt=$this->db->conn->prepare($sql);
					$args	=	array($UserUID,$UserID,$placeholder,$placeholder);
					$stmt->execute($args);
				}
/*				elseif(odbc_num_rows($stmt) == 1){
					$sql	=	("
									UPDATE ".$this->db->get_TABLE("WEB_PRESENCE")."
									SET Avatar = ?,Header = ?
									WHERE UserUID = ?
					");
					$stmt	=	odbc_prepare($this->db->conn,$sql);
					$args	=	array($placeholder,$placeholder,$UserUID);
					$prep	=	odbc_execute($stmt,$args);
				}
*/
			}catch (PDOException $e) {

			}
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