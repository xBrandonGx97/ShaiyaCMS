<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	
	if(isset($_POST['sent'])){
		list($postID,$likedUser,$userUID) = explode("~",$_POST["uid"]);
		# Error Checking
		$errors = array();
		if(empty($postID)) {
			$errors[]  .=  'PostID can not be empty.';
		}
		# If No Errors Continue
		if(count($errors)==0) {
			$sql=("
					INSERT INTO ShaiyaCMS.dbo.FORUM_POST_LIKES
					(PostID,LikedUser,UserUID)
					VALUES(:postid,:likeduser,:useruid)
			");
  			MSSQL::query($sql);
  			MSSQL::bind(':postid',$postID);
  			MSSQL::bind(':likeduser',$likedUser);
  			MSSQL::bind(':useruid',$userUID);
            MSSQL::execute();
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