<?php
	# Plugin Information
	$PluginName			=	"Test1";
	$PluginMasterFile		=	"plugin.test1.php";
	$PluginPHP			=	"test1.php";
	$PluginAjax			=	NULL;
	$PluginJS				=	NULL;
	$PluginVersion		=	"1.0";
	$PluginDate			=	"1-20-19";

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