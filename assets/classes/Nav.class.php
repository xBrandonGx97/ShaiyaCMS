<?php
	class Nav{
		function __construct(
								$db,
								$Paging,
								$Plugins,
								$Setting,
		#						$Stats,
		#						$Theme,
								$Template,
								$User,
								$SQL
		){
			$this->db		=	$db;
			$this->Paging	=	$Paging;
			$this->Plugins	=	$Plugins;
			$this->Setting	=	$Setting;
		#	$this->Stats	=	$Stats;
		#	$this->Theme	=	$Theme;
			$this->Tpl		=	$Template;
			$this->User		=	$User;
			$this->SQL		=	$SQL;
		}
		function NAV_SERVER_STATUS(){
			if($this->Theme->_theme_array[2]){
				echo '<nav class="navbar navbar-expand-md navbar-dark fixed-top no_padding">';
					echo '<div class="container no-padding';
					if($this->Theme->_theme_array[11]){echo ' '.$this->Theme->_theme_array[11].'">';}
					else{echo ' no_bg">';}
						echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
							echo '<span class="navbar-toggler-icon"></span>';
						echo '</button>';
						echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
							echo '<ul class="navbar-nav mr-auto">';
								echo '<li class="nav-item"><font class="nav-link">Game Server: '.$this->Stats->GameStatus().'</font></li>';
								echo '<li class="nav-item"><font class="nav-link">Login Server: '.$this->Stats->LoginStatus().'</font></li>';
							echo '</ul>';

							echo '<ul class="navbar-nav pull-lg-right tar">';
							if($this->User->LoginStatus == 1){
								echo '<li class="nav-item">Welcome, <font class="b_i">'.$this->User->UserID.'</font>, your available DP is '.$this->User->Point.'</li>';
							}
							else{
								echo '<li class="nav-item">Welcome <font class="b_i">Guest</font>, please log in.</li>';
							}
							echo '</ul>';
						echo '</div>';
					echo '</div>';
				echo '</nav>';
			}
		}
		function NAV_TOP($Zone){
			if($Zone == "CMS"){
				echo '<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">';
					echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">';
						echo '<span class="navbar-toggler-icon"></span>';
					echo '</button>';

					echo '<div class="collapse navbar-collapse" id="navbarsExample05">';
					echo '<div class="container">';
							echo '<ul class="navbar-nav mr-auto">';
								$this->_get_nav_side_link('Home','HOME',1,0,'<i class="fa fa-fw fa-home"></i>');
								$this->_get_nav_side_dd('Download','DOWNLOAD',1,0);
								$this->ds_nav_dropdown('Server Information','About','ABOUT','Boss Records','BOSS_RECORDS',false,false,'DropFinder','DROPFINDER','Guild Rankings','GUILD_RANK','News','NEWS','Patch Notes','PATCH','Terms of Service','TERMS',false,false,1,0);
								/* Dropdown Func
								$this->ds_nav_dropdown('Dropdown Title','SubOpt1','SubOpt1Link','SubOpt2','SubOpt2Link','SubOpt3','SubOpt3Link','SubOpt4','SubOpt4Link','SubOpt5','SubOpt5Link','SubOpt6','SubOpt6Link','SubOpt7','SubOpt7Link','SubOpt8','SubOpt8Link','SubOpt9','SubOpt9Link',1,0);
								*/							
								echo '<li class="nav-item"><a class="nav-link" href="/community">Forum</a></li>';
								/* test new paging ex
								echo $this->Paging->data[1]['title'];
								*/
							echo '</ul>';
						echo '</div>';
						if($this->Setting->SERVERSTAT_NAV==1){
						echo '<div class="status">';
						$this->SQL->_get_serverStatus('127.0.0.1','30800','30810');
						echo '</div>';
						}
						echo '<ul class="navbar-nav ml-auto">';
						if(!$this->User->LoggedIn() || !isset($_SESSION['Status'])){
							echo '<li class="nav-item">';
								echo '<a class="nav-link" href="?'.$this->Setting->PAGE_PREFIX.'=REGISTER">Register</a>';
							echo '</li>';
							echo '<li class="nav-item">';
								echo '<a class="nav-link" href="?'.$this->Setting->PAGE_PREFIX.'=AUTH">Login</a>';
							echo '</li>';
						}
						else{
							$profileSQL = ("
											SELECT *
											FROM ".$this->db->get_TABLE('WEB_PRESENCE')."
											WHERE UserUID=?
							");
							$queryProfile=$this->db->conn->prepare($profileSQL);
							$queryParams = array($_SESSION["uuid"]);
							$queryProfile->execute($queryParams);
							$resultProfile = $queryProfile->fetchAll();
							$rowCountProfile = count($resultProfile);
									foreach($resultProfile as $playerprofile){
										echo '<a class="nav-link" href="#"><img class="img-fluid" src="assets/Themes/Standard/images/profile/avatars/'.$playerprofile['Avatar'].'" width="30" height="30"> '.$this->User->UserLoginStatus.'</a>';
									}
								
								if($this->User->IsStaff()){
									echo '<li class="nav-item">';
										echo '<a class="nav-link" href="?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD">Staff Panel</a>';
									echo '</li>';
								}
								echo '<li class="nav-item">';
									echo '<a class="nav-link" href="?'.$this->Setting->PAGE_PREFIX.'=LOGOUT">Logout</a>';
								echo '</li>';
							}
						echo '</ul>';
					echo '</div>';
				echo '</nav>';
			}
			elseif($Zone == "ACP"){
			echo '<nav class="navbar navbar-expand navbar-dark bg-dark acp-bg fixed-top">';
					echo '<a class="navbar-brand mr-1" href="?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD">
					<img class="img-responsive" src="assets/Themes/Standard/images/logos/Untitled-1.png" width="300" alt="Shaiya Notorious">
					</a>';
						echo '<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">';
							echo '<i class="fas fa-bars"></i>';
						echo '</button>';
							echo '<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">';
						echo '</form>';
						echo '<ul class="navbar-nav ml-auto ml-md-0">';
						echo '<li class="nav-item dropdown no-arrow">';
							 echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
							 if(isset($_SESSION["uuid"])){
									$sql = ("
												SELECT *
												FROM ".$this->db->get_TABLE('WEB_PRESENCE')."
												WHERE UserUID=?
									");
									$query=$this->db->conn->prepare($sql);
									$params = array($_SESSION["uuid"]);
									$query->execute($params);
									$result = $query->fetchAll();
									$rowCount = count($result);
									if($rowCount>0){
										foreach($result as $res){
											echo '<img class="img-fluid avatar-circle" src="assets/Themes/Standard/images/profile/avatars/'.$res['Avatar'].'" class="img-circle" alt="Avatar">';
											echo '<span> '.$this->User->UserLoginStatus.' </span>';
											echo '<i class="icon-submenu fas fa-chevron-down"></i>';
										}
									}
								}
								else{
										echo '<img class="img-fluid avatar-circle" src="assets/Themes/Standard/images/profile/avatars/shaiya_darkness.jpg" class="img-circle" alt="Avatar">';
										echo '<span> '.$this->User->UserLoginStatus.' </span>';
										echo '<i class="icon-submenu fas fa-chevron-down"></i>';
								}
							  echo '</a>';
								echo '<div class="dropdown-menu drop-acp-menu dropdown-menu-right" aria-labelledby="userDropdown">';
									if(!$this->User->LoggedIn() || !isset($_SESSION['Status'])){
										echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'=LOGIN1"><i class="fas fa-sign-in-alt"></i> Login</a>';
									}
									else{
										if($this->User->isStaff()){
										echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'=USER_PROFILE">Profile</a>';
										echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'=USER_STNGS">Settings</a>';
										}
										echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'=LOGOUT1">Logout</a>';
									}
							echo '</div>';
						echo '</li>';
					echo '</ul>';
				echo '</nav>';
			}
		}
		function NAV_SIDE($Zone){
			if($Zone == "CMS"){
			    echo '<div class="left-sidebar">';
					$this->Plugins->plugin_search_left();
				echo '</div>';

				echo '<div class="right-sidebar">';
					$this->Plugins->plugin_search_right();
				echo '</div>';
			}
			elseif($Zone == "ACP"){
			echo '<ul class="sidebar navbar-nav">';
				echo '<li class="nav-item active">';
					echo '<a class="nav-link" href="?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD">';
					echo '<i class="fas fa-fw fa-tachometer-alt"></i>';
				echo '<span>Dashboard</span>';
					echo '</a>';
				echo '</li>';
				if($this->User->isStaff()){
				$this->_get_acp_nav_side_dd('Developer','Mail Test','MAIL_TEST','Tools','TOOLS',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
				/* Nav Function Ex
				$this->_get_acp_nav_side_dd($PageCat,$PageTitle=false,$PageLink=false,$PageTitle1=false,$PageLink1=false,$PageTitle2=false,$PageLink2=false,$PageTitle3=false,$PageLink3=false,$PageTitle4=false,$PageLink4=false,$PageTitle5=false,$PageLink5=false,$PageTitle6=false,$PageLink6=false,$PageTitle7=false,$PageLink7=false,$PageTitle8=false,$PageLink8=false,$PageTitle9=false,$PageLink9=false,$PageTitle10=false,$PageLink10=false,$PageTitle11=false,$PageLink11=false,$PageTitle12=false,$PageLink12=false,$PageTitle13=false,$PageLink13=false,$PageTitle14=false,$PageLink14=false,$PageTitle15=false,$PageLink15=false,$PageShow,$ReqLogin,$LinkIcon=false)
				*/
				$this->_get_acp_nav_side_dd('Site','HP Editor','HP_EDITOR','News Editor','NEWS_EDITOR','Patch Editor','PATCH_NOTES_EDITOR',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
				$this->_get_acp_nav_side_dd('Admin','Access Logs','ADM_ACCSS_LOG','GM Commands Logs','ADM_CMD_LOG',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
				$this->_get_acp_nav_side_dd('Account','Account Ban','ACCT_BAN','Account Ban Search','ACCT_BAN_SEARCH','Account DP Handout','ACCT_GV_DP','Account Edit','ACCT_EDIT','Account IP Search','ACCT_IP_SRCH','Account Search','ACCT_SEARCH','Account Unban','ACCT_UNBAN',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
				$this->_get_acp_nav_side_dd('Player','Edit Player','PLR_EDIT','Item Deletion','PLR_ITM_DEL','Item Edit','PLR_ITM_EDIT','Jail Account','PLR_JAIL','Player Chat Search','PLR_CHAT_SRCH','Restore Character','PLR_RES','Un-Jail Account','PLR_UNJAIL','View Player Linked Gear','PLR_LNKED_GR','Warehouse Delete Items','PLR_WH_DEL','Warehouse Edit Items','PLR_WH_EDIT',false,false,false,false,false,false,false,false,false,false,false,false,1,0);
				$this->_get_acp_nav_side_dd('Misc','Disband Guild','MISC_GL_DISBND','Faction Change','MISC_FC','Global Chat','MISC_GLOB_CHAT','Guild Leader Change','MISC_GL_CHNG','Guild Name Change','MISC_GL_NM_CHNG','Guild Search','MISC_GL_SRCH','Item List','MISC_ITM_LST','Item Search','MISC_ITM_SRCH','Mob List','MISC_MOB_LST','Players Online','MISC_PL_ONLINE','Possible Stat Padders','MISC_STAT_PADDERS',false,false,false,false,false,false,false,false,false,false,1,0);
				$this->_get_acp_nav_side_dd('GS','Global Chat','GS_GLB_CHT','Players Online','GS_PL_ONLINE',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
				}
			echo '</ul>';
			}
		}
		function _get_nav_side_link($PageTitle,$PageLink,$PageShow,$ReqLogin,$LinkIcon=false){
			echo '<li class="nav-item active">';
				echo '<a href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink.'" class="nav-link">';
				if($LinkIcon){ 
					echo $LinkIcon.' ';
				}
				echo $PageTitle.'</a>';
			echo '</li>';
		}
		function _get_nav_side_dd($PageTitle,$PageLink,$PageShow,$ReqLogin,$LinkIcon=false){
			echo '<li class="nav-item">';
			# Page Index
			echo '<li class="nav-item"><a href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink.'" class="nav-link">';
			if($LinkIcon){
				echo $LinkIcon;
			}
			# Page Title
			echo $PageTitle.'</a>';
			echo '</li>';
		}
		function _get_acp_nav_side_dd($PageCat,$PageTitle=false,$PageLink=false,$PageTitle1=false,$PageLink1=false,$PageTitle2=false,$PageLink2=false,$PageTitle3=false,$PageLink3=false,$PageTitle4=false,$PageLink4=false,$PageTitle5=false,$PageLink5=false,$PageTitle6=false,$PageLink6=false,$PageTitle7=false,$PageLink7=false,$PageTitle8=false,$PageLink8=false,$PageTitle9=false,$PageLink9=false,$PageTitle10=false,$PageLink10=false,$PageTitle11=false,$PageLink11=false,$PageTitle12=false,$PageLink12=false,$PageTitle13=false,$PageLink13=false,$PageTitle14=false,$PageLink14=false,$PageTitle15=false,$PageLink15=false,$PageShow,$ReqLogin,$LinkIcon=false){
			$PageSub	=	$PageCat.' Tools';
				echo '<li class="nav-item dropdown">';
					echo '<a class="nav-link dropdown-toggle" href="#'.$PageSub.'" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
					echo '<i class="fas fa-fw fa-folder"></i>';
				echo '<span>'.$PageSub.'</span>';
					echo '</a>';
					echo '<div class="dropdown-menu drop-acp-menu" aria-labelledby="pagesDropdown">';
					if($PageTitle==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink.'">'.$PageTitle.'</a>';
					}
					if($PageTitle1==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink1.'">'.$PageTitle1.'</a>';
					}
					if($PageTitle2==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink2.'">'.$PageTitle2.'</a>';
					}
					if($PageTitle3==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink3.'">'.$PageTitle3.'</a>';
					}
					if($PageTitle4==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink4.'">'.$PageTitle4.'</a>';
					}
					if($PageTitle5==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink5.'">'.$PageTitle5.'</a>';
					}
					if($PageTitle6==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink6.'">'.$PageTitle6.'</a>';
					}
					if($PageTitle7==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink7.'">'.$PageTitle7.'</a>';
					}
					if($PageTitle8==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink8.'">'.$PageTitle8.'</a>';
					}
					if($PageTitle9==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink9.'">'.$PageTitle9.'</a>';
					}
					if($PageTitle10==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink10.'">'.$PageTitle10.'</a>';
					}
					if($PageTitle11==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink11.'">'.$PageTitle11.'</a>';
					}
					if($PageTitle12==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink12.'">'.$PageTitle12.'</a>';
					}
					if($PageTitle13==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink13.'">'.$PageTitle13.'</a>';
					}
					if($PageTitle14==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink14.'">'.$PageTitle14.'</a>';
					}
					if($PageTitle15==true){
						echo '<a class="dropdown-item drop-acp-itm" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink15.'">'.$PageTitle15.'</a>';
					}
					echo '</div>';
				echo '</li>';
		}
		function ds_nav_dropdown($PageCat,$PageTitle=false,$PageLink=false,$PageTitle1=false,$PageLink1=false,$PageTitle2=false,$PageLink2=false,$PageTitle3=false,$PageLink3=false,$PageTitle4=false,$PageLink4=false,$PageTitle5=false,$PageLink5=false,$PageTitle6=false,$PageLink6=false,$PageTitle7=false,$PageLink7=false,$PageTitle8=false,$PageLink8=false,$PageShow,$ReqLogin){
			echo '<li class="nav-item dropdown">';
				echo '<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="dropdown05" aria-haspopup="true" aria-expanded="false">'.$PageCat.'</a>';
					echo '<div class="dropdown-menu" aria-labelledby="dropdown05">';
				if($PageTitle==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink.'"><i class="fa fa-chevron-right"></i> '.$PageTitle.'</a>';
				}
				if($PageTitle1==true){
				echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink1.'"><i class="fa fa-chevron-right"></i>'.$PageTitle1.'</a>';
				}
				if($PageTitle2==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink2.'"><i class="fa fa-chevron-right"></i>'.$PageTitle2.'</a>';
				}
				if($PageTitle3==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink3.'"><i class="fa fa-chevron-right"></i>'.$PageTitle3.'</a>';
				}
				if($PageTitle4==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink4.'"><i class="fa fa-chevron-right"></i>'.$PageTitle4.'</a>';
				}
				if($PageTitle5==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink5.'"><i class="fa fa-chevron-right"></i>'.$PageTitle5.'</a>';
				}
				if($PageTitle6==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink6.'"><i class="fa fa-chevron-right"></i>'.$PageTitle6.'</a>';
				}
				if($PageTitle7==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink7.'"><i class="fa fa-chevron-right"></i>'.$PageTitle7.'</a>';
				}
				if($PageTitle8==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="?'.$this->Setting->PAGE_PREFIX.'='.$PageLink8.'"><i class="fa fa-chevron-right"></i>'.$PageTitle8.'</a>';
				}
				echo '</div>';
			echo '</li>';
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