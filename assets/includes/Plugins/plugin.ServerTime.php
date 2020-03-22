<?php
	# Plugin Information
	$PluginName			=	"ServerTime";
	$PluginMasterFile	=	"plugin.ServerTime.php";
	$PluginPHP			=	"ServerTime.php";
	$PluginAjax			=	NULL;
	$PluginJS			=	"ServerTime.js";
	$PluginVersion		=	"1.0";
	$PluginDate			=	"09.16.2017";

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