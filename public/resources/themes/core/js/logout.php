<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	$Friends		=	CoreController::model('Friends');
	\Classes\Utils\Session::init('Default');
	
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
	
	if ($contentType === "application/json") {
		//Receive the RAW post data.
		$content = trim(file_get_contents("php://input"));
		
		$decoded = json_decode($content, true);
		//If json_decode succeeded, the JSON is valid.
		if(is_array($decoded)) {
			$arr	=	[
				'newtime' => '',
				'currentTime' => date("F d,Y h:i:s A", time())
      ];
      $sql=("
            UPDATE ShaiyaCMS.dbo.WEB_PRESENCE
            SET LoginStatus = 1
            WHERE UserID = 'Brandon'
        ");
        MSSQL::query($sql);
        MSSQL::execute();
        unset($_SESSION['User']);
			if(isset($decoded['time'])){
				echo json_encode($arr);
			}
		}
	}