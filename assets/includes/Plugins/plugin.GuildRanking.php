<?php
	# Plugin Information
	$PluginName			=	"GuildRanking";
	$PluginMasterFile	=	"plugin.GuildRanking.php";
	$PluginPHP			=	"GuildRanking.php";
	$PluginAjax			=	NULL;
	$PluginJS			=	NULL;
	$PluginVersion		=	"1.0";
	$PluginDate			=	"12.25.2018";

	if($PluginPHP	!==	NULL){
		require_once($PluginName."/php/".$PluginPHP);
	}
	if($PluginAjax	!==	NULL){
		require_once($PluginName."/ajax/".$PluginAjax);
	}
	if($PluginJS	!==	NULL){
		require_once($PluginName."/js/".$PluginJS);
	}
?>