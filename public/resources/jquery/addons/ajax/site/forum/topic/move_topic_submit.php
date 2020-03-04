<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	
	$content = trim(file_get_contents("php://input"));
	$decoded = json_decode($content, true);
	if(is_array($decoded)) {
	    if(isset($decoded['topicTitle'])){
		    $TopicTitle = isset($decoded["topicTitle"]) ? Data::_do('escData', trim($decoded["topicTitle"])) : false;
			$TopicID = isset($decoded["topicID"]) ? Data::_do('escData', trim($decoded["topicID"])) : false;
			$Destination = isset($decoded["destination"]) ? Data::_do('escData', trim($decoded["destination"])) : false;
			# Error Checking
			$errors = [];
			if(empty($TopicTitle)) {
				$errors[]  .=  'TopicTitle can not be empty.';
			}
			if(empty($Destination)) {
				$errors[]  .=  'Destination can not be empty.';
			}
			# If No Errors Continue
			if(count($errors)==0) {
				$sql=("
						UPDATE ShaiyaCMS.dbo.FORUM_TOPICS
						SET ForumID = :destination
						WHERE TopicID = :topicid
				");
				MSSQL::query($sql);
				MSSQL::bind(':destination',$Destination);
				MSSQL::bind(':topicid',$TopicID);
				MSSQL::execute();
				
				$sql=("
						UPDATE ShaiyaCMS.dbo.FORUM_POSTS
						SET PostTitle = :title,ForumID = :destination
						WHERE TopicID = :topicid AND Main=:main
				");
				MSSQL::query($sql);
				MSSQL::bind(':title',$TopicTitle);
				MSSQL::bind(':destination',$Destination);
				MSSQL::bind(':topicid',$TopicID);
				MSSQL::bind(':main',1);
				MSSQL::execute();
				echo 'Topic has been successfully moved.';
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
	}