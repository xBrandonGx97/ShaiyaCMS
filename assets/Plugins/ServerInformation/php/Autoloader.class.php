<?php
	# Class Autoloader
	function __autoload($ClassName){
		$ClassName = str_replace("..","",$ClassName);
		require_once("../../classes/$ClassName.class.php");
	}
?>