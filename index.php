<?php
	# Initialize Session
	session_name("shCMS");
	session_start();
	ob_start();
	setcookie("shCMS",session_id(),0,"/",null,null,true);
	# Define our Root
	define('DOC_ROOT','http://localhost:8800');
	require_once('assets/includes/init.php');

	//$display	=	new	Display();
	# Load HTML Purifier
	Settings::_load_purifier();
	$app		=	new	App();
?>