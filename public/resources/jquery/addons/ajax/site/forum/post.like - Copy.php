<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	
	if(isset($_POST['postID'])){
		list($postID,$likedUser,$userUID) = explode("~",$_POST["uid"]);
		$postID	=	$_POST['postID'];
		$action	=	$_POST['action'];
		# Error Checking
		$errors = [];
		$arr	=	[
			'errors' => '',
			'newCount' => '',
			'liked' => '',
			'action' => $_POST['action']
		];
		if($action=='like') {
			if($likedUser==$userUID || $userUID==$likedUser) {
				$errors[]  .=  'You cannot like your own post!';
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
				$sql=("
						SELECT COUNT(*) AS Likes FROM ShaiyaCMS.dbo.FORUM_POST_LIKES AS [PL]
						INNER JOIN PS_UserData.dbo.Users_Master AS [UM] ON [PL].[UserUID] = [UM].[UserUID]
						INNER JOIN ShaiyaCMS.dbo.WEB_PRESENCE AS [WP] ON [UM].[UserID] = [WP].[UserID]
						WHERE [WP].[DisplayName]='[Dev]Velocity'
				");
				MSSQL::query($sql);
				MSSQL::execute();
				$fet = MSSQL::single();
				$arr['newCount']  .=  $fet->Likes;
				$arr['liked']  .=  'true';
				echo json_encode($arr);
			}
		} elseif($action=='unlike'){
			# If No Errors Continue
			if(count($errors)==0) {
				$sql=("
						DELETE FROM ShaiyaCMS.dbo.FORUM_POST_LIKES
						WHERE LikedUser=:likeduser AND PostID=:postid
				");
				MSSQL::query($sql);
				MSSQL::bind(':postid',$postID);
				MSSQL::bind(':likeduser',$likedUser);
				MSSQL::execute();
				$sql=("
						SELECT COUNT(*) AS Likes FROM ShaiyaCMS.dbo.FORUM_POST_LIKES AS [PL]
						INNER JOIN PS_UserData.dbo.Users_Master AS [UM] ON [PL].[UserUID] = [UM].[UserUID]
						INNER JOIN ShaiyaCMS.dbo.WEB_PRESENCE AS [WP] ON [UM].[UserID] = [WP].[UserID]
						WHERE [WP].[DisplayName]='[Dev]Velocity'
				");
				MSSQL::query($sql);
				MSSQL::execute();
				$fet = MSSQL::single();
				$arr['newCount']  .=  $fet->Likes;
				$arr['liked']  .=  'false';
				echo json_encode($arr);
			}
		}
	}