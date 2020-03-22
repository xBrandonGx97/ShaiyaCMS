<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/assets/includes/classes/Autoloader.php");

	$DisplayName	=	isset($_POST["DisplayName"])	?	Data::escData(trim($_POST["DisplayName"]))	:	false;

	if(isset($_POST["DisplayName"])){
		$query=Database::connect()->prepare('
			SELECT Count(DisplayName)
			FROM '.Database::getTable("WEB_PRESENCE").'
			WHERE DisplayName=?
		');
		$query->bindValue(1, $DisplayName, PDO::PARAM_INT);
		$query->execute();
		$ChkDisplay = $query->fetchColumn();

		try{
			if(empty($DisplayName)){
				Template::BADGE_AJAX('badge-warning','<i class="fa fa-info-circle"></i> Display Name is empty!');
			}else{
				if($ChkDisplay<1){
					Template::BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i>DisplayName is available!');
				}
				else{
					Template::BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i>DisplayName is unavailable. Please choose a different DisplayName.');
				}
			}
		}catch (PDOException $e) {
			Template::BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Unable to check DisplayName. This is a problem...');
		}
	}
?>