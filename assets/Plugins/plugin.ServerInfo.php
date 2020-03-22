<?php
	# Plugin Information
	$this->PLUGIN_NAME			=	'ServerInformation';
	$this->PLUGIN_MASTERFILE	=	'plugin.ServerInfo.php';
	$this->PLUGIN_PHP			=	'ServerInfo.php';
	$this->PLUGIN_AJAX			=	 NULL;
	$this->PLUGIN_JS			=	 NULL;
	$this->PLUGIN_VERSION		=	'1.0';
	$this->PLUGIN_DATE			=	'12.24.2018';

	if($this->MODE == "DISPLAY"){
		if($this->PLUGIN_PHP	!==	NULL){
			require_once($this->PLUGIN_NAME."/php/".$this->PLUGIN_PHP);
		}
		if($this->PLUGIN_AJAX	!==	NULL){
		#	require_once($this->PLUGIN_NAME."/ajax/".$this->PLUGIN_AJAX);
		}
		if($this->PLUGIN_JS	!==	NULL){
		#	require_once($this->PLUGIN_NAME."/js/".$this->PLUGIN_JS);
#			echo '<script charset="utf-8" type="text/javascript" src="'.$this->get_PLUGINS_DIR().$this->PLUGIN_NAME."/js/".$this->PLUGIN_JS.'"></script>';
		}
	}
?>