<?php
namespace Classes\Utils;
use Classes\DB\MSSQL;
class Session {
	public static function init($name) {
		if (!isset($_SESSION)) {
			# Start our session
			session_name($name);
			session_start();
			setcookie($name,session_id(),0,"/",null,null,true);
		}
	}
	public static function doLogin() {
		
	}
	
	public static function doLogout() {
		self::updateLoginStatus(0);
		if (isset($_SESSION['User'])) {
			session_regenerate_id(true);
			unset($_SESSION['User']);
			header('location: /');
		}
	}
	
	public static function updateLoginStatus($status) {
		$sql=("
				UPDATE ShaiyaCMS.dbo.WEB_PRESENCE
				SET LoginStatus = :status
				WHERE UserID = :id
		");
		MSSQL::query($sql);
		MSSQL::bind(':status', $status, \PDO::PARAM_INT);
		MSSQL::bind(':id', $_SESSION['User']['UserID'], \PDO::PARAM_STR);
		MSSQL::execute();
	}
}