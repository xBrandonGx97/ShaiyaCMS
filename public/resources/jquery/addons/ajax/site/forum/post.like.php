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
  		
  		//If json_decode succeeded, the JSON is valid.
	  	if(is_array($decoded)) {
	  		list($postID,$likedUser,$userUID,$postAuthor) = explode("~",$decoded['uid']);
			$postID	=	$decoded['postID'];
			$action	=	$decoded['action'];
			# Error Checking
			$arr	=	[
				'errors' => [],
				'newCount' => '',
				'liked' => '',
				'action' => $action
			];
			if(isset($postID)){
				if($likedUser==$userUID || $userUID==$likedUser) {
					$arr['errors'][]  .=  'You cannot like your own post!';
				}
				if(count($arr['errors'])==0) {
					if($action=='like') {
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
					} elseif($action=='unlike'){
						$sql=("
								DELETE FROM ShaiyaCMS.dbo.FORUM_POST_LIKES
								WHERE LikedUser=:likeduser AND PostID=:postid
						");
						MSSQL::query($sql);
						MSSQL::bind(':postid',$postID);
						MSSQL::bind(':likeduser',$likedUser);
						MSSQL::execute();
					}
					$sql=("
							SELECT COUNT(*) AS Likes FROM ShaiyaCMS.dbo.FORUM_POST_LIKES
							WHERE UserUID=?
					");
					$stmt   =   MSSQL::connect()->prepare($sql);
					$stmt   ->  bindParam(1, $userUID, PDO::PARAM_INT);
					$stmt->execute();
					$fet = $stmt->fetch(PDO::FETCH_OBJ);
					$arr['newCount']  .=  $fet->Likes;
					if($action=='like') {
						$arr['liked']  .=  'true';
					} elseif($action=='unlike'){
						$arr['liked']  .=  'false';
					}
				}
				echo json_encode($arr);
			}
	  	}
	}
	
	/*if(isset($_POST['postID'])){
		list($postID,$likedUser,$userUID,$postAuthor) = explode("~",$_POST["uid"]);
		$postID	=	$_POST['postID'];
		$action	=	$_POST['action'];
		# Error Checking
		$arr	=	[
			'errors' => [],
			'newCount' => '',
			'liked' => '',
			'action' => $_POST['action']
		];
		if($likedUser==$userUID || $userUID==$likedUser) {
			$arr['errors'][]  .=  'You cannot like your own post!';
		}
		if(count($arr['errors'])==0) {
			if($action=='like') {
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
			} elseif($action=='unlike'){
				$sql=("
						DELETE FROM ShaiyaCMS.dbo.FORUM_POST_LIKES
						WHERE LikedUser=:likeduser AND PostID=:postid
				");
				MSSQL::query($sql);
				MSSQL::bind(':postid',$postID);
				MSSQL::bind(':likeduser',$likedUser);
				MSSQL::execute();
			}
			$sql=("
					SELECT COUNT(*) AS Likes FROM ShaiyaCMS.dbo.FORUM_POST_LIKES
					WHERE UserUID=?
			");
			$stmt   =   MSSQL::connect()->prepare($sql);
			$stmt   ->  bindParam(1, $userUID, PDO::PARAM_INT);
			$stmt->execute();
			$fet = $stmt->fetch(PDO::FETCH_OBJ);
			$arr['newCount']  .=  $fet->Likes;
			if($action=='like') {
				$arr['liked']  .=  'true';
			} elseif($action=='unlike'){
				$arr['liked']  .=  'false';
			}
		}
		echo json_encode($arr);
	}*/