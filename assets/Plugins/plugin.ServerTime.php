<?php
	# Plugin Information
	$this->PLUGIN_NAME			=	"ServerTime";
	$this->PLUGIN_MASTERFILE	=	"plugin.ServerTime.php";
	$this->PLUGIN_PHP			=	"ServerTime.php";
	$this->PLUGIN_AJAX			=	NULL;
	$this->PLUGIN_JS			=	"ServerTime.js";
	$this->PLUGIN_VERSION		=	"1.0";
	$this->PLUGIN_DATE			=	"09.16.2017";

	if($this->MODE == "DISPLAY"){
		if($this->PLUGIN_PHP	!==	NULL){
			require_once($this->PLUGIN_NAME."/php/".$this->PLUGIN_PHP);
		}
		if($this->PLUGIN_AJAX	!==	NULL){
			require_once($this->PLUGIN_NAME."/ajax/".$this->PLUGIN_AJAX);
		}
		if($this->PLUGIN_JS	!==	NULL){
			require_once($this->PLUGIN_NAME."/js/".$this->PLUGIN_JS);
		}
	}
?>