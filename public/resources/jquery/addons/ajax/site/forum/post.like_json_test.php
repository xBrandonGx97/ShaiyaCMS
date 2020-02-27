<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	
	if(isset($_POST['postID'])){
		list($postID,$likedUser,$userUID,$postAuthor) = explode("~",$_POST["uid"]);
		$json = [
			'postID' => $postID,
			'likedUser' => $likedUser,
			'userUID' => $userUID,
			'postAuthor' => $postAuthor,
			'action' => $_POST['action'],
		];
		$data = json_decode($json);
		$postID	=	$data->postID;
		# Error Checking
		$arr	=	[
			'errors' => [],
			'newCount' => '',
			'liked' => '',
			'action' => $_POST['action']
		];
		if($data->likedUser==$data->userUID || $data->userUID==$data->likedUser) {
			$arr['errors'][]  .=  'You cannot like your own post!';
		}
		if(count($arr['errors'])==0) {
			if($data->action=='like') {
				$sql=("
						INSERT INTO ShaiyaCMS.dbo.FORUM_POST_LIKES
						(PostID,LikedUser,UserUID)
						VALUES(:postid,:likeduser,:useruid)
				");
				MSSQL::query($sql);
				MSSQL::bind(':postid',$data->postID);
				MSSQL::bind(':likeduser',$data->likedUser);
				MSSQL::bind(':useruid',$data->userUID);
				MSSQL::execute();
			} elseif($data->action=='unlike'){
				$sql=("
						DELETE FROM ShaiyaCMS.dbo.FORUM_POST_LIKES
						WHERE LikedUser=:likeduser AND PostID=:postid
				");
				MSSQL::query($sql);
				MSSQL::bind(':postid',$data->postID);
				MSSQL::bind(':likeduser',$data->likedUser);
				MSSQL::execute();
			}
			$sql=("
					SELECT COUNT(*) AS Likes FROM ShaiyaCMS.dbo.FORUM_POST_LIKES
					WHERE UserUID=?
			");
			$stmt   =   MSSQL::connect()->prepare($sql);
			$stmt   ->  bindParam(1, $data->userUID, PDO::PARAM_INT);
			$stmt->execute();
			$fet = $stmt->fetch(PDO::FETCH_OBJ);
			$arr['newCount']  .=  $fet->Likes;
			if($data->action=='like') {
				$arr['liked']  .=  'true';
			} elseif($data->action=='unlike'){
				$arr['liked']  .=  'false';
			}
		}
		echo json_encode($arr);
	}