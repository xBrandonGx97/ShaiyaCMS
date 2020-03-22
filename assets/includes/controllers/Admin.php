<?php
	Class Admin Extends Controller{
		public function index(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Admin';
			Settings::$PageIndex	=	'admin';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/index');
			echo '</div>';
			Content::initFooter();
		}
		# Site Tools
		public function hpeditor(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'HP Editor';
			Settings::$PageIndex	=	'hpeditor';
			Settings::$PageCat		=	'Site Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Site/hpeditor');
			echo '</div>';
			Content::initFooter();
		}
		public function newseditor(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'News Editor';
			Settings::$PageIndex	=	'newseditor';
			Settings::$PageCat		=	'Site Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Site/newseditor');
			echo '</div>';
			Content::initFooter();
		}
		public function patcheditor(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Patch Editor';
			Settings::$PageIndex	=	'patcheditor';
			Settings::$PageCat		=	'Site Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Site/patcheditor');
			echo '</div>';
			Content::initFooter();
		}
		# Admin Tools
		public function accesslogs(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Access Logs';
			Settings::$PageIndex	=	'accesslogs';
			Settings::$PageCat		=	'Admin Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Admin/accesslogs');
			echo '</div>';
			Content::initFooter();
		}
		public function gmcmds(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'GM Commands';
			Settings::$PageIndex	=	'gmcmds';
			Settings::$PageCat		=	'Admin Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Admin/gmcmds');
			echo '</div>';
			Content::initFooter();
		}
		# Account Tools
		public function actban(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Account Ban';
			Settings::$PageIndex	=	'actban';
			Settings::$PageCat		=	'Account Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Account/accountban');
			echo '</div>';
			Content::initFooter();
		}
		public function actbansrch(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Account Ban Search';
			Settings::$PageIndex	=	'actbansrch';
			Settings::$PageCat		=	'Account Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Account/actbansrch');
			echo '</div>';
			Content::initFooter();
		}
		public function actdphandout(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Account DP Handout';
			Settings::$PageIndex	=	'actdphandout';
			Settings::$PageCat		=	'Account Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Account/actdphandout');
			echo '</div>';
			Content::initFooter();
		}
		public function actedit(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Account Edit';
			Settings::$PageIndex	=	'actedit';
			Settings::$PageCat		=	'Account Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Account/actedit');
			echo '</div>';
			Content::initFooter();
		}
		public function actipsrch(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Account IP Search';
			Settings::$PageIndex	=	'actipsrch';
			Settings::$PageCat		=	'Account Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Account/actipsrch');
			echo '</div>';
			Content::initFooter();
		}
		public function actsrch(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Account Search';
			Settings::$PageIndex	=	'actsrch';
			Settings::$PageCat		=	'Account Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Account/actsrch');
			echo '</div>';
			Content::initFooter();
		}
		public function actunban(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Account Unban';
			Settings::$PageIndex	=	'actunban';
			Settings::$PageCat		=	'Account Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Account/actunban');
			echo '</div>';
			Content::initFooter();
		}
		# Player Tools
		public function editplr(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Edit Player';
			Settings::$PageIndex	=	'editplr';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/editplr');
			echo '</div>';
			Content::initFooter();
		}
		public function itemdel(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Item Delete';
			Settings::$PageIndex	=	'itemdel';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/itemdel');
			echo '</div>';
			Content::initFooter();
		}
		public function itemedit(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Item Edit';
			Settings::$PageIndex	=	'itemedit';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/itemedit');
			echo '</div>';
			Content::initFooter();
		}
		public function jailacc(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Jail Account';
			Settings::$PageIndex	=	'jailacc';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/jailacc');
			echo '</div>';
			Content::initFooter();
		}
		public function plrchatsrch(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Player Chat Search';
			Settings::$PageIndex	=	'plrchatsrch';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/plrchatsrch');
			echo '</div>';
			Content::initFooter();
		}
		public function restorechar(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Restore Char';
			Settings::$PageIndex	=	'restorechar';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/restorechar');
			echo '</div>';
			Content::initFooter();
		}
		public function unjailacc(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Unjail Account';
			Settings::$PageIndex	=	'unjailacc';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/unjailacc');
			echo '</div>';
			Content::initFooter();
		}
		public function viewplrlinked(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'View Player Linked Gear';
			Settings::$PageIndex	=	'viewplrlinked';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/viewplrlinked');
			echo '</div>';
			Content::initFooter();
		}
		public function whdel(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Warehouse Delete Items';
			Settings::$PageIndex	=	'whdel';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/whdel');
			echo '</div>';
			Content::initFooter();
		}
		public function whedit(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Warehouse Edit Items';
			Settings::$PageIndex	=	'whedit';
			Settings::$PageCat		=	'Player Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Player/whedit');
			echo '</div>';
			Content::initFooter();
		}
		# Misc Tools
		public function disbandguild(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Disband Guild';
			Settings::$PageIndex	=	'disbandguild';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/disbandguild');
			echo '</div>';
			Content::initFooter();
		}
		public function factionchange(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Faction Change';
			Settings::$PageIndex	=	'factionchange';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/factionchange');
			echo '</div>';
			Content::initFooter();
		}
		public function glchange(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Guild Leader Change';
			Settings::$PageIndex	=	'glchange';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/glchange');
			echo '</div>';
			Content::initFooter();
		}
		public function gldsrch(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Guild Search';
			Settings::$PageIndex	=	'gldsrch';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/gldsrch');
			echo '</div>';
			Content::initFooter();
		}
		public function gnchange(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Guild Name Change';
			Settings::$PageIndex	=	'gnchange';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/gnchange');
			echo '</div>';
			Content::initFooter();
		}
		public function itemlst(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Item List';
			Settings::$PageIndex	=	'itemlst';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/itemlst');
			echo '</div>';
			Content::initFooter();
		}
		public function itmsrch(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Item Search';
			Settings::$PageIndex	=	'itmsrch';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/itmsrch');
			echo '</div>';
			Content::initFooter();
		}
		public function moblist(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Mob List';
			Settings::$PageIndex	=	'moblist';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/moblist');
			echo '</div>';
			Content::initFooter();
		}
		public function plrsonline(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Players Online';
			Settings::$PageIndex	=	'plrsonline';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/plrsonline');
			echo '</div>';
			Content::initFooter();
		}
		public function statpadders(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Stat padders';
			Settings::$PageIndex	=	'statpadders';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/statpadders');
			echo '</div>';
			Content::initFooter();
		}
		public function worldchat(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'World Chat';
			Settings::$PageIndex	=	'worldchat';
			Settings::$PageCat		=	'Misc Tools';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Misc/worldchat');
			echo '</div>';
			Content::initFooter();
		}
		# Profile
		public function admin_profile(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Profile';
			Settings::$PageIndex	=	'admin_profile';
			Settings::$PageCat		=	'Profile';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Profile/profile');
			echo '</div>';
			Content::initFooter();
		}
		public function admin_settings(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Settings';
			Settings::$PageIndex	=	'admin_settings';
			Settings::$PageCat		=	'Profile';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/Profile/settings');
			echo '</div>';
			Content::initFooter();
		}
		# SExtended Tools
		public function sendnotice(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Send Notice';
			Settings::$PageIndex	=	'sendnotice';
			Settings::$PageCat		=	'SExtended';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/SExtended/sendnotice');
			echo '</div>';
			Content::initFooter();
		}
		public function sendplrnotice(){
			Settings::$PageZone 	= 	'ACP';
			Settings::$PageTitle 	= 	'Send Player Notice';
			Settings::$PageIndex	=	'sendplrnotice';
			Settings::$PageCat		=	'SExtended';
			Display::launchDisplay();
			Content::initContent();
			$this->view('admin/SExtended/sendplrnotice');
			echo '</div>';
			Content::initFooter();
		}
	}
?>