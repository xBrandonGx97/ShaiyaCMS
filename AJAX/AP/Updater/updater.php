<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/assets/classes/Autoloader.class.php");

	$db			=	new Database();
	$Data		=	new Data($db);
	$Tpl		=	new Template($Data);
	$Setting	=	new Setting($Data,$db,$Tpl);
	$Version	=	new Version($db,$Data,$Setting);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	echo $Version->PATCH_DATA;
?>