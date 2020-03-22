<?php
	class Display{

		# MAIN VARS
		public $PAGE_TITLE;public $PAGE_SUB;public $PAGEURI;public $PAGE_INDEX;public $PAGE;public $PAGE_ZONE;
		# PAGINATION
		public $ServerBase;public $TestURL;

		# CONSTRUCTOR
		function __construct($Content,$Data,$db,$GlobChat,$Nav,$Paging,$Panels,$Session,$Setting,$Style,$Template,$User){
			$this->Content		=	$Content;
			$this->Data			=	$Data;
			$this->db			=	$db;
			$this->GlobChat		=	$GlobChat;
			$this->Nav			=	$Nav;
			$this->Paging		=	$Paging;
			$this->Panels		=	$Panels;
			$this->Session		=	$Session;
			$this->Setting		=	$Setting;
			$this->Style		=	$Style;
			$this->Tpl			=	$Template;
			$this->User			=	$User;

			$this->Tpl->NoMsgArr();
		}
		# HEAD
		function UNI_HEAD_CORE(){
			echo '<!DOCTYPE html>';
			echo '<html lang="en" class="cms-html">';
		}
		function UNI_HEAD_PAGINATION(){
			ucwords(str_ireplace(array('-','_','.php'),array(' ',''),$this->Paging->PAGE));

			$this->ServerBase = (ucwords(str_ireplace(array('-', '.php'),array(' ',''),$this->Paging->PAGE)));
			$this->TestURL = $this->ServerBase;

			if(substr_count($this->TestURL,'/') > 0){
				$this->TestURL = substr($this->TestURL,(strrpos($this->TestURL,'/') +1));
			}else{
				$this->TestURL = substr($this->TestURL,(strrpos($this->TestURL,'/')));
			}
		}
		function UNI_HEAD_META(){
			echo '<meta charset="utf-8">';
			echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
			echo '<meta name="Author" content="'.$this->Setting->AUTHOR.'"/>';
			echo '<meta name="Copyrights" content="'.$this->Setting->SITE_TITLE.'"/>';
			echo '<meta name="Designer" content="'.$this->Setting->SITE_TITLE.'"/>';
			echo '<meta name="Description" content=""/>';
			echo '<meta name="Robots" content="all"/>';
			echo '<meta name="Version" content="'.$this->Setting->VERSION.'"/>';
			echo '<meta name="Webmaster" content="'.$this->Setting->WEBMASTER.'"/>';
			echo '<link rel="shortcut icon" href="assets/Themes/Standard/images/icons/favicon.ico">';
		}
		function UNI_HEAD_CACHE(){
			# Headers | Caching
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Cache-Control: no-store, no-cache, must-revalidate');
				header('Cache-Control: post-check=0, pre-check=0', FALSE);
				header('Pragma: no-cache');
		}
		function UNI_HEAD_TITLE(){
			if($this->Paging->PAGE_ZONE == "CMS"){
				echo '<title>';
					if(isset($this->Paging->PAGE_TITLE)){
						echo $this->Setting->SITE_TITLE." | ".$this->Paging->PAGE_TITLE;
					}
					else{
						echo $this->Setting->SITE_TITLE." | ".str_ireplace('_',' ',$this->TestURL);
					}
				echo '</title>';
			}
			if($this->Paging->PAGE_ZONE == "ACP"){
				echo '<title>';
					if(isset($this->Paging->PAGE_TITLE)){
						echo $this->Setting->ACP_SITE_TITLE." | ".$this->Paging->PAGE_TITLE;
					}
					else{
						echo $this->Setting->ACP_SITE_TITLE." | ".str_ireplace('_',' ',$this->TestURL);
					}
				echo '</title>';
			}
		}
		function UNI_HEAD_SS(){
			# BOOTSTRAP
			echo '<link rel="stylesheet" href="assets/Themes/Standard/css/bootstrap.min.css">';
			# FONTAWESOME
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[41].'" media="all">';
			# JQUERYUI
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[7].'" media="all">';
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[8].'" media="all">';
			if($this->Paging->PAGE_ZONE == "CMS"){
				# Custom CSS
				echo '<link rel="stylesheet" type="text/css" href="assets/Themes/Standard/css/style.css" media="all"/>';
				echo '<link rel="stylesheet" type="text/css" href="assets/Themes/Standard/css/custom.css" media="all"/>';
				echo '<link rel="stylesheet" type="text/css" href="assets/Themes/Standard/css/server_status.css" media="all"/>';
				echo '<link rel="stylesheet" type="text/css" href="assets/Themes/Standard/css/players_online.css" media="all"/>';

				if($this->Paging->PAGE_INDEX === "PVP" || $this->Paging->PAGE_INDEX === "RANK_DAO"){
					echo '<link rel="stylesheet" href="assets/Themes/Standard/css/pvp.css" type="text/css" media="all" />';
					echo '<link rel="stylesheet" href="assets/Themes/Standard/css/jquery.qtip.css" type="text/css" media="all" />';
				}
			}
			if($this->Paging->PAGE_ZONE == "ACP"){
				# Data tables
				echo '<link rel="stylesheet" href="assets/Themes/ACP/css/datatables.css">';
				# ACP CSS
				echo '<link rel="stylesheet" href="assets/Themes/ACP/css/sb-admin.css">';
				echo '<link rel="stylesheet" type="text/css" href="assets/Themes/ACP/css/custom.css" media="all"/>';
			}
			# AJAX Loader CSS
			echo '<link rel="stylesheet" type="text/css" href="assets/Themes/Core/LoadLab/bt-spinner.css" media="all">';

    		# Google Fonts
    		echo '<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">';
		}
		function UNI_HEAD_JS(){
			# JQUERY
			echo '<script src="assets/jQuery/v1.12.4/jquery-v1.12.4.js"></script>';
			# JQUERYUI
			echo '<script src="assets/Themes/ACP/js/UI/1.11.4/jquery.1.11.4.ui.js"></script>';
			# BOOTSTRAP
			echo '<script src="assets/Themes/Standard/js/bootstrap.bundle.js"></script>';

			if($this->Paging->PAGE_ZONE == "CMS"){
				if($this->Paging->PAGE_INDEX === "PVP"){
					echo '<link rel="stylesheet" href="assets/Themes/Standard/css/pvp.css" type="text/css" media="all" />';
				#	echo '<link rel="stylesheet" href="assets/Themes/Standard/css/jquery.qtip.css" type="text/css" media="all" />';

				#	echo '<script type="text/javascript" src="assets/Themes/Standard/js/jquery.qtip.min.js"></script>';
					echo '<script type="text/javascript" src="assets/Themes/Standard/js/lib.js"></script>';
				}
			}
			if($this->Paging->PAGE_ZONE == "ACP"){
				
				# ACP JS
				echo '<script src="assets/Themes/ACP/js/sb-admin.js"></script>';
			}
			# Data tables
				echo '<script src="assets/Themes/ACP/js/datatables.js"></script>';
		}
		function UNI_JS_ADDONS(){
			echo '<div class="addons_js">';
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';
				# TINYMCE TEXTBOX
			if($this->Paging->PAGE_ZONE == "CMS"){
				echo '<script src="assets/Themes/Standard/js/custom.js"></script>';
			}
			if($this->Paging->PAGE_ZONE == "ACP"){
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[26].'"></script>';
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[27].'"></script>';
			}
				# TABS
				echo '<script src="assets/Themes/ACP/js/tabs/tabs.js"></script>';
			echo '</div>';
		}
		# DISPLAY LOADERS
		function LaunchDisplay(){
			$this->UNI_HEAD_CORE();
			$this->Load_Head();
			$this->Load_Content($this->Paging->PAGE_ZONE);
		}
		function Load_Head(){
			echo '<head>';
				$this->UNI_HEAD_PAGINATION();
				$this->UNI_HEAD_META();
				$this->UNI_HEAD_CACHE();
				$this->UNI_HEAD_TITLE();
				$this->UNI_HEAD_SS();
				$this->UNI_HEAD_JS();
			echo '</head>';
		}
		function Load_Nav($Zone){
			if($Zone == "CMS"){
				if($this->Paging->PAGE_INDEX === "LANDING" || $this->Paging->PAGE_INDEX === "MAINTENANCE"){
					$this->Nav->NavTop($this->Paging->PAGE_ZONE);
				}
				else{
					if($this->Theme->_theme_array[2]){
						$this->Nav->NAV_SERVER_STATUS();
						$this->Nav->NAV_TOP($Zone);
					}
					else{
						$this->Nav->NAV_TOP($Zone);
						echo $this->Tpl->Separator("40");
					}

				//	if($this->Paging->PAGE_INDEX === "AUTH"){}
				}
			}
			elseif($Zone == "ACP"){
				$this->Nav->NavTop($this->Paging->PAGE_ZONE);
			}
		}
		function Load_Content($Zone){
		#	$this->Tpl->BG_IMG($Zone);
		
			if($Zone == "CMS"){
			echo '<body id="page-top" class="cms-body">';
				$this->Content->C_CONTENT($Zone);
			}
			elseif($Zone == "ACP"){
			echo '<body id="page-top" class="acp-body">';
				$this->Content->C_CONTENT($Zone);
			}

			# Load jQuery Addons Array
			$this->UNI_JS_ADDONS();
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