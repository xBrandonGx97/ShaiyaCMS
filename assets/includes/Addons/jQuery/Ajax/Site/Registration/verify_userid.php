<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/assets/includes/classes/Autoloader.php");

	$UserID			=	isset($_POST["UserID"])			?	Data::escData(trim($_POST["UserID"]))		:	false;

	if(isset($_POST["UserID"])){
		$query= Database::connect()->prepare('
			SELECT Count(UserID)
			FROM '.Database::getTable("SH_USERDATA").'
			WHERE UserID=?
		');
		$query->bindValue(1, $UserID, PDO::PARAM_INT);
		$query->execute();
		$ChkUser = $query->fetchColumn();

		try{
			if(empty($UserID)){
				Template::BADGE_AJAX('badge-warning','<i class="fa fa-info-circle"></i> UserID is empty!');
			}else{
				if($ChkUser<1){
					Template::BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> UserID is available!');
				}
				else{
					Template::BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> UserID is unavailable. Please choose a different UserID.');
				}
			}
		}catch (PDOException $e) {
			Template::BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Unable to check UserID. This is a problem...');
		}
	}
?>