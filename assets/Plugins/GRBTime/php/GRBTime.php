<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	$Title	.=	'GRB Time';
	$Body	.=	'<div><span class="dayss" id="days1"></span></div>';

	echo $this->Tpl->PLUGIN_CARD($Title,'tac',$Body,'');
?>