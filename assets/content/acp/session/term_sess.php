<?php
	$errors=array();
	createLog("Logged out.");
	if(!isset($_SESSION['uuid']) || !$_SESSION['uid']){$errors[]='0x15';}
	if(count($errors)){
		echo '<div id="page-wrapper">';
			echo '<div id="auth">';
			foreach($errors as $error){
				echo error_msg($error);
			}
			echo '</div>';
		echo '</div>';
	}
?>