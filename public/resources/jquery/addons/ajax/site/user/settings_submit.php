<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	use \Classes\Utils\User;
	
	\Classes\Utils\Session::init('Default');
	
	User::run();
	$User			=	User::_fetch_User();
	
	$content = trim(file_get_contents("php://input"));
	$decoded = json_decode($content, true);
	if(is_array($decoded)) {
		$Discord = isset($decoded["discord"]) ? Data::_do('escData', trim($decoded["discord"])) : false;
		$userTitle = isset($decoded["usertitle"]) ? Data::_do('escData', trim($decoded["usertitle"])) : false;
		$Skype = isset($decoded["skype"]) ? Data::_do('escData', trim($decoded["skype"])) : false;
		$Steam = isset($decoded["steam"]) ? Data::_do('escData', trim($decoded["steam"])) : false;
		$discordPattern	=	preg_match('/^((.+?)#\d{4})\b/', $Discord);
		
		// User updated discord value.
		if(isset($Discord) && isset($userTitle) && isset($Skype) && isset($Steam)) {
			$sql=("
								SELECT * FROM ShaiyaCMS.dbo.WEB_PRESENCE AS [WP]
								INNER JOIN PS_UserData.dbo.Users_Master AS [UM] ON [WP].[UserID] = [UM].[UserID]
								INNER JOIN ShaiyaCMS.dbo.USER_SOCIALS AS [US] ON [UM].[UserUID] = [US].[UserUID]
								WHERE [UM].[UserUID]=:uid
			");
			$stmt = MSSQL::query($sql);
			MSSQL::bind(':uid',$User['UserUID']);
			$res = MSSQL::resultSet();
			$rowCount	=	count($res);
			if($rowCount > 0) {
				foreach ($res as $data) {
					if(!empty($userTitle)) {
						if($userTitle!==$data->UserTitle) {
							updateValue('UserTitle', $userTitle,$User['UserUID'],$User['UserID']);
						}
					}
					if(!empty($Discord))  {
						if($Discord!==$data->Discord) {
							if(!$discordPattern) {
								echo 'Your discord handle is not in correct format. Please try again.';
							} else {
								updateValue('Discord', $Discord,$User['UserUID']);
							}
							
						}
					}
					if(!empty($Skype)) {
						if($Skype!==$data->Skype) {
							updateValue('Skype', $Skype,$User['UserUID']);
						}
					}
				}
			}
			
		}
	}
	
	function updateValue($Column,$Value,$UserUID,$UserID=false) {
		if($Column!=='UserTitle') {
			$sql=("
					UPDATE ShaiyaCMS.dbo.USER_SOCIALS
					SET $Column = :value
					WHERE UserUID = :uid
					
			");
			MSSQL::query($sql);
			MSSQL::bind(':value',$Value);
			MSSQL::bind(':uid',$UserUID);
			MSSQL::execute();
			echo $Column.' Updated successfully<br>';
		} elseif ($Column==='UserTitle') {
			$sql=("
					UPDATE ShaiyaCMS.dbo.WEB_PRESENCE
					SET $Column = :value
					WHERE UserID = :id
					
			");
			MSSQL::query($sql);
			MSSQL::bind(':value',$Value);
			MSSQL::bind(':id',$UserID);
			MSSQL::execute();
			echo $Column.' Updated successfully<br>';
		}
	}