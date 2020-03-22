<?php
	# Class Autoloader
	function __autoload($ClassName){
		$HomeDir		=	realpath("../../../../");
		$ScriptDir		=	dirname(__FILE__);

		$ClassName		=	str_replace("..","",$ClassName);
		$ClassFileName	=	"$ClassName.class.php";
		$ClassDir		=	"$HomeDir/classes/";

		if(is_file($ClassDir.$ClassFileName)){
			require_once($ClassDir.$ClassFileName);
		}else{
			echo '<div class="container">';
				echo '<pre>';
					echo "Class, <b>$ClassName</b>, couldn't be found at <b>$ClassDir</b>!<br><br>";
					echo "<b>Script Information</b><br>";
					echo $ClassDir.$ClassFileName."<br>";
					echo "Base Directory: $HomeDir<br>";
					echo "Autoloader location: $ScriptDir";
				echo '</pre>';
			echo '</div>';
			die();
		}
	}
?>