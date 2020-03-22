<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	if($this->User->LoggedIn()){
		$Title	.=	'Member Info';
		$Body	.=	'Welcome: '.$this->User->UserID.' <a href="?'.$this->Setting->PAGE_PREFIX.'=PROFILE">Edit Profile</a><br>';
		$Body	.=	'You Have : '.$this->User->Point.' DP<br>';
	}
	else{
		
	}


	echo $this->Tpl->PLUGIN_CARD($Title,'tac',$Body,'');
?>