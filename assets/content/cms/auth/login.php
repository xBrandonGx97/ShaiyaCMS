<?php
$this->Tpl->_do_pageHead("Authentication Required","Please log in to continue");
	$Valid = isset($_GET["Valid"]) ? $this->Data->escData(trim($_GET["Valid"])) : false;
	if(!empty($Valid)){
		if($Valid == 'true'){
			header('Refresh:2;url=?'.$this->Setting->PAGE_PREFIX.'=HOME');
			echo 'Login successful.<br>Loading your homepage now...';
		}
		else{
			echo 'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.';
		}
	}
	else{
		echo '<form action="?'.$this->Setting->PAGE_PREFIX.'=VALIDATE" method="POST">';
			$this->Tpl->Separator("10");
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
						echo '<a href="?'.$this->Setting->PAGE_PREFIX.'=REGISTER">Register Account</a> |';
						echo '<a  href="?'.$this->Setting->PAGE_PREFIX.'=RCVR_PW">Forgot Password</a>';
					echo '</div>';
					echo '<div class="form-group login-links">';
						echo '<a href="#" data-toggle="popover" data-content="Login to view or edit details related to your account.">Why would I need to log in here?</a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</form>';
	}
	$this->Tpl->_do_pageFooter();
?>