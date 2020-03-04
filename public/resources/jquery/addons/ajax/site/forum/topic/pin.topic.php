<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
	
	if ($contentType === "application/json") {
		//Receive the RAW post data.
  		$content = trim(file_get_contents("php://input"));
  		
  		$decoded = json_decode($content, true);
  		
  		//If json_decode failed, the JSON is invalid.
	  	if(is_array($decoded)) {
			$topicID	=	$decoded['topicID'];
			$action	=	$decoded['action'];
			$errors = [];
			$arr	=	[
				'done' => '',
				'pinned' => '',
				'action' => $action
			];
			if(isset($topicID)) {
				if(empty($topicID || $topicID === '')) {
					$errors[]  .=  'topicID can not be empty!';
				}
				if(count($errors)==0) {
					//DO SQL UPDATE
					if($action=='pin') {
						$sql=("
								UPDATE ShaiyaCMS.dbo.FORUM_TOPICS
								SET Pinned=:pinned
								WHERE TopicID=:topicid
						");
						MSSQL::query($sql);
						MSSQL::bind(':pinned',1);
						MSSQL::bind(':topicid',$topicID);
						MSSQL::execute();
					} elseif($action=='unpin'){
						$sql=("
								UPDATE ShaiyaCMS.dbo.FORUM_TOPICS
								SET Pinned=:pinned
								WHERE TopicID=:topicid
						");
						MSSQL::query($sql);
						MSSQL::bind(':pinned',0);
						MSSQL::bind(':topicid',$topicID);
						MSSQL::execute();
					}
					if($action=='pin') {
						$arr['pinned']  .=  'true';
					} elseif($action=='unpin'){
						$arr['pinned']  .=  'false';
					}
					$arr['done']  .=  1;
				}
				# Check Errors
				if(count($errors)){
					echo '<ul>';
					foreach($errors as $error){
						echo '<li>'.$error.'</li><br>';
					}
					echo '</ul>';
				}
				echo json_encode($arr);
			}
	  	}
	}
