<?php
	# Plugin Information
	$this->PLUGIN_NAME			=	"GRBTime";
	$this->PLUGIN_MASTERFILE	=	"plugin.GRBTime.php";
	$this->PLUGIN_PHP			=	"GRBTime.php";
	$this->PLUGIN_AJAX			=	NULL;
	$this->PLUGIN_JS			=	"GRBTime.js";
	$this->PLUGIN_VERSION		=	"1.0";
	$this->PLUGIN_DATE			=	"12.11.2018";

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