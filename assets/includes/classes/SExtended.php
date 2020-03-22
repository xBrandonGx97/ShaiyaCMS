<?php
class SExtended
{
	public static $version = "2.0";

	public static function status(){
		if(Database::$conn){
			echo('ShAPI is ready current version: '+self::$version+' <img src="https://www.paragon-servers.com/images/paragonv2/royaume/royaume-online.gif">');
		}else{
			echo('ShAPI is not ready... current version: '+self::$version+' <img src="https://www.paragon-servers.com/images/paragonv2/royaume/royaume-offline.gif">');
			//dbconn is not ok
		}
	}
	public static function cmd_send($cmd){
		$query = "
		DECLARE @msgg varchar(MAX) = N'/' + ?
		DECLARE	@return_value int

		EXEC	@return_value = [PS_ChatLog].[dbo].[Command]
				@serviceName = N'ps_game',
				@cmmd = @msgg

		";
		$stmt=Database::connect()->prepare($query);
		$stmt->execute(array($cmd));
	}
	public static function get_char($char){
			if (is_numeric($char)){
				//then the given input is a char id
				$query = "SELECT TOP 1 CharName FROM PS_GameData.dbo.Chars WHERE CharID = ?;";
				$stmt=Database::connect()->prepare($query);
				$stmt->execute(array($char));
				$rows = $stmt->FETCH();
				echo $rows['CharName'];
			}else{
				//then the giver input is a charname
				$query = "SELECT TOP 1 CharID FROM PS_GameData.dbo.Chars WHERE CharName = ?;";
				$stmt=Database::connect()->prepare($query);
				$stmt->execute(array($char));
				$rows = $stmt->FETCH();
				echo $rows['CharID'];
			}
	}
	public static function get_user($user){
			if (is_numeric($user)){
				//then the given input is a user uid
				$query = "SELECT TOP 1 UserID FROM PS_UserData.dbo.Users_Master WHERE UserUID = ?;";
				$stmt=Database::connect()->prepare($query);
				$stmt->execute(array($user));
				$rows = $stmt->FETCH();
				echo $rows['UserID'];
			}else{
				//then the giver input is a user name
				$query = "SELECT TOP 1 UserUID FROM PS_UserData.dbo.Users_Master WHERE UserID = ?;";
				$stmt=Database::connect()->prepare($query);
				$stmt->execute(array($user));
				$rows = $stmt->FETCH();
				echo $rows['UserUID'];
			}
	}
	public static function player_send($char,$message){
		if (!is_numeric($char)){
			$char = self::get_char($char);
		}
		$command = "ntplayer $char $message";
		self::cmd_send($command);
	}
	public static function notice_send($message){
		$command = "nt $message";
		self::cmd_send($command);
	}
	public static function get_char_byusr($user,$output){
		if (!is_numeric($user)){
		$user = get_user($user);
		}
		if($output = 'SHAPI::CharID'){
		$query = "SELECT TOP 1 CharID FROM PS_GameData.dbo.Chars WHERE UserUID = ? AND LoginStatus = 1;";
		}else{
		$query = "SELECT TOP 1 CharName FROM PS_GameData.dbo.Chars WHERE UserUID = ? AND LoginStatus = 1;";

		}

		$stmt=Database::connect()->prepare($query);
		$stmt->execute(array($char));
		$rows = $stmt->FETCH();

		if($output = 'SHAPI::CharID'){
		echo $rows['CharID'];
		}else{
		echo $rows['CharName'];

		}
	}
}