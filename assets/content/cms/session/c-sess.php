<?php
	$errors=array();
	if(!isset($_SESSION['uuid']) || !$_SESSION['uid']){$errors[]='0x13';}
	elseif(!isset($_SESSION['Status'])){$errors[]='0x14';}
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