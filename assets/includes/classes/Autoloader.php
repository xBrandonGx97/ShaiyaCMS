<?php
	function __autoload($class_name){
		if(file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/includes/classes/'.$class_name.'.php')){
			require_once($_SERVER['DOCUMENT_ROOT'].'/assets/includes/classes/'.$class_name.'.php');
		}
	}
?>