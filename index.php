<?php
	# Initialize Session
	@session_start();
	@ob_start();
	# Set Home
	require_once($_SERVER['DOCUMENT_ROOT']."/assets/classes/Autoloader.class.php");
	# Load Core Dependencies
	$Browser		=	new Browser();
	$db				=	new Database();
	$Dirs			=	new Dirs();
	$Select			=	new Select();
	$Modal			=	new Modal();
	$Parser			=	new Parser();
	$PHP			=	new PHP();
	$Readable		=	new Readable();
	$Tpl			=	new Template();

	# Mass Dependencies
	$pagingHelper	=	new PagingHelper($pagingData=false);
	$BossRecord		=	new BossRecord($db);
	$GuildRanking	=	new GuildRanking($db);
	$Data			=	new Data($db);
	$GlobChat 		= 	new GlobChat($db);
	$LogSys			=	new LogSys($db);
	$Panels			=	new Panels($db);
	$Rank_DAO		=	new Rank_DAO($Data,$db,$pagingHelper);
	$Setting		=	new Setting($Data,$db,$Tpl);
	$Style			=	new Style($db);
	$User			=	new User($Browser,$Data,$db,$Setting,$Tpl);
	$SQL			=	new SQL($Data,$db,$Setting,$Tpl,$User);
	$Paging			=	new Paging($db,$Setting);
	$Plugins		=	new Plugins($db,$Dirs,$Modal,$SQL,$Tpl,$Setting,$User,$BossRecord,$GuildRanking);
	$Nav			=	new Nav($db,$Paging,$Plugins,$Setting,$Tpl,$User);
	$Session		=	new Session($db,$Browser,$Setting,$User);
	$Content		=	new Content($BossRecord,$GuildRanking,$Browser,$Data,$db,$GlobChat,$Dirs,$LogSys,$Modal,$Nav,$Paging,$Panels,$PHP,$Plugins,$Rank_DAO,$Readable,$Select,$Session,$Setting,$SQL,$Style,$Tpl,$User);
	$Display		=	new Display($Content,$Data,$db,$GlobChat,$Nav,$Paging,$Panels,$Session,$Setting,$Style,$Tpl,$User);

	# Load Display
	$Paging->LaunchPageLoader();
	$Display->LaunchDisplay();
#	$User->Props();
#	$Paging->Props();
#	$Setting->Props();
#	$Content->Props();
#	$Style->Props();
#	$Display->Props();
#	$User->Props();
?>
