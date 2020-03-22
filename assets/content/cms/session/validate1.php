<?php
	@ob_start();
	@session_start();
	echo '<div id="page-wrapper">';
		echo '<div id="auth">';
			echo 'Welcome to your Admin Panel, <span class="user">'.$_SESSION['uid'].'</span>.<br />';
			echo 'Please re-authenticate to continue.';
		echo '</div>';
	echo '</div>';
?>