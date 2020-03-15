<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\DB\MSSQL;
	USE \Classes\UI\UI;
	
	$content = trim(file_get_contents("php://input"));
	$decoded = json_decode($content, true);
	if(is_array($decoded)) {
		$DisplayName 	= isset($decoded["DisplayName"]) ? trim($decoded["DisplayName"]) : false;
		if(isset($DisplayName)){
			$sql	=	("
							SELECT Count(DisplayName)
							FROM ".MSSQL::getTable("WEB_PRESENCE")."
							WHERE DisplayName=?
			");
			$stmt=MSSQL::connect()->prepare($sql);
			$stmt->bindValue(1, $DisplayName, PDO::PARAM_INT);
			$stmt->execute();
			$ChkDisplay = $stmt->fetchColumn();
			
			try{
				if(empty($DisplayName)){
					UI::BADGE_AJAX('badge-warning','<i class="fa fa-info-circle"></i> Display Name is empty!');
				}else{
					if($ChkDisplay<1){
						UI::BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i>DisplayName is available!');
					}
					else{
						UI::BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i>DisplayName is unavailable. Please choose a different DisplayName.');
					}
				}
			}catch (PDOException $e) {
				UI::BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Unable to check DisplayName. This is a problem...');
			}
		}
	}