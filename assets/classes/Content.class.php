<?php
	class Content{

		public $PAGE_TITLE;public $PAGE_SUB;public $PAGEURI;public $PAGE_INDEX;public $PAGE;

		public $C_FULL_WIDTH;

		function __construct($BossRecord,$GuildRanking,$Browser,$Data,$db,$GlobChat,$Dirs,$LogSys,$Modal,$Nav,$Paging,$Panels,$PHP,$Plugins,$Rank_DAO,$Readable,$Select,$Session,$Setting,$SQL,$Style,$Template,$User){
			$this->BossRecord	=	$BossRecord;
			$this->GuildRanking	=	$GuildRanking;
			$this->Browser		=	$Browser;
			$this->Data			=	$Data;
			$this->db			=	$db;
			$this->GlobChat		=	$GlobChat;
			$this->Dirs			=	$Dirs;
			$this->LogSys		=	$LogSys;
			$this->Modal		=	$Modal;
			$this->Nav			=	$Nav;
			$this->Paging		=	$Paging;
			$this->Panels		=	$Panels;
			$this->PHP			=	$PHP;
			$this->Plugins		=	$Plugins;
			$this->Rank_DAO		=	$Rank_DAO;
			$this->Readable		=	$Readable;
			$this->Select		=	$Select;
			$this->Session		=	$Session;
			$this->Setting		=	$Setting;
			$this->SQL			=	$SQL;
			$this->Style		=	$Style;
			$this->Tpl			=	$Template;
			$this->User			=	$User;

			$this->C_FULL_WIDTH();
		}
		function C_FULL_WIDTH(){
			$this->C_FULL_WIDTH = array("USER_PROFILE","REGISTER","VALIDATE","ISSUE_TRKR","TOOLS");
		}
		function C_MESSENGER(){

			if(!isset($_SESSION["MESSAGES"])){
				$_SESSION["MESSAGES"] = $this->Messenger->Init();
			}
			elseif(isset($_SESSION["MESSAGES"]) && !empty($_SESSION["MESSAGES"])){
				echo '<div class="container no_padding msg_container">';
					echo '<div class="row msg_data" style="border:1px solid lime;">';
						echo '<div class="col-md-12">';
							echo $this->Messenger->Display($_SESSION["MESSAGES"]);
							#$this->Messenger->Close();
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}


			if($this->Messenger->getSystemMessages()){
				echo '<div class="container no_padding msg_container">';
					echo '<div class="row msg_data" style="border:1px solid lime;">';
						echo '<div class="col-md-12">';
							foreach($this->Messenger->getSystemMessages() as $message){
								echo '<div class="alert alert-'.$message['type'].'">';
									echo $message['text'];
									echo '<a class="close" data-dismiss="alert" href="#">&times;</a>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				
			}
		}
		function C_HEADER(){
			if($this->Paging->PAGE_ZONE == "CMS"){
				# Header Image
				echo '<div class="header"><h1><img src="assets/Themes/Standard/images/logos/DK.png" alt=" "> Gaming Logo </h1></div>';

				# Breadcrumb
				echo '<nav aria-label="breadcrumb">';
					echo '<ol class="breadcrumb bg-dark">';
					if($this->Paging->PAGE_INDEX != "HOME"){
						echo '<li class="breadcrumb-item"><a href="?'.$this->Setting->PAGE_PREFIX.'=HOME">Template</a></li>';
						if($this->Paging->PAGE_SUB){
							echo '<li class="breadcrumb-item active" aria-current="PAGE">'.$this->Paging->PAGE_SUB.'</li>';
						}
						echo '<li class="breadcrumb-item active" aria-current="page">'.$this->Paging->PAGE_CAT.'</li>';
						echo '<li class="breadcrumb-item active" aria-current="PAGE">'.$this->Paging->PAGE_TITLE.'</li>';
					}
					else{
						echo '<li class="breadcrumb-item"><a href="?'.$this->Setting->PAGE_PREFIX.'=HOME">Template</a></li>';
						echo '<li class="breadcrumb-item active" aria-current="PAGE">Home</li>';
					}
					echo '</ol>';
				echo '</nav>';
						

			}
			elseif($this->Paging->PAGE_ZONE == "ACP"){
				# Breadcrumb
			echo '<nav aria-label="breadcrumb">';
				echo '<ol class="breadcrumb bg-dark acp-bg acp-breadcrumb">';
					if($this->Paging->PAGE_INDEX != "DASHBOARD"){
						echo '<li class="breadcrumb-item"><a href="?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD">Notorious</a></li>';
							echo '<li class="breadcrumb-item active" aria-current="page">'.$this->Paging->PAGE_CAT.'</li>';
							echo '<li class="breadcrumb-item active" aria-current="PAGE">'.$this->Paging->PAGE_TITLE.'</li>';
					}else{
							echo '<li class="breadcrumb-item"><a href="?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD">Notorious</a></li>';
							echo '<li class="breadcrumb-item active" aria-current="PAGE">Dashboard</li>';
						 }
				echo '</ol>';
			echo '</nav>';
			}
		}
		function C_CONTENT($Zone){
			if($Zone == "CMS"){
				$this->Setting->MAINTENANCE_CHECK();

				echo '<header class="container">';echo '</header>';
				# NAV
				$this->Nav->NAV_TOP($Zone);
				$this->Nav->NAV_SIDE($Zone);
				# CONTENT
				echo '<div class="container no-padding nav-divider"></div>';
				echo $this->C_HEADER();
#				echo '<div class="content-wrapper text-white">';
					require_once($this->Paging->PAGE);
#				echo '</div>';
				$this->Tpl->Separator('60');

				$this->body_footer($Zone);
			}
			elseif($Zone == "ACP"){
				$this->Setting->MAINTENANCE_CHECK();
				# NAV
				$this->Nav->NAV_TOP($Zone);
				echo '<div id="wrapper">';	
				$this->Nav->NAV_SIDE($Zone);
				# CONTENT
				echo '<div id="content-wrapper">';
					echo '<div class="container-fluid">';
						echo $this->C_HEADER();
							require_once($this->Paging->PAGE);
			#			echo '</div>';
			#		echo '</div>';
			#	echo '</div>';
			

				$this->body_footer($Zone);
			}
		}
		function body_sidebar(){
			if($this->Theme->_theme_array[0] == '2'){
				if($this->Theme->_theme_array[15]){
					$this->Plugins->plugin_search();
				}
			}
		}
		function PAGE_landing($data){
			include($data);
		}
		function body_footer($Zone){
			if($Zone == "CMS"){

				echo '<footer class="footer">';
				#echo '<footer class="fixed-bottom text-white text-center">';
					echo '<div class="container">';
						echo '<span class="text-muted">'.$this->Setting->SITE_FOOTER.'<img src="assets/Themes/Standard/images/logos/elite.png"></span>';
					echo '</div>';
				echo '</footer>';
			}
			elseif($Zone == "ACP"){
				echo '</div>'; #container fluid
				echo '<footer class="sticky-footer">';
					echo '<div class="container my-auto">';
						echo '<div class="copyright text-center my-auto">';
#							echo '<span class="text-muted">'.$this->Setting->SITE_FOOTER.'</span>';
							echo '<p class="copyright tac f_20 b">&copy; 2018 <a href="?p=home">Template</a>. All Rights Reserved.<img src="assets/Themes/Standard/images/logos/elite.png"></p>';
							echo '<label class="badge badge-primary b_i f_14">v'.$this->Setting->VERSION.'</label>';
						echo '</div>';
					echo '</div>';
				echo '</footer>';
				echo '</div>'; #content wrapper
				echo '</div>'; #wrapper
			}
			echo '<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
    </a>';
			echo '</body>';
			echo '</html>';
		}
		function _load_base(){
			# CONTENT
			echo '<header class="container">';echo '</header>';
				# LOAD PAGE
				echo '<div class="container no-padding nav-divider"></div>';
					require_once($this->Paging->PAGE);
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
		function _do_pre($data,$kill=false){
			if($data){
				echo '<pre>';
					var_dump($data);
				echo '</pre>';
				if($kill){
					switch($kill){
						case 1 : die();break;
						case 2 : exit();break;
					}
				}
			}
			else{
				echo 'No data to show...<br>';
			}
		}
		
	}
?>