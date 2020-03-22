<?php
	class LogSys{
		function __construct($DatabaseObj){
			$this->db	=	$DatabaseObj;
		}
		function createLog($Action){
			$this->stmt = $this->db->conn->prepare("
				INSERT INTO ".$this->db->get_TABLE("LOG_ACCESS")."
				(UserID,UserIP,Action)
				VALUES
				(?,?,?)
			");
			$this->params = array($_SESSION['uid'],$_SERVER['REMOTE_ADDR'],$Action);
			$this->stmt->execute($this->params);

			#return 'Action logged at '.time();
		}
	}