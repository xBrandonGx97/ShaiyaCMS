<?php
	$errors=array();
	if(isset($_POST["submit-login"]) && !empty($_POST["submit-login"])){
	# Check For Username Field Population
	$username=isset($_POST["username"]) ? $this->Data->escData(trim($_POST["username"])) : false;
	$password=isset($_POST["password"]) ? $this->Data->escData(trim($_POST["password"])) : false;
		
		if(empty($username)){$errors[]="0x01";}
		else if(strlen($username) < 3 || strlen($username) > 16){$errors[]="0x02";}
		else if(ctype_alnum($username)===false){$errors[]="0x03";}
	# Check For Password Field Population
		if(empty($password)){$errors[]="0x04";}
		else if(strlen($password) < 3 || strlen($password) > 16){$errors[]="0x05";}
	# If No Errors | Continue
		if (empty($errors)){
	# Check if username already exists in the database.
			$sql = ("
						SELECT * FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE UserID=? AND Pw=?
			");
			$stmt = $this->db->conn->prepare($sql);
			$params = array($username,$password);
			if(!$stmt->execute($params)){$errors[]="0x06";}
			if($userInfo=$stmt->fetch()){

				# Remember me Function
				if($_POST['remember-me']){
					$hour = time() + 10 * 365 * 24 * 60 * 60;
					setcookie ("login_id",$username,$hour);
					setcookie ("login_password",$password,$hour);
				}

                    session_name("CMS_SESS_VALIDATED");
                    
					$_SESSION["uuid"]=$userInfo["UserUID"];
					$_SESSION["uid"]=$userInfo["UserID"];
					$_SESSION['Status'] = $userInfo['Status'];
					$_SESSION['Staff'] = $userInfo['Staff'];
                    
                    $_SESSION["CMS_SID"]		=	$this->Session->CREATE_SESSION($userInfo["UserID"]);
                    $this->Session->STORE_SESSION('Logged In - UserID/Pw Access for '.$userInfo["UserID"].' from '.$this->Browser->UserIP);
                    
					$this->User->_do_avatar($userInfo["UserUID"],$userInfo["UserID"]);
#					$this->LogSys->createLog("Login Successful");

					header("location: ?pageid=HOME");
	               # Acct locked by admin
				if ($userInfo["Status"]==0 || $userInfo["Status"]==-4 || $userInfo["Status"]==-13 || $userInfo["Status"]==-14){
                    $errors[]="0x08";
                    $this->Session->STORE_SESSION("Login attempt failed on banned account for $UserID from $UserIP.");
                }
				else{$errors[]="0x07";}
			}
			else{
				$errors[]="0x09";
			#	$this->LogSys->createLog("Login failed");
			}
			
		}
	}
	if (!($this -> User -> LoggedIn()) || (!isset($_SESSION['Status']))) {

		if(count($errors)){
			echo '<div id="error">';
				echo '<h1>Error!</h1>';
				echo '<div id="error-msg">';
				foreach($errors as $error){
					echo $this->Data->err_msg_login($error);
				}
				echo '</div>';
			echo '</div>';
		}
		$this->Tpl->_do_pageHead("Authentication Required","Please log in to continue");
		echo '<form method="POST">';
			$this->Tpl->Separator("10");
			echo '<div class="row justify-content-center align-items-center">';
				echo '<div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">';
					echo '<div class="form-group">';
						?><input name="username" type="text" value="<?php if(isset($_COOKIE['login_id'])) { echo $_COOKIE['login_id']; } ?>" class="form-control" placeholder="Username" /><?php
					echo '</div>';

					echo '<div class="form-group">';
						?><input name="password" type="password" value="<?php if(isset($_COOKIE['login_password'])) { echo $_COOKIE['login_password']; } ?>" class="form-control" placeholder="Password" /> <?php
					echo '</div>';

					echo '<div class="form-group">';
						echo '<div class="text-center f_18">';
							echo '<input type="submit" name="submit-login" class="btn btn-sm btn-primary m_auto" value="Authenticate">';
						echo '</div>';
						echo '<input type="checkbox" name="remember-me">';
							echo '<label for="remember-me"> Remember Me</labe>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</form>';
		$this->Tpl->_do_pageFooter();
#		echo '<a class="btn btn-sm btn-primary m_auto" href="#">Login</a>';
	} else {
#		echo '<a class="btn btn-sm btn-primary m_auto" href="?p=logout">Logout</a>';
	}
#		$this->Tpl->_do_pageFooter();
?>