<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	$Title	.=	'Server Time';
	$Body	.=	'<div class="text-center" id="server_time"></div>';
	$Body	.=	'<div class="text-center" id="server_date"></div>';
#	$Body	.=	'<div class="tac" id="serverdate">'.date('m/d/y').'</div>';

	echo Template::PLUGIN_CARD($Title,'text-center',$Body,'');
?>