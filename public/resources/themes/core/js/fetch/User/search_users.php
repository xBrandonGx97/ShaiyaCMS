<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	use \Classes\Utils\Session;
	
	Session::init('Default');
	
	$name	=	$_POST['name'];
	
	$data = searchData($name);
	
	echo json_encode($data);
	
	function searchData($name) {
		/*$sql=("
				SELECT UserUID,UserID from PS_UserData.dbo.Users_Master WHERE UserID LIKE :name
		");*/
		$sql=("
				SELECT UserUID,UserID,CharName from PS_GameData.dbo.Chars WHERE CharName LIKE :name
		");
  		MSSQL::query($sql);
  		MSSQL::bind(':name','%'.$name.'%');
        $res = MSSQL::resultSet();
        return $res;
	}