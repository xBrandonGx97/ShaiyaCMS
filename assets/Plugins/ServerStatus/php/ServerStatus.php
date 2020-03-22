<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	$Title	.=	'Server Status';
		$Body	.=	'<table class="playerOnlineTable" style="display:block; padding-left: 20px;">';
		$Body	.=	$this->SQL->serverStatus();
		$Body	.=	'</table>';

	echo $this->Tpl->PLUGIN_CARD($Title,'',$Body,'');
?>