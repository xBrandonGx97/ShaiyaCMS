<?php
	namespace Classes\DB;
    use \PDO;
    if(!defined('IN_CMS')){die('<b>'.__NAMESPACE__.'\SQL</b>: unauthorized access detected, exiting...');}
    
    
    class SQL {
    	public static function viewData() {
    		$sql=("
					SELECT UserID from PS_UserData.dbo.Users_Master
			");
			MSSQL::query($sql);
			$data = MSSQL::resultSet(2);
			return $data;
		}
	}