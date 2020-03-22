<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/assets/classes/Autoloader.class.php");

	$db			=	new Database();
	$Data		=	new Data($db);
	$Tpl		=	new Template();
	$Setting	=	new Setting($Data,$db,$Tpl);

	$DisplayName	=	isset($_POST["DisplayName"])	?	$Data->escData(trim($_POST["DisplayName"]))	:	false;

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST["DisplayName"])){
		$query=$db->conn->prepare('
			SELECT Count(DisplayName)
			FROM '.$db->get_TABLE("WEB_PRESENCE").'
			WHERE DisplayName=?
		');
		$query->bindValue(1, $DisplayName, PDO::PARAM_INT);
		$query->execute();
		$ChkDisplay = $query->fetchColumn();

		try{
			if($ChkDisplay<1){
				$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i>DisplayName is available!');
			}
			else{
				$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i>DisplayName is unavailable. Please choose a different DisplayName.');
			}
		}catch (PDOException $e) {
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Unable to check DisplayName. This is a problem...');
		}
	}
?>