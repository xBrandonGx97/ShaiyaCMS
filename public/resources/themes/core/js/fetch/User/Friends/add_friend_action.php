<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	#require_once($_SERVER['DOCUMENT_ROOT'].'/../app/models/Friends.php');
    #$Friends	=	new Friends();
	$Friends		=	CoreController::model('Friends');
	\Classes\Utils\Session::init('Default');
	
	//Receive the RAW post data.
  	$content = trim(file_get_contents("php://input"));
  	
  	$decoded = json_decode($content, true);
  	//If json_decode succeeded, the JSON is valid.
	if(is_array($decoded)) {
	  	list($ToUser,$FromUser) = explode("~",$decoded["id"]);
	  	if($ToUser!==$FromUser) {
	  		if(!$Friends->ifFriendsExist($ToUser,$FromUser)) {
	  			if(!$Friends->isFriendRequestPending($ToUser,$FromUser)) {
					$Friends->addFriend($ToUser,$FromUser);
				}
			}
		}
	}