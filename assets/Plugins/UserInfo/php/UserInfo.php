<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	$Title	.=	'Member Info';
	$Body	.=	'Welcome: '.$this->User->UserID.' <a href="?'.$this->Setting->PAGE_PREFIX.'=PROFILE">Edit Profile</a><br>';
	$Body	.=	'You Have : '.$this->User->Point.' DP<br>';


	echo $this->Tpl->PLUGIN_CARD($Title,'tac',$Body,'');
?>