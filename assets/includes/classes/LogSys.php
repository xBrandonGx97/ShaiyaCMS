<?php
	class LogSys{
		public static function createLog($Action){
			$stmt = Database::connect()->prepare("
													INSERT INTO ".Database::getTable("LOG_ACCESS")."
													(UserID,UserIP,Action)
													VALUES
													(?,?,?)
			");
			$params = array($_SESSION['UserID'],$_SERVER['REMOTE_ADDR'],$Action);
			$stmt->execute($params);
			#return 'Action logged at '.time();
		}
	}