<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	
	if(isset($_POST['sent'])){
		$TopicID 		= isset($_POST["topicid"]) ? Data::_do('escData', trim($_POST["topicid"])) : false;
		$PostAuthor 	= isset($_POST["postauthor"]) ? Data::_do('escData', trim($_POST["postauthor"])) : false;
		$PostBody 	= isset($_POST["postbody"]) ? Data::_do('escData', trim($_POST["postbody"])) : false;
		# Error Checking
		$errors = array();
		
		if(empty($TopicID)) {
			$errors[]  .=  'TopicID can not be empty.';
		}
		if(empty($PostAuthor)) {
			$errors[]  .=  'Post Author can not be empty.';
		}
		if(empty($PostBody)) {
			$errors[]  .=  'Post Body can not be empty.';
		}
		# If No Errors Continue
		if(count($errors)==0) {
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
				echo '<script>window.location.reload();</script>';
			}
		}
		# Check Errors
		if(count($errors)){
			echo '<ul>';
			foreach($errors as $error){
				echo '<li>'.$error.'</li><br>';
			}
			echo '</ul>';
		}
	}