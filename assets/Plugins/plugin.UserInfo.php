<?php
	# Plugin Information
	$this->PLUGIN_NAME			=	'UserInfo';
	$this->PLUGIN_MASTERFILE	=	'plugin.UserInfo.php';
	$this->PLUGIN_PHP			=	'UserInfo.php';
	$this->PLUGIN_AJAX			=	NULL;
	$this->PLUGIN_JS			=	NULL;
	$this->PLUGIN_VERSION		=	'1.0';
	$this->PLUGIN_DATE			=	'05.05.2018';

	if($this->MODE == "DISPLAY"){
		if($this->PLUGIN_PHP	!==	NULL){
			require_once($this->PLUGIN_NAME."/php/".$this->PLUGIN_PHP);
		}
		elseif($this->PLUGIN_AJAX	!==	NULL){
			require_once($this->PLUGIN_NAME."/ajax/".$this->PLUGIN_AJAX);
		}
		if($this->PLUGIN_JS		!==	NULL){
			require_once($this->PLUGIN_NAME."/js/".$this->PLUGIN_JS);
		}
	}
?>