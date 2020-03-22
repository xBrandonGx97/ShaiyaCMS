<?php
	class Paging{

		public $PAGE_CAT;
		public $PAGE_TITLE;
		public $PAGE_SUB;
		public $PAGE_URI;
		public $PAGE_INDEX;
		public $PAGE;
		public $PAGE_ZONE;
		public $PAGE_LINK;
		public $PAGE_SHOW;

		public $data = [

			[
				'title'       => 'test1',
				'url'  		  => 'linkhere1'
			],
	
			[
				'title'       => 'test2',
				'url'  		  => 'linkhere2'
			],
	
			[
				'title'       => 'test3',
				'url'  		  => 'linkhere3'
			],
	
			[
				'title'       => 'test4',
				'url'  		  => 'linkhere4'
			],
	
			[
				'title'       => 'test5',
				'url'  		  => 'linkhere5'
			],
		];
		

		function __construct($db,$Setting){
			$this->db		=	$db;
			$this->Setting	=	$Setting;
		}

		
		function LaunchPageLoader(){
			if($_SERVER["REQUEST_URI"] === "/" || $_SERVER["REQUEST_URI"] === "" || $_SERVER["REQUEST_URI"] === "/acp/"){
				$this->PAGE_LINK	=	"HOME";
			}
			else{
				$this->PAGE_LINK	=	isset($_GET[$this->Setting->PAGE_PREFIX]) ? $_GET[$this->Setting->PAGE_PREFIX] : false;
			}

			$_SESSION["RequestedPage"] = $this->PAGE_LINK;

					$array_pages = array(
						# CMS
						'HOME'=>'assets/content/cms/main/home.php',
						# Session
						'REGISTER'=>'assets/content/cms/auth/register.php',
						'AUTH'=>'assets/content/cms/auth/login.php',
						'LOGOUT'=>'assets/content/cms/auth/logout.php',
						'VALIDATE'=>'assets/content/cms/auth/validate.php',
						# Server Info
						'ABOUT'=>'assets/content/cms/info/about.php',
						'DOWNLOAD'=>'assets/content/cms/info/download.php',
						'NEWS'=>'assets/content/cms/info/news.php',
						'PATCH'=>'assets/content/cms/info/patchnotes.php',
						'TERMS'=>'assets/content/cms/info/terms.php',
						'DROPFINDER'=>'assets/content/cms/info/dropfinder.php',
						'PVP'=>'assets/content/cms/info/pvp/pvp.php',
						'PVP_V2'=>'assets/content/cms/info/pvp/pvp_v2.php',
						'RANK_CONTROLLER'=>'assets/content/cms/info/pvp/rank.controller.php',
						'BOSS_RECORDS'=>'assets/content/cms/info/bossrecords.php',
						'GUILD_RANK'=>'assets/content/cms/info/guildrankings.php',
						# Member
						'PROFILE'=>'assets/content/cms/member/profile.php',
						'MESSAGES'=>'assets/content/cms/member/messages.php',
						'PVP_RWRDS'=>'assets/content/cms/member/pvprewards.php',
						'RCVR_PW'=>'assets/content/cms/member/recoverpass.php',
						# ACP
						'DASHBOARD'=>'assets/content/acp/main/home.php',
						# Developer Tools
						'TOOLS'=>'assets/content/acp/main/tools.php',
						'MAIL_TEST'=>'assets/content/acp/developer/acp_test_email.php',
						# Site Tools
						'HP_EDITOR'=>'assets/content/acp/site/hp.php',
						'NEWS_EDITOR'=>'assets/content/acp/site/news.php',
						'PATCH_NOTES_EDITOR'=>'assets/content/acp/site/patchnotes.php',
						# Admin Tools
						'ADM_ACCSS_LOG'=>'assets/content/acp/admin/pnl_log.php',
						'ADM_CMD_LOG'=>'assets/content/acp/admin/gmcomsrch.php',
						# Account Tools
						'ACCT_SEARCH'=>'assets/content/acp/account/account_search.php',
						'ACCT_BAN'=>'assets/content/acp/account/ban_account.php',
						'ACCT_BAN_SEARCH'=>'assets/content/acp/account/bansearch.php',
						'ACCT_UNBAN'=>'assets/content/acp/account/unban_account.php',
						'ACCT_EDIT'=>'assets/content/acp/account/account_edit.php',
						'ACCT_IP_SRCH'=>'assets/content/acp/account/acc_ip_search.php',
						'ACCT_GV_DP'=>'assets/content/acp/account/acc_dp_handout.php',
						# Player Tools
						'PLR_EDIT'=>'assets/content/acp/player/pl_stat_edit.php',
						'PLR_LNKED_GR'=>'assets/content/acp/player/pl_item_view.php',
						'PLR_RES'=>'assets/content/acp/player/pl_um_res.php',
						'PLR_ITM_EDIT'=>'assets/content/acp/player/item_edit.php',
						'PLR_ITM_DEL'=>'assets/content/acp/player/item_delete.php',
						'PLR_WH_EDIT'=>'assets/content/acp/player/wh_edit.php',
						'PLR_WH_DEL'=>'assets/content/acp/player/wh_delete.php',
						'PLR_JAIL'=>'assets/content/acp/player/jail.php',
						'PLR_UNJAIL'=>'assets/content/acp/player/unjail.php',
						'PLR_CHAT_SRCH'=>'assets/content/acp/player/chat_search.php',
						# Misc Tools
						'MISC_GL_DISBND'=>'assets/content/acp/misc/disband_guild.php',
						'MISC_GL_CHNG'=>'assets/content/acp/misc/guild_leader_change.php',
						'MISC_GL_SRCH'=>'assets/content/acp/misc/guild_search.php',
						'MISC_GL_NM_CHNG'=>'assets/content/acp/misc/guild_name_change.php',
						'MISC_PL_ONLINE'=>'assets/content/acp/misc/login_status.php',
						'MISC_GLOB_CHAT'=>'assets/content/acp/misc/global_chat.php',
						'MISC_ITM_LST'=>'assets/content/acp/misc/itemlist.php',
						'MISC_MOB_LST'=>'assets/content/acp/misc/moblist.php',
						'MISC_ITM_SRCH'=>'assets/content/acp/misc/itemsearch.php',
						'MISC_STAT_PADDERS'=>'assets/content/acp/misc/stat_padders.php',
						'MISC_FC'=>'assets/content/acp/misc/fc.php',
						# GS Tools
						'GS_ACC_SM_IP'=>'assets/content/acp/account/acc_ip_search.php',
						'GS_PL_ONLINE'=>'assets/content/acp/misc/login_status.php',
						'GS_GLB_CHT'=>'assets/content/acp/misc/global_chat.php',
						'GS_STAT_PADDERS'=>'assets/content/acp/misc/stat_padders.php',
						'GS_PL_JAIL'=>'assets/content/acp/player/jail.php',
						'GS_PL_UNJAIL'=>'assets/content/acp/player/unjail.php',
						# Session
						'INDEX1'=>'assets/content/acp/session/login.php',
						'LOGIN1'=>'assets/content/acp/session/login.php',
						'LOGOUT1'=>'assets/content/acp/session/logout.php',
						'SESSION_END1'=>'assets/content/acp/session/c-sess.php',
						'SESSION_CLOSE1'=>'assets/content/acp/session/term_sess.php',
						# Member
						'USER_PROFILE'=>'assets/content/acp/profile/profile.php',
						'USER_STNGS'=>'assets/content/acp/profile/settings.php',
					);
					# Set Page Information
					$this->LaunchPageInfo();

			if(!array_key_exists($this->PAGE_LINK,$array_pages)){
				$this->PAGE				=	"assets/content/cms/main/error.php";
			}
			elseif(!is_file($array_pages[$this->PAGE_LINK])){
				$this->PAGE				=	"assets/content/cms/main/error.php";
			}
			else{
				$this->PAGE				=	$array_pages[$this->PAGE_LINK];
			}
		}
		function LaunchPageInfo(){
			# CMS
			if($this->PAGE_LINK=='HOME'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Home';
				$this->PAGE_TITLE		= 'Home';
				$this->PAGE_URI			= 'assets/content/cms/main/home.php';
				$this->PAGE_INDEX		= 'HOME';
				$this->PAGE_SUB			= '';
			}
			# Session
			if($this->PAGE_LINK=='INDEX'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Index';
				$this->PAGE_URI			= 'assets/content/cms/auth/login.php';
				$this->PAGE_INDEX		= 'INDEX';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='REGISTER'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Register';
				$this->PAGE_URI			= 'assets/content/cms/auth/register.php';
				$this->PAGE_INDEX		= 'REGISTER';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='AUTH'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Login';
				$this->PAGE_URI			= 'assets/content/cms/auth/login.php';
				$this->PAGE_INDEX		= 'AUTH';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='LOGOUT'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Logout';
				$this->PAGE_URI			= 'aassets/content/cms/auth/logout.php';
				$this->PAGE_INDEX		= 'LOGOUT';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='VALIDATE'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Auth';
				$this->PAGE_URI			= 'assets/content/cms/auth/validate.php';
				$this->PAGE_INDEX		= 'VALIDATE';
				$this->PAGE_SUB			= '';
			}
			# Server Information
			if($this->PAGE_LINK=='ABOUT'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'About';
				$this->PAGE_URI			= 'assets/content/cms/info/about.php';
				$this->PAGE_INDEX		= 'ABOUT';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='DOWNLOAD'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'Download';
				$this->PAGE_URI			= 'assets/content/cms/info/download.php';
				$this->PAGE_INDEX		= 'DOWNLOAD';
				$this->PAGE_SUB			= '';
				$this->PAGE_SHOW		= true;
			}
			if($this->PAGE_LINK=='NEWS'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'News';
				$this->PAGE_URI			= 'assets/content/cms/info/news.php';
				$this->PAGE_INDEX		= 'NEWS';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='PATCH'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'Patch Notes';
				$this->PAGE_URI			= 'assets/content/cms/info/patchnotes.php';
				$this->PAGE_INDEX		= 'PATCH';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='TERMS'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'Terms of Service';
				$this->PAGE_URI			= 'assets/content/cms/info/terms.php';
				$this->PAGE_INDEX		= 'TERMS';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='DROPFINDER'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'Drop Finder';
				$this->PAGE_URI			= 'assets/content/cms/info/dropfinder.php';
				$this->PAGE_INDEX		= 'DROPFINDER';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='PVP'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'PvP Rankings';
				$this->PAGE_URI			= 'assets/content/cms/info/pvp/pvp.php';
				$this->PAGE_INDEX		= 'PVP';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='PVP_V2'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'PvP Rankings';
				$this->PAGE_URI			= 'assets/content/cms/info/pvp/pvp_v2.php';
				$this->PAGE_INDEX		= 'PVP_V2';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='RANK_CONTROLLER'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'PvP Rankings';
				$this->PAGE_URI			= 'assets/content/cms/info/pvp/rank.controller.php';
				$this->PAGE_INDEX		= 'RANK_CONTROLLER';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='BOSS_RECORDS'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'Boss Records';
				$this->PAGE_URI			= 'assets/content/cms/info/bossrecords.php';
				$this->PAGE_INDEX		= 'BOSS_RECORDS';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='GUILD_RANK'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Server Information';
				$this->PAGE_TITLE		= 'Guild Rankings';
				$this->PAGE_URI			= 'assets/content/cms/info/guildrankings.php';
				$this->PAGE_INDEX		= 'GUILD_RANK';
				$this->PAGE_SUB			= '';
			}
			# Member
			if($this->PAGE_LINK=='PROFILE'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Member';
				$this->PAGE_TITLE		= 'User Profile';
				$this->PAGE_URI			= 'assets/content/cms/member/profile.php';
				$this->PAGE_INDEX		= 'PROFILE';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='MESSAGES'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Member';
				$this->PAGE_TITLE		= 'Messages';
				$this->PAGE_URI			= 'assets/content/cms/member/messages.php';
				$this->PAGE_INDEX		= 'MESSAGES';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='PVP_RWRDS'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Member';
				$this->PAGE_TITLE		= 'PvP Rewards';
				$this->PAGE_URI			= 'assets/content/cms/member/pvprewards.php';
				$this->PAGE_INDEX		= 'PVP_RWRDS';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='RCVR_PW'){
				$this->PAGE_ZONE 		= 'CMS';
				$this->PAGE_CAT			= 'Member';
				$this->PAGE_TITLE		= 'Recover Password';
				$this->PAGE_URI			= 'assets/content/cms/member/recoverpass.php';
				$this->PAGE_INDEX		= 'RCVR_PW';
				$this->PAGE_SUB			= '';
			}
			# ACP
			if($this->PAGE_LINK=='DASHBOARD'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Dashboard';
				$this->PAGE_TITLE		= 'Dashboard';
				$this->PAGE_URI			= 'assets/content/acp/main/home.php';
				$this->PAGE_INDEX		= 'DASHBOARD';
				$this->PAGE_SUB			= '';
			}
			# Developer Tools
			if($this->PAGE_LINK=='TOOLS'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Developer';
				$this->PAGE_TITLE		= 'Tools';
				$this->PAGE_URI			= 'assets/content/acp/main/tools.php';
				$this->PAGE_INDEX		= 'TOOLS';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='MAIL_TEST'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Developer';
				$this->PAGE_TITLE		= 'Mail Test';
				$this->PAGE_URI			= 'assets/content/acp/developer/acp_test_email.php';
				$this->PAGE_INDEX		= 'MAIL_TEST';
				$this->PAGE_SUB			= '';
			}
			# Site Tools
			if($this->PAGE_LINK=='HP_EDITOR'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Site';
				$this->PAGE_TITLE		= 'HP Editor';
				$this->PAGE_URI			= 'assets/content/acp/site/hp.php';
				$this->PAGE_INDEX		= 'HP_EDITOR';
				$this->PAGE_SUB			= 'ACP Tools';
			}
			if($this->PAGE_LINK=='NEWS_EDITOR'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Site';
				$this->PAGE_TITLE		= 'News Editor';
				$this->PAGE_URI			= 'assets/content/acp/site/news.php';
				$this->PAGE_INDEX		= 'NEWS_EDITOR';
				$this->PAGE_SUB			= 'ACP Tools';
			}
			if($this->PAGE_LINK=='PATCH_NOTES_EDITOR'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Site';
				$this->PAGE_TITLE		= 'Patch Editor';
				$this->PAGE_URI			= 'assets/content/acp/site/patchnotes.php';
				$this->PAGE_INDEX		= 'PATCH_NOTES_EDITOR';
				$this->PAGE_SUB			= 'ACP Tools';
			}
			# Admin Tools
			if($this->PAGE_LINK=='ADM_ACCSS_LOG'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Admin';
				$this->PAGE_TITLE		= 'Access Log';
				$this->PAGE_URI			= 'assets/content/acp/admin/pnl_log.php';
				$this->PAGE_INDEX		= 'ADM_ACCSS_LOG';
				$this->PAGE_SUB			= 'Admin Tools';
			}
			if($this->PAGE_LINK=='ADM_CMD_LOG'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Admin';
				$this->PAGE_TITLE		= 'GM Commands Log';
				$this->PAGE_URI			= 'assets/content/acp/admin/gmcomsrch.php';
				$this->PAGE_INDEX		= 'ADM_CMD_LOG';
				$this->PAGE_SUB			= 'Admin Tools';
			}
			# Account Tools
			if($this->PAGE_LINK=='ACCT_SEARCH'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Account';
				$this->PAGE_TITLE		= 'Account Search';
				$this->PAGE_URI			= 'assets/content/acp/account/account_search.php';
				$this->PAGE_INDEX		= 'ACCT_SEARCH';
				$this->PAGE_SUB			= 'Account Tools';
			}
			if($this->PAGE_LINK=='ACCT_BAN'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Account';
				$this->PAGE_TITLE		= 'Account Ban';
				$this->PAGE_URI			= 'assets/content/acp/account/ban_account.php';
				$this->PAGE_INDEX		= 'ACCT_BAN';
				$this->PAGE_SUB			= 'Account Tools';
			}
			if($this->PAGE_LINK=='ACCT_BAN_SEARCH'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Account';
				$this->PAGE_TITLE		= 'Account Ban Search';
				$this->PAGE_URI			= 'assets/content/acp/account/bansearch.php';
				$this->PAGE_INDEX		= 'ACCT_BAN_SEARCH';
				$this->PAGE_SUB			= 'Account Tools';
			}
			if($this->PAGE_LINK=='ACCT_UNBAN'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Account';
				$this->PAGE_TITLE		= 'Account Unban';
				$this->PAGE_URI			= 'assets/content/acp/account/unban_account.php';
				$this->PAGE_INDEX		= 'ACCT_UNBAN';
				$this->PAGE_SUB			= 'Account Tools';
			}
			if($this->PAGE_LINK=='ACCT_EDIT'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Account';
				$this->PAGE_TITLE		= 'Account Edit';
				$this->PAGE_URI			= 'assets/content/acp/account/account_edit.php';
				$this->PAGE_INDEX		= 'ACCT_EDIT';
				$this->PAGE_SUB			= 'Account Tools';
			}
			if($this->PAGE_LINK=='ACCT_IP_SRCH'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Account';
				$this->PAGE_TITLE		= 'Account IP Search';
				$this->PAGE_URI			= 'assets/content/acp/account/acc_ip_search.php';
				$this->PAGE_INDEX		= 'ACCT_IP_SRCH';
				$this->PAGE_SUB			= 'Account Tools';
			}
			if($this->PAGE_LINK=='ACCT_GV_DP'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Account';
				$this->PAGE_TITLE		= 'Account DP Handout';
				$this->PAGE_URI			= 'assets/content/acp/account/acc_dp_handout.php';
				$this->PAGE_INDEX		= 'ACCT_GV_DP';
				$this->PAGE_SUB			= 'Account Tools';
			}
			# Player
			if($this->PAGE_LINK=='PLR_EDIT'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Edit Player';
				$this->PAGE_URI			= 'assets/content/acp/player/pl_stat_edit.php';
				$this->PAGE_INDEX		= 'PLR_EDIT';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_LNKED_GR'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'View Player Linked Gear';
				$this->PAGE_URI			= 'assets/content/acp/player/pl_item_view.php';
				$this->PAGE_INDEX		= 'PLR_LNKED_GR';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_RES'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Restore Character';
				$this->PAGE_URI			= 'assets/content/acp/player/pl_um_res.php';
				$this->PAGE_INDEX		= 'PLR_RES';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_ITM_EDIT'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Item Edit';
				$this->PAGE_URI			= 'assets/content/acp/player/item_edit.php';
				$this->PAGE_INDEX		= 'PLR_ITM_EDIT';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_ITM_DEL'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Item Deletion';
				$this->PAGE_URI			= 'assets/content/acp/player/item_delete.php';
				$this->PAGE_INDEX		= 'PLR_ITM_DEL';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_WH_EDIT'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Warehouse Edit Items';
				$this->PAGE_URI			= 'assets/content/acp/player/wh_edit.php';
				$this->PAGE_INDEX		= 'PLR_WH_EDIT';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_WH_DEL'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Warehouse Delete Items';
				$this->PAGE_URI			= 'assets/content/acp/player/wh_delete.php';
				$this->PAGE_INDEX		= 'PLR_WH_DEL';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_JAIL'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Jail Account';
				$this->PAGE_URI			= 'assets/content/acp/player/jail.php';
				$this->PAGE_INDEX		= 'PLR_JAIL';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_UNJAIL'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Un-Jail Account';
				$this->PAGE_URI			= 'assets/content/acp/player/unjail.php';
				$this->PAGE_INDEX		= 'PLR_UNJAIL';
				$this->PAGE_SUB			= 'Player Tools';
			}
			if($this->PAGE_LINK=='PLR_CHAT_SRCH'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Player';
				$this->PAGE_TITLE		= 'Player Chat Search';
				$this->PAGE_URI			= 'assets/content/acp/player/chat_search.php';
				$this->PAGE_INDEX		= 'PLR_CHAT_SRCH';
				$this->PAGE_SUB			= 'Player Tools';
			}
			# Misc Tools
			if($this->PAGE_LINK=='MISC_GL_DISBND'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Disband Guild';
				$this->PAGE_URI			= 'assets/content/acp/misc/disband_guild.php';
				$this->PAGE_INDEX		= 'MISC_GL_DISBND';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_GL_CHNG'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Guild Leader Change';
				$this->PAGE_URI			= 'assets/content/acp/misc/guild_leader_change.php';
				$this->PAGE_INDEX		= 'MISC_GL_CHNG';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_GL_SRCH'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Guild Search';
				$this->PAGE_URI			= 'assets/content/acp/misc/guild_search.php';
				$this->PAGE_INDEX		= 'MISC_GL_SRCH';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_GL_NM_CHNG'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Guild Name Change';
				$this->PAGE_URI			= 'assets/content/acp/misc/guild_name_change.php';
				$this->PAGE_INDEX		= 'MISC_GL_NM_CHNG';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_PL_ONLINE'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Players Online';
				$this->PAGE_URI			= 'assets/content/acp/misc/login_status.php';
				$this->PAGE_INDEX		= 'MISC_PL_ONLINE';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_GLOB_CHAT'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Global Chat';
				$this->PAGE_URI			= 'assets/content/acp/misc/global_chat.php';
				$this->PAGE_INDEX		= 'MISC_GLOB_CHAT';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_ITM_LST'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Item List';
				$this->PAGE_URI			= 'assets/content/acp/misc/itemlist.php';
				$this->PAGE_INDEX		= 'MISC_ITM_LST';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_MOB_LST'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Mob List';
				$this->PAGE_URI			= 'assets/content/acp/misc/moblist.php';
				$this->PAGE_INDEX		= 'MISC_MOB_LST';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_ITM_SRCH'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Item Search';
				$this->PAGE_URI			= 'assets/content/acp/misc/itemsearch.php';
				$this->PAGE_INDEX		= 'MISC_ITM_SRCH';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_STAT_PADDERS'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Possible Stat Padders';
				$this->PAGE_URI			= 'assets/content/acp/misc/stat_padders.php';
				$this->PAGE_INDEX		= 'MISC_STAT_PADDERS';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			if($this->PAGE_LINK=='MISC_FC'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Misc';
				$this->PAGE_TITLE		= 'Faction Change';
				$this->PAGE_URI			= 'assets/content/acp/misc/fc.php';
				$this->PAGE_INDEX		= 'MISC_FC';
				$this->PAGE_SUB			= 'Misc Tools';
			}
			# GS Tools
			if($this->PAGE_LINK=='GS_ACC_SM_IP'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'GS';
				$this->PAGE_TITLE		= 'Accounts With Same IP';
				$this->PAGE_URI			= 'assets/content/acp/account/acc_ip_search.php';
				$this->PAGE_INDEX		= 'GS_ACC_SM_IP';
				$this->PAGE_SUB			= 'GS Tools';
			}
			if($this->PAGE_LINK=='GS_PL_ONLINE'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'GS';
				$this->PAGE_TITLE		= 'Players Online';
				$this->PAGE_URI			= 'assets/content/acp/misc/login_status.php';
				$this->PAGE_INDEX		= 'GS_PL_ONLINE';
				$this->PAGE_SUB			= 'GS Tools';
			}
			if($this->PAGE_LINK=='GS_GLB_CHT'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'GS';
				$this->PAGE_TITLE		= 'Global Chat';
				$this->PAGE_URI			= 'assets/content/acp/misc/global_chat.php';
				$this->PAGE_INDEX		= 'GS_GLB_CHT';
				$this->PAGE_SUB			= 'GS Tools';
			}
			if($this->PAGE_LINK=='GS_STAT_PADDERS'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'GS';
				$this->PAGE_TITLE		= 'Possible Stat Padders';
				$this->PAGE_URI			= 'assets/content/acp/misc/stat_padders.php';
				$this->PAGE_INDEX		= 'GS_STAT_PADDERS';
				$this->PAGE_SUB			= 'GS Tools';
			}
			if($this->PAGE_LINK=='GS_PL_JAIL'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'GS';
				$this->PAGE_TITLE		= 'Jail Account';
				$this->PAGE_URI			= 'assets/content/acp/player/jail.php';
				$this->PAGE_INDEX		= 'GS_PL_JAIL';
				$this->PAGE_SUB			= 'GS Tools';
			}
			if($this->PAGE_LINK=='GS_PL_UNJAIL'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'GS';
				$this->PAGE_TITLE		= 'Un-Jail Account';
				$this->PAGE_URI			= 'assets/content/acp/player/unjail.php';
				$this->PAGE_INDEX		= 'GS_PL_UNJAIL';
				$this->PAGE_SUB			= 'GS Tools';
			}
			# Session
			if($this->PAGE_LINK=='INDEX1'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Index';
				$this->PAGE_URI			= 'assets/content/acp/session/login.php';
				$this->PAGE_INDEX		= 'INDEX1';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='LOGIN1'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Login';
				$this->PAGE_URI			= 'assets/content/acp/session/login.php';
				$this->PAGE_INDEX		= 'LOGIN1';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='LOGOUT1'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Logout';
				$this->PAGE_URI			= 'assets/content/acp/session/logout.php';
				$this->PAGE_INDEX		= 'LOGOUT1';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='SESSION_END1'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Session Ended';
				$this->PAGE_URI			= 'assets/content/acp/session/c-sess.php';
				$this->PAGE_INDEX		= 'SESSION_END1';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='SESSION_CLOSE1'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Session Ended';
				$this->PAGE_URI			= 'assets/content/acp/session/term_sess.php';
				$this->PAGE_INDEX		= 'SESSION_CLOSE1';
				$this->PAGE_SUB			= '';
			}
			if($this->PAGE_LINK=='ACP_VALIDATE1'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Session';
				$this->PAGE_TITLE		= 'Auth';
				$this->PAGE_URI			= 'assets/content/acp/session/validate.php';
				$this->PAGE_INDEX		= 'ACP_VALIDATE1';
				$this->PAGE_SUB			= '';
			}
			# Member
			if($this->PAGE_LINK=='USER_PROFILE'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Member';
				$this->PAGE_TITLE		= 'Profile';
				$this->PAGE_URI			= 'assets/content/acp/profile/profile.php';
				$this->PAGE_INDEX		= 'USER_PROFILE';
				$this->PAGE_SUB			= 'Member';
			}
			if($this->PAGE_LINK=='USER_STNGS'){
				$this->PAGE_ZONE 		= 'ACP';
				$this->PAGE_CAT			= 'Member';
				$this->PAGE_TITLE		= 'Settings';
				$this->PAGE_URI			= 'assets/content/acp/profile/settings.php';
				$this->PAGE_INDEX		= 'USER_STNGS';
				$this->PAGE_SUB			= 'Member';
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