<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/assets/classes/Autoloader.class.php");

	$db			=	new Database();
	$Data		=	new Data($db);
	$Tpl		=	new Template();
	$Setting	=	new Setting($Data,$db,$Tpl);

	$UserID			=	isset($_POST["UserID"])			?	$Data->escData(trim($_POST["UserID"]))		:	false;

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST["UserID"])){
		$query=$db->conn->prepare('
			SELECT Count(UserID)
			FROM '.$db->get_TABLE("SH_USERDATA").'
			WHERE UserID=?
		');
		$query->bindValue(1, $UserID, PDO::PARAM_INT);
		$query->execute();
		$ChkUser = $query->fetchColumn();

		try{
			if($ChkUser<1){
				$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> UserID is available!');
			}
			else{
				$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> UserID is unavailable. Please choose a different UserID.');
			}
		}catch (PDOException $e) {
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Unable to check UserID. This is a problem...');
		}
	}
?>