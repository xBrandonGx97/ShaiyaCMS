<?php
	if($this->Type == "DEV"){
		$this->dns		=	"127.0.0.1";
		$this->dbname	= 	"PS_UserData";
		$this->user		=	"UserID";
		$this->pwd		=	"UserPw";
	}
	elseif($this->Type == "REL"){
		$this->dns		=	"127.0.0.1";
		$this->dbname	= 	"PS_UserData";
		$this->user		=	"UserID";
		$this->pwd		=	"UserPw";
	}
?>