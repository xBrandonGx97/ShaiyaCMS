<?php
	class Content{

		public $PAGE_TITLE;public $PAGE_SUB;public $PAGEURI;public $PAGE_INDEX;public $PAGE;

		public $C_FULL_WIDTH;

		function __construct($BossRecord,$GuildRanking,$Browser,$Data,$db,$GlobChat,$FreeRewards,$Dirs,$LogSys/*,$Messenger*/,$Modal,$Nav,$Paging,$Panels,$PHP,$Plugins,$Rank_DAO,$Readable,$Select,$Session,$Setting,$SQL,$Style,$Template,$User,$Jumbotron,$Carousel,$Downloads){
			$this->BossRecord	=	$BossRecord;
			$this->GuildRanking	=	$GuildRanking;
			$this->Browser		=	$Browser;
			$this->Data			=	$Data;
			$this->db			=	$db;
			$this->GlobChat		=	$GlobChat;
			$this->FreeRewards  = 	$FreeRewards;
			$this->Dirs			=	$Dirs;
			$this->LogSys		=	$LogSys;
#			$this->Messenger	=	$Messenger;
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
			$this->Jumbotron	=	$Jumbotron;
			$this->Carousel		=	$Carousel;
			$this->Downloads	=	$Downloads;

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
				echo '<div class="header"><h1><img src="assets/Themes/Standard/images/logos/DK.png" alt="" width="150" height="150"> '.$this->Setting->SITE_TITLE.' </h1></div>';
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
		function C_Breadcrumb(){
			if($this->Paging->PAGE_ZONE == "CMS"){
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
		}
		function C_CONTENT($Zone){
			if($Zone == "CMS"){
				$this->Setting->MAINTENANCE_CHECK();

				# Start Preloader
				if($this->Paging->PAGE_INDEX === "HOME"){
					if ($this->Setting->Preloader==1){
						echo '<div class="loading fadeout" id="loading">
						<div class="loading-text">
							<span class="loading-text-words">L</span>
							<span class="loading-text-words">O</span>
							<span class="loading-text-words">A</span>
							<span class="loading-text-words">D</span>
							<span class="loading-text-words">I</span>
							<span class="loading-text-words">N</span>
							<span class="loading-text-words">G</span>
							<br>
							<span class="loading-text-server">'.$this->Setting->SITE_TITLE.'</span>
						</div>
					</div>';
					}
				}
				# End Preloader

				# NAV
#				echo '<div class="container">';
				$this->Nav->NAV_TOP($Zone);
				# Get Carousel
				$this->Nav->NAV_SIDE($Zone);
				# CONTENT

				echo '<div class="sectionHead text-center">';
					echo '<div class="container">';
					echo $this->C_Breadcrumb();
					if($this->Paging->PAGE_INDEX === "HOME"){
						echo '<div class="alert alert-lightgray alert-dismissible fade show" role="alert">';
  							echo '<strong>Welcome, '.$this->User->UserLoginStatus.'</strong>  to '.$this->Setting->SITE_TITLE.'';
  								echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    								echo '<span aria-hidden="true">&times;</span>';
  								echo '</button>';
							echo '</div>';
					}
					# Jumbotron
					#if($this->Paging->PAGE_INDEX === "HOME"){
						if($this->Setting->Jumbotron==1){
							$this->Jumbotron->get_jumbo();
						}
					# Carousel
						if($this->Setting->Carousel==1){
							$this->Carousel->_get_carousel();
						}
						if($this->Setting->LOGO_ENABLED==1){
							echo $this->C_HEADER();
						}
					#}
					echo '</div>';
				echo '</div>';
				
#				echo '<div class="content-wrapper text-white">';
					require_once($this->Paging->PAGE);
				echo '</div>';

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

				if($this->Setting->FOOTER_ENABLED==1){
			echo '<footer id="footer" class="py-5">';
        echo '<div class="container py-5">';
            echo '<div class="row">';
                echo '<div class="col-6 col-md-6 col-lg-3 mb-2">';
                    echo '<h6 class="text-uppercase">Affiliates</h6>';
                    echo '<ul class="nav flex-column">';
                        echo '<li><a class="text-white" href="#" title="Elitepvpers" alt="Elitepvpers"><img class="float-left" src="assets/Themes/Standard/images/logos/elite.png"></a></li>';
                    echo '</ul>';
                echo '</div>';
                echo '<div class="col-6 col-md-6 col-lg-3 mb-2">';
                    echo '<h6 class="text-uppercase">Server</h6>';
					echo '<ul class="nav flex-column">';
						echo '<span class="text-muted">'.$this->Setting->SITE_FOOTER.'</span>';
						$this->Tpl->Separator(10);
						echo '<h6 class="text-uppercase">GRB Countdown</h6>';
						include('assets/Themes/Standard/js/GRB_Time.js');
						echo '<div><span class="dayss text-muted" id="days1"></span></div>';
                    echo '</ul>';
				echo '</div>';
                echo '<div class="col-12 col-md-12 col-lg-6 mb-2 text-right">';
                    echo '<h6 class="text-uppercase">Resources</h6>';
                    echo '<ul class="nav float-right">';
						echo '<li><a class="text-white mr" href="https://github.com/xBrandonGx97/ShaiyaCMS" title="Follow Project on GitHub!"><i class="fab fa-github"></i></a></li>';
						echo '<a class="scroll_top" href="#page-top"><i class="fas fa-angle-up"></i></a>';
                    echo '</ul>';
                echo '</div>';
			echo '</div>';
			if($this->Setting->Bless==1){
				include('assets/content/cms/info/Bless/bless.php');
			}
        echo '</div>';
    echo '</footer>';
				}
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