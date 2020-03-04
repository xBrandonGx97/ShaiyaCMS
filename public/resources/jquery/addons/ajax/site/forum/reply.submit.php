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
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, true);
		if(is_array($decoded)) {
				$TopicID 		= isset($decoded["topicid"]) ? Data::_do('escData', trim($decoded["topicid"])) : false;
				$PostAuthor 	= isset($decoded["postauthor"]) ? Data::_do('escData', trim($decoded["postauthor"])) : false;
				$PostBody 	= isset($decoded["postbody"]) ? Data::_do('escData', trim($decoded["postbody"])) : false;
				# Error Checking
				$arr	=	[
						'finished' => '',
						'errors' => []
				];
				if(isset($decoded['sent'])){
					if(empty($TopicID)) {
						$arr['errors'][]  .=  'TopicID can not be empty.';
					}
					if(empty($PostAuthor)) {
						$arr['errors'][]  .=  'Post Author can not be empty.';
					}
					if(empty($PostBody)) {
						$arr['errors'][]  .=  'Post Body can not be empty.';
					}
					# If No Errors Continue
					if(count($arr['errors'])==0) {
						$sql = ("
									INSERT INTO " . MSSQL::getTable("POSTS") . "
									(TopicID,PostBody,PostAuthor)
									VALUES (?,?,?)
						");
						$stmt = MSSQL::connect()->prepare($sql);
						$stmt->bindParam(1, $TopicID, PDO::PARAM_INT);
						$stmt->bindParam(2, $PostBody, PDO::PARAM_STR);
						$stmt->bindParam(3, $PostAuthor, PDO::PARAM_STR);
						if ($stmt->execute()) {
							$arr['finished']  .=  'true';
							#echo '<script>window.location.reload();</script>';
						}
					}
					# Check Errors
					if(count($arr['errors'])){
						#echo '<ul>';
						foreach($arr['errors'] as $error){
							#echo '<li>'.$error.'</li><br>';
						}
						#echo '</ul>';
					}
				echo json_encode($arr);
			}
		}
	}