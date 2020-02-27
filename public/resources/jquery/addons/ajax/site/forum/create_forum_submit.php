<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	use \Classes\Utils\Session;
	
	Session::init('Default');
	
	$ForumName 	= isset($_POST["ForumName"]) ? trim($_POST["ForumName"]) : false;
	$SubTitle 	= isset($_POST["SubTitle"]) ? trim($_POST["SubTitle"]) : false;
	# Error Checking
	$errors = [];
	
	if(empty($ForumName)) {
		$errors[]  .=  'ForumName can not be empty.';
	}
	if(empty($SubTitle)) {
		$errors[]  .=  'SubTitle can not be empty.';
	}
	# If No Errors Continue
	if(count($errors)==0) {
		$sql=("
				INSERT INTO ShaiyaCMS.dbo.FORUMS
				(ForumName,SubText)
				VALUES(:forumname,:subtitle)
		");
  		MSSQL::query($sql);
  		MSSQL::bind(':forumname',$ForumName);
  		MSSQL::bind(':subtitle',$SubTitle);
        MSSQL::execute();
        echo 'New forum successfully created.';
	}
	# Check Errors
	if(count($errors)){
		echo '<ul>';
		foreach($errors as $error){
			echo '<li>'.$error.'</li><br>';
		}
		echo '</ul>';
	}