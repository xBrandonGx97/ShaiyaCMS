<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	
	$ForumID = isset($_POST["ForumID"]) ? Data::_do('escData', trim($_POST["ForumID"])) : false;
	$TopicAuthor = isset($_POST["TopicAuthor"]) ? Data::_do('escData', trim($_POST["TopicAuthor"])) : false;
	$TopicTitle = isset($_POST["TopicTitle"]) ? Data::_do('escData', trim($_POST["TopicTitle"])) : false;
	$TopicBody = isset($_POST["TopicBody"]) ? Data::_do('escData', trim($_POST["TopicBody"])) : false;
	$TopicUID	=	Data::_do('member_id_rand');
	# Error Checking
	$errors = [];
	
	if (preg_match("/'/u", $TopicBody)){
		$TopicBody = str_replace("'", "", $TopicBody);
	}
	
	if(empty($ForumID)) {
		$errors[]  .=  'ForumID can not be empty.';
	}
	if(empty($TopicAuthor)) {
		$errors[]  .=  'TopicAuthor can not be empty.';
	}
	if(empty($TopicTitle)) {
		$errors[]  .=  'Topic Title can not be empty.';
	}
	if(empty($TopicBody)) {
		$errors[]  .=  'Topic Message can not be empty.';
	}
	# If No Errors Continue
	if(count($errors)==0) {
		$sql=("
				INSERT INTO ShaiyaCMS.dbo.FORUM_TOPICS
				(ForumID,TopicAuthor,TopicUID)
				VALUES(:forumid,:topicauthor,:topicuid)
		");
  		MSSQL::query($sql);
  		MSSQL::bind(':forumid',$ForumID);
  		MSSQL::bind(':topicauthor',$TopicAuthor);
  		MSSQL::bind(':topicuid',$TopicUID);
        MSSQL::execute();
        
        $sql=("
				SELECT * FROM ShaiyaCMS.dbo.FORUM_TOPICS
				WHERE TopicUID=:topicuid AND TopicAuthor=:topicauthor
		");
  		MSSQL::query($sql);
  		MSSQL::bind(':topicuid',$TopicUID);
  		MSSQL::bind(':topicauthor',$TopicAuthor);
        $res = MSSQL::single();
        $getTopicID	=	$res->TopicID;
        
        $sql=("
				INSERT INTO ShaiyaCMS.dbo.FORUM_POSTS
				(ForumID,TopicID,PostTitle,PostBody,PostAuthor,Main)
				VALUES(:forumid,:topicid,:posttitle,:postbody,:postauthor,:main)
		");
  		MSSQL::query($sql);
  		MSSQL::bind(':forumid',$ForumID);
  		MSSQL::bind(':topicid',$getTopicID);
  		MSSQL::bind(':posttitle',$TopicTitle);
  		MSSQL::bind(':postbody',$TopicBody);
  		MSSQL::bind(':postauthor',$TopicAuthor);
  		MSSQL::bind(':main',1);
        MSSQL::execute();
        echo 'New Topic successfully created.';
	}
	# Check Errors
	if(count($errors)){
		echo '<ul>';
		foreach($errors as $error){
			echo '<li>'.$error.'</li><br>';
		}
		echo '</ul>';
	}