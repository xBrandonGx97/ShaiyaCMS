<?php
# Start Template
Template::_start_mainSection();
Template::Separator(20);
Template::_do_pageHead("Authentication Required","Please log in to continue");
	$Valid = isset($_GET["Valid"]) ? Data::escData(trim($_GET["Valid"])) : false;
	if(!empty($Valid)){
		if($Valid == 'true'){
			header('Refresh:2;url=../home');
			echo 'Login successful.<br>Loading your homepage now...';
		}
		else{
			echo 'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.';
		}
	}
	else{
		echo '<form action="../member/validate" method="POST">';
			Template::Separator("10");
			echo '<div class="row justify-content-center align-items-center">';
				echo '<div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">';
					echo '<div class="form-group">';
						?><input name="UserID" type="text" autocomplete="off" value="<?php if(isset($_COOKIE['login_id'])) { echo $_COOKIE['login_id']; } ?>" class="form-control" placeholder="Username" /><?php
					echo '</div>';

					echo '<div class="form-group">';
						?><input name="Pw" type="password" autocomplete="off" value="<?php if(isset($_COOKIE['login_password'])) { echo $_COOKIE['login_password']; } ?>" class="form-control" placeholder="Password" /> <?php
					echo '</div>';

					echo '<div class="form-group">';
						echo '<div class="text-center f_18">';
							echo '<input type="submit" name="sub_login" class="btn btn-sm btn-primary m_auto" value="Authenticate">';
						echo '</div>';
						echo '<input type="checkbox" name="remember-me">';
							echo '<label for="remember-me"> Remember Me</labe>';
					echo '</div>';
					echo '<div class="form-group login-links">';
						echo '<a href="../member/register">Register Account</a> |';
						echo '<a  href="../member/recoverpwd">Forgot Password</a>';
					echo '</div>';
					echo '<div class="form-group login-links">';
						echo '<a href="#" data-toggle="popover" data-content="Login to view or edit details related to your account.">Why would I need to log in here?</a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</form>';
	}
	# End Template
	Template::_do_pageFooter();
	Template::Separator(20);
	Template::_end_mainSection();
?>