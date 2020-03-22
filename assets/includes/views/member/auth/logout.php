<?php
		Session::CLOSE_SESSION(User::$UserUID);

		die(
			header("Location: ../home")
		);
?>