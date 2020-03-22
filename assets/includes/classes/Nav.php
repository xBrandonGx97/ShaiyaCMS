<?php
	Class Nav{
		public static function NavTop(){
			if(Settings::$PageZone == "Site"){
				if(Settings::$SiteTheme == 'shCMS'){
					echo '<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">';
					echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">';
						echo '<span class="navbar-toggler-icon"></span>';
					echo '</button>';

					echo '<div class="collapse navbar-collapse" id="navbarsExample05">';

								echo '<div class="container">';
									echo '<ul class="navbar-nav mr-auto">';
										self::_get_nav_side_link('Home','home',1,0,'<i class="fa fa-fw fa-home"></i>');
										self::_get_nav_side_dd('Download','community/downloads',1,0);
										self::ds_nav_dropdown('Server Information','About','serverinfo/about','Boss Records','serverinfo/bossrecords',false,false,'DropFinder','serverinfo/dropfinder','Guild Rankings','serverinfo/guildrankings',false,false,false,false,'Terms of Service','serverinfo/terms',false,false,1,0);
										/* Dropdown Func
										$this->ds_nav_dropdown('Dropdown Title','SubOpt1','SubOpt1Link','SubOpt2','SubOpt2Link','SubOpt3','SubOpt3Link','SubOpt4','SubOpt4Link','SubOpt5','SubOpt5Link','SubOpt6','SubOpt6Link','SubOpt7','SubOpt7Link','SubOpt8','SubOpt8Link','SubOpt9','SubOpt9Link',1,0);
										*/
										self::ds_nav_dropdown('Community','Forum','./forum','Discord','community/discord','News','community/news','Patch Notes','community/patchnotes',false,false,'PvP Rankings','community/pvprankings',false,false,false,false,false,false,1,0);
										self::ds_nav_dropdown('Media','Gallery','community/media/gallery',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
										if(User::LoggedIn()){
											#self::ds_nav_dropdown('Member','Free Rewards','FREE_LOOT',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
										}
									echo '</ul>';
								echo '</div>';
								if(Settings::$ServStatusNav==1){
									echo '<div class="status">';
										SQL::_get_serverStatus(Settings::$ServerIP,Settings::$LoginPort,Settings::$GamePort);
									echo '</div>';
								}
								echo '<ul class="navbar-nav ml-auto">';
								if(!User::LoggedIn() || !isset($_SESSION['Status'])){
									echo '<li class="nav-item">';
										echo '<a class="nav-link" href="'.DOC_ROOT.'/member/register">Register</a>';
									echo '</li>';
									echo '<li class="nav-item">';
										echo '<a class="nav-link" href="'.DOC_ROOT.'/member/login">Login</a>';
									echo '</li>';
								}else{
									$profileSQL = ("
													SELECT *
													FROM ".Database::getTable('WEB_PRESENCE')."
													WHERE UserUID=?
									");
									$queryProfile=Database::connect()->prepare($profileSQL);
									$queryParams = array($_SESSION["UserUID"]);
									$queryProfile->execute($queryParams);
									$resultProfile = $queryProfile->fetchAll();
									$rowCountProfile = count($resultProfile);
									foreach($resultProfile as $playerprofile){
										/* With Avatars */
										#echo '<a class="nav-link" href="#"><img class="img-fluid" src="assets/Themes/Standard/images/profile/avatars/'.$playerprofile['Avatar'].'" width="30" height="30"> '.User::$UserLoginStatus.'</a>';
										/* Without Avatars */
										#echo '<a class="nav-link" href="#">'.User::$UserLoginStatus.'</a>';
										/* With Dropdown */
										echo '<li class="nav-item dropdown">';
										echo '<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="dropdown05" aria-haspopup="true" aria-expanded="false">'.User::$UserLoginStatus.'</a>';
										echo '<div class="dropdown-menu" aria-labelledby="dropdown05">';
										#echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/member/profile"><i class="fa fa-chevron-right"></i> Profile</a>';
										echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/member/settings"><i class="fa fa-chevron-right"></i> Settings</a>';
										echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/member/recoverpwd"><i class="fa fa-chevron-right"></i> Recover Password</a>';
										#echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/"><i class="fa fa-chevron-right"></i> Free Rewards</a>';
										echo '</div>';
										echo '</li>';
									}
									if(User::IsStaff()){
										echo '<li class="nav-item">';
											echo '<a class="nav-link" href="../../admin/">Staff Panel</a>';
										echo '</li>';
									}
									echo '<li class="nav-item">';
										echo '<a class="nav-link" href="'.DOC_ROOT.'/member/logout">Logout</a>';
									echo '</li>';
								}
						echo '</ul>';
					echo '</div>';
				echo '</nav>';
				}
			}elseif(Settings::$PageZone == "ACP"){
				echo '<nav class="navbar navbar-expand navbar-dark bg-dark acp-bg fixed-top">';
					echo '<a class="navbar-brand mr-1" href="../admin">
					<img class="img-responsive" src="assets/Themes/Basic/images/logos/shaiya.png" width="100" alt="Shaiya">
					</a>';
						echo '<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">';
							echo '<i class="fas fa-bars"></i>';
						echo '</button>';
							echo '<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">';
						echo '</form>';
						echo '<ul class="navbar-nav ml-auto ml-md-0">';
						if(!isset($_SESSION['UserID'])){
							echo '<a class="nav-link" href="'.DOC_ROOT.'/member/login"><i class="fas fa-sign-in-alt"></i> Login</a>';
						}
						echo '<li class="nav-item dropdown no-arrow">';
							 echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
								if(!isset($_SESSION['UserID'])){

								}else{
									#echo '<img class="img-fluid avatar-circle" src="assets/Themes/Standard/images/profile/avatars/'.$res['Avatar'].'" class="img-circle" alt="Avatar">';
									echo '<span> '.User::$UserLoginStatus.' </span>';
									echo '<i class="icon-submenu fas fa-chevron-down"></i>';
								}
							  echo '</a>';
								echo '<div class="dropdown-menu drop-acp-menu dropdown-menu-right" aria-labelledby="userDropdown">';
								if(!User::LoggedIn() || !isset($_SESSION['Status'])){
										echo '<a class="dropdown-item drop-acp-itm" style="color:#fff"><i class="fas fa-sign-in-alt"></i> Please Login</a>';
								}
								else{
									if(User::isStaff()){
										echo '<a class="dropdown-item drop-acp-itm" href="../admin/admin_profile">Profile</a>';
										echo '<a class="dropdown-item drop-acp-itm" href="../admin/admin_settings">Settings</a>';
									}
									echo '<a class="dropdown-item drop-acp-itm logout_form" href="'.DOC_ROOT.'/member/logout">Logout</a>';
								}
							echo '</div>';
						echo '</li>';
					echo '</ul>';
				echo '</nav>';
			}
		}
		public static function NavSide(){
			if(Settings::$PageZone == "Site"){
				if(Settings::$SiteTheme == 'shCMS'){
					echo '<div class="left-sidebar">';
						Plugins::$Mode	=	'left';
						Plugins::plugin_display();
					echo '</div>';

					echo '<div class="right-sidebar">';
						Plugins::$Mode	=	'right';
						Plugins::plugin_display();
					echo '</div>';
				}
			}elseif(Settings::$PageZone == "ACP"){
				echo '<ul class="sidebar navbar-nav">';
					echo '<li class="nav-item active">';
						echo '<a class="nav-link" href="../admin">';
						echo '<i class="fas fa-fw fa-tachometer-alt"></i>';
					echo '<span>Dashboard</span>';
						echo '</a>';
					echo '</li>';
					if(User::isAdmin()){
					self::_get_acp_nav_side_dd('Developer','Mail Test','MAIL_TEST','Tools','TOOLS',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
					/* Nav Function Ex
					$this->_get_acp_nav_side_dd($PageCat,$PageTitle=false,$PageLink=false,$PageTitle1=false,$PageLink1=false,$PageTitle2=false,$PageLink2=false,$PageTitle3=false,$PageLink3=false,$PageTitle4=false,$PageLink4=false,$PageTitle5=false,$PageLink5=false,$PageTitle6=false,$PageLink6=false,$PageTitle7=false,$PageLink7=false,$PageTitle8=false,$PageLink8=false,$PageTitle9=false,$PageLink9=false,$PageTitle10=false,$PageLink10=false,$PageTitle11=false,$PageLink11=false,$PageTitle12=false,$PageLink12=false,$PageTitle13=false,$PageLink13=false,$PageTitle14=false,$PageLink14=false,$PageTitle15=false,$PageLink15=false,$PageShow,$ReqLogin,$LinkIcon=false)
					*/
					self::_get_acp_nav_side_dd('Site','HP Editor','../admin/hpeditor','News Editor','../admin/newseditor','Patch Editor','../admin/patcheditor',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
					self::_get_acp_nav_side_dd('Admin','Access Logs','../admin/accesslogs','GM Commands Logs','../admin/gmcmds',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
					}
					if(User::AllGM()){
					self::_get_acp_nav_side_dd('Account','Account Ban','../admin/actban','Account Ban Search','../admin/actbansrch','Account DP Handout','../admin/actdphandout','Account Edit','../admin/actedit','Account IP Search','../admin/actipsrch','Account Search','../admin/actsrch','Account Unban','../admin/actunban',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
					self::_get_acp_nav_side_dd('Player','Edit Player','../admin/editplr','Item Deletion','../admin/itemdel','Item Edit','../admin/itemedit','Jail Account','../admin/jailacc','Player Chat Search','../admin/plrchatsrch','Restore Character','../admin/restorechar','Un-Jail Account','../admin/unjailacc','View Player Linked Gear','../admin/viewplrlinked','Warehouse Delete Items','../admin/whdel','Warehouse Edit Items','../admin/whedit',false,false,false,false,false,false,false,false,false,false,false,false,1,0);
					self::_get_acp_nav_side_dd('Misc','Disband Guild','../admin/disbandguild','Faction Change','../admin/factionchange','World Chat','../admin/worldchat','Guild Leader Change','../admin/glchange','Guild Name Change','../admin/gnchange','Guild Search','../admin/gldsrch','Item List','../admin/itemlst','Item Search','../admin/itmsrch','Mob List','../admin/moblist','Players Online','../admin/plrsonline','Possible Stat Padders','../admin/statpadders',false,false,false,false,false,false,false,false,false,false,1,0);
					self::_get_acp_nav_side_dd('SExtended','Send Notice','../admin/sendnotice','Send Player Notice','../admin/sendplrnotice',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
					}
					if(User::isStaff() && !User::AllGM()){
						self::_get_acp_nav_side_dd('GS','World Chat','/acp-wrld-chat','Players Online','GS_PL_ONLINE',false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,1,0);
					}
				echo '</ul>';
			}
		}
		public static function _get_nav_side_link($PageTitle,$PageLink,$PageShow,$ReqLogin,$LinkIcon=false){
			echo '<li class="nav-item active">';
				echo '<a href="'.DOC_ROOT.'/'.$PageLink.'" class="nav-link">';
				if($LinkIcon){
					echo $LinkIcon.' ';
				}
				echo $PageTitle.'</a>';
			echo '</li>';
		}
		public static function _get_nav_side_dd($PageTitle,$PageLink,$PageShow,$ReqLogin,$LinkIcon=false){
			echo '<li class="nav-item">';
			# Page Index
			echo '<li class="nav-item"><a href="'.DOC_ROOT.'/'.$PageLink.'" class="nav-link">';
			if($LinkIcon){
				echo $LinkIcon;
			}
			# Page Title
			echo $PageTitle.'</a>';
			echo '</li>';
		}
		public static function _get_acp_nav_side_dd($PageCat,$PageTitle=false,$PageLink=false,$PageTitle1=false,$PageLink1=false,$PageTitle2=false,$PageLink2=false,$PageTitle3=false,$PageLink3=false,$PageTitle4=false,$PageLink4=false,$PageTitle5=false,$PageLink5=false,$PageTitle6=false,$PageLink6=false,$PageTitle7=false,$PageLink7=false,$PageTitle8=false,$PageLink8=false,$PageTitle9=false,$PageLink9=false,$PageTitle10=false,$PageLink10=false,$PageTitle11=false,$PageLink11=false,$PageTitle12=false,$PageLink12=false,$PageTitle13=false,$PageLink13=false,$PageTitle14=false,$PageLink14=false,$PageTitle15=false,$PageLink15=false,$PageShow,$ReqLogin,$LinkIcon=false){
			$PageSub	=	$PageCat.' Tools';
				echo '<li class="nav-item dropdown">';
					echo '<a class="nav-link dropdown-toggle" href="#'.$PageSub.'" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
					echo '<i class="fas fa-fw fa-folder"></i>';
				echo '<span>'.$PageSub.'</span>';
					echo '</a>';
					echo '<div class="dropdown-menu drop-acp-menu" aria-labelledby="pagesDropdown">';
					if($PageTitle==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink.'">'.$PageTitle.'</a>';
					}
					if($PageTitle1==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink1.'">'.$PageTitle1.'</a>';
					}
					if($PageTitle2==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink2.'">'.$PageTitle2.'</a>';
					}
					if($PageTitle3==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink3.'">'.$PageTitle3.'</a>';
					}
					if($PageTitle4==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink4.'">'.$PageTitle4.'</a>';
					}
					if($PageTitle5==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink5.'">'.$PageTitle5.'</a>';
					}
					if($PageTitle6==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink6.'">'.$PageTitle6.'</a>';
					}
					if($PageTitle7==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink7.'">'.$PageTitle7.'</a>';
					}
					if($PageTitle8==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink8.'">'.$PageTitle8.'</a>';
					}
					if($PageTitle9==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink9.'">'.$PageTitle9.'</a>';
					}
					if($PageTitle10==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink10.'">'.$PageTitle10.'</a>';
					}
					if($PageTitle11==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink11.'">'.$PageTitle11.'</a>';
					}
					if($PageTitle12==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink12.'">'.$PageTitle12.'</a>';
					}
					if($PageTitle13==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink13.'">'.$PageTitle13.'</a>';
					}
					if($PageTitle14==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink14.'">'.$PageTitle14.'</a>';
					}
					if($PageTitle15==true){
						echo '<a class="dropdown-item drop-acp-itm" href="./'.$PageLink15.'">'.$PageTitle15.'</a>';
					}
					echo '</div>';
				echo '</li>';
		}
		public static function ds_nav_dropdown($PageCat,$PageTitle=false,$PageLink=false,$PageTitle1=false,$PageLink1=false,$PageTitle2=false,$PageLink2=false,$PageTitle3=false,$PageLink3=false,$PageTitle4=false,$PageLink4=false,$PageTitle5=false,$PageLink5=false,$PageTitle6=false,$PageLink6=false,$PageTitle7=false,$PageLink7=false,$PageTitle8=false,$PageLink8=false,$PageShow,$ReqLogin){
			echo '<li class="nav-item dropdown">';
				echo '<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="dropdown05" aria-haspopup="true" aria-expanded="false">'.$PageCat.'</a>';
					echo '<div class="dropdown-menu" aria-labelledby="dropdown05">';
				if($PageTitle==true){
					if($PageTitle=='Forum'){
						echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink.'" target="_blank"><i class="fa fa-chevron-right"></i> '.$PageTitle.'</a>';
					}
					else{
						echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink.'"><i class="fa fa-chevron-right"></i> '.$PageTitle.'</a>';
					}
				}
				if($PageTitle1==true){
				echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink1.'"><i class="fa fa-chevron-right"></i>'.$PageTitle1.'</a>';
				}
				if($PageTitle2==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink2.'"><i class="fa fa-chevron-right"></i>'.$PageTitle2.'</a>';
				}
				if($PageTitle3==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink3.'"><i class="fa fa-chevron-right"></i>'.$PageTitle3.'</a>';
				}
				if($PageTitle4==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink4.'"><i class="fa fa-chevron-right"></i>'.$PageTitle4.'</a>';
				}
				if($PageTitle5==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink5.'"><i class="fa fa-chevron-right"></i>'.$PageTitle5.'</a>';
				}
				if($PageTitle6==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink6.'"><i class="fa fa-chevron-right"></i>'.$PageTitle6.'</a>';
				}
				if($PageTitle7==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink7.'"><i class="fa fa-chevron-right"></i>'.$PageTitle7.'</a>';
				}
				if($PageTitle8==true){
					echo '<a class="dropdown-item dropdown-item-cms" href="'.DOC_ROOT.'/'.$PageLink8.'"><i class="fa fa-chevron-right"></i>'.$PageTitle8.'</a>';
				}
				echo '</div>';
			echo '</li>';
		}
	}
?>