<?php
	# Plugin Information
	$PluginName			=	"ServerInformation";
	$PluginMasterFile	=	"plugin.ServerInfo.php";
	$PluginPHP			=	"ServerInfo.php";
	$PluginAjax			=	NULL;
	$PluginJS			=	NULL;
	$PluginVersion		=	"1.0";
	$PluginDate			=	"12.24.2018";

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