<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	$Title	.=	'Server Time';
	$Body	.=	'<div class="tac" id="server_time"></div>';
	$Body	.=	'<div class="tac" id="server_date"></div>';
#	$Body	.=	'<div class="tac" id="serverdate">'.date('m/d/y').'</div>';

	echo $this->Tpl->PLUGIN_CARD($Title,'tac',$Body,'');
?>