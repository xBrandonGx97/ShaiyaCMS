<?php
		$this->Tpl->_do_pageHead("Account Registration","Please sign up");
		# Account
		$DisplayName	=	isset($_POST["DisplayName"])	?	$this->Data->escData(trim($_POST["DisplayName"]))	:	false;
		$UserID			=	isset($_POST["UserID"])			?	$this->Data->escData(trim($_POST["UserID"]))		:	false;
		$Password		=	isset($_POST["Password"])		?	$this->Data->escData(trim($_POST["Password"]))		:	false;
		$c_Password		=	isset($_POST["c_Password"])		?	$this->Data->escData(trim($_POST["c_Password"]))	:	false;
		$Referer		=	isset($_POST["Referer"])		?	$this->Data->escData(trim($_POST["Referer"]))		:	false;
		# Personal
		$DOB			=	isset($_POST["DOB"])			?	$this->Data->escData(trim($_POST["DOB"]))			:	false;
		$Gender			=	isset($_POST["Gender"])			?	$this->Data->escData(trim($_POST["Gender"]))		:	false;
		$SecQuestion	=	isset($_POST["SecQuestion"])	?	$this->Data->escData(trim($_POST["SecQuestion"]))	:	false;
		$SecAnswer		=	isset($_POST["SecAnswer"])		?	$this->Data->escData(trim($_POST["SecAnswer"]))		:	false;
		$Email			=	isset($_POST["Email"])			?	$this->Data->escData(trim($_POST["Email"]))			:	false;
		# TOS
		$Checkbox		=	isset($_POST["Checkbox"])		?	$this->Data->escData(trim($_POST["Checkbox"]))		:	false;
		# MISC
		$ActivationKey	=	$this->Data->rand_str();
		$UserIP			=	$this->Browser->UserIP;
		# Display Errors/Success
		$errors = array();
		$success = false;
	
if(isset($_POST["sub_reg"])){
	# Validate User Name
	if(empty($UserID)){
		$errors[] = 'Please provide a user name.';
	}else if(strlen($UserID) < 3 || strlen($UserID) > 16){
		$errors[] = 'User name must be between 3 and 16 characters in length.';
	}else if(ctype_alnum($UserID) === false){
		$errors[] = 'User name must consist of numbers and letters only.';
	}else{
	# Check if Username Already Exists
	$CheckUserID = $this->db->conn->prepare("SELECT Count(UserID) FROM ".$this->db->get_TABLE('SH_USERDATA')." WHERE UserID = :UserID");
	$CheckUserID->execute(array(':UserID'=>$UserID));
	$ChkUser = $CheckUserID->fetchColumn();
		if($ChkUser>0){
			$errors[] = 'User name already exists, please choose a different user name.';
		}
	}
    
    # Validate Display Name
	if(empty($DisplayName)){
		$errors[] = 'Please provide a Display Name.';
	}else if(strlen($DisplayName) < 3 || strlen($DisplayName) > 16){
		$errors[] = 'Display Name must be between 3 and 16 characters in length.';
	}
    # Check If DisplayName Already Exists
	$CheckDisplayName = $this->db->conn->prepare("SELECT Count(DisplayName) FROM ".$this->db->get_TABLE('WEB_PRESENCE')." WHERE DisplayName = :DisplayName");
	$CheckDisplayName->execute(array(':DisplayName'=>$DisplayName));
	$ChkDisplayName = $CheckDisplayName->fetchColumn();
	if($ChkUser>0){
		$errors[] = 'Display Name is already Registered.';
	}
    
     # Validate security question.
    if(empty($SecQuestion)) {$errors["SecQuestion"] = "Please provide a Security Question.";}
    
    # Validate security answer.
    if(empty($SecAnswer)) {$errors["SecAnswer"] = "Please provide a Security Answer.";}
	
	// Validate user password.
	if(empty($Password)){
		$errors[] = 'Please provide a password.';
	}else if(strlen($Password) < 3 || strlen($Password) > 16){
		$errors[] = 'Password must be between 3 and 16 characters in length.';
	}else if($Password != $c_Password){
		$errors[] = 'Passwords do not match.';
	}
    
    // Validate Email
	if(empty($Email)){
		$errors[] = 'Please provide your email.';
	}else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Invalid email format';
	}else{
	# Check If Email Already Exists
	$CheckEmail = $this->db->conn->prepare("SELECT Count(Email) FROM ".$this->db->get_TABLE('WEB_PRESENCE')." WHERE Email = :Email");
	$CheckEmail->execute(array(':Email'=>$Email));
	$ChkEmail = $CheckEmail->fetchColumn();
		if($ChkEmail>0){
			$errors[] = 'Email already exists, please choose a different email..';
		}
	}
	
	# Check If ToS Checked
	if(!isset($_POST['Checkbox']) || empty($_POST["Checkbox"])){
		$errors[] = 'You must agree with Terms of Use';
	}
	
	// Persist the new account to the database if no previous errors occured.
	if(count($errors) == 0){
		$stmt = $this->db->conn->prepare("INSERT INTO ".$this->db->get_TABLE('SH_USERDATA')."
			(UserID,Pw,JoinDate,Admin,AdminLevel,UseQueue,Status,Leave,LeaveDate,UserType,Point,UserIp)
			VALUES (?,?,GETDATE(),0,0,0,0,0,GETDATE(),'N',0,?)
		");
		$params = array($UserID,$Password,$UserIP);
		$stmt2 = $this->db->conn->prepare("INSERT INTO ".$this->db->get_TABLE('WEB_PRESENCE')."
			(UserID,Pw,DisplayName,DOB,Gender,Referer,SecQuestion,SecAnswer,ActivationKey,Email,UserIP)
			VALUES (?,?,?,?,?,?,?,?,?,?,?)
		");
		$params2 = array($UserID,$Password,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP);
		if($stmt->execute($params) && $stmt2->execute($params2)){
			echo '<div class="user_info">';
			$success =  "Your account ".$UserID." was successfully created!<br />";
            $success .= "Display Name: ".$DisplayName."<br />";
			$success .= "Password: ".$Password."<br />";
			$success .= "Email: ".$Email."<br />";
            echo '</div>';
		}
		else{
			$errors[] = 'Failed to create a new account, please try again later';
		}
	}
}

if(count($errors)){
			echo '<ul id="error">';
			foreach($errors as $error){
				echo '<li style="color:#8291A1">'.$error.'</li>';
			}
			echo '</ul>';
		} else {
		echo '<div id="success"><center>'.$success.'</center></div>';
		}
		echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
		echo '<form method="post" id="register">';
				echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="input-group col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-UserID" name="UserID" placeholder="Desired UserID" type="text" />';
									echo '<div class="input-group-append">';
										echo '<button class="btn badge badge-warning open_verify_userid_modal" data-id="" data-target="#verify_userid_modal" data-toggle="modal">Check</button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="input-group col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-DisplayName" name="DisplayName" placeholder="Desired Display Name" type="text"/>';
									echo '<div class="input-group-append">';
										echo '<button class="btn badge badge-warning open_verify_displayname_modal" data-id="" data-target="#verify_displayname_modal" data-toggle="modal">Check</button>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
							
							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-Password" name="Password" placeholder="Password" type="password" />';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-Password2" name="c_Password" placeholder="Confirm Password" type="password" />';
								echo '</div>';
							echo '</div>';
							
							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-Email" name="Email" placeholder="Email" type="text" />';
								echo '</div>';
							echo '</div>';
							
							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-DOB" name="DOB" placeholder="Date of Birth" type="text"/>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo $this->Select->gender();
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-Referer" name="Referer" placeholder="Referer" type="text"/>';
								echo '</div>';
							echo '</div>';
							
							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo $this->Select->sec_question();
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-SecAnswer" name="SecAnswer" placeholder="Security Answer" type="text"/>';
								echo '</div>';
							echo '</div>';
							
							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
									echo '<center>';
										echo '<input name="Checkbox" type="radio"/> I Agree to the <a href="?'.$this->Setting->PAGE_PREFIX.'=TERMS" target="_blank">'.$this->Setting->SITE_TITLE.' Terms Of Use</a>';
									echo '</center>';
							echo '</div>';
							
							echo '<div class="form-group row">';
								echo '<div class="col-md-12 tac">';
									echo '<button class="btn btn-sm btn-primary m_auto" type="submit" name="sub_reg">Create Account</button>';
								echo '</div>';
							echo '</div>';
							
							echo '<div class="separator_10"></div>';
							echo '</form>';
							echo '</div>';
							$this->Tpl->_do_pageFooter();
		$this->Modal->Display('verify_userid_modal','<i class="fa fa-pencil"></i>','0','2','Check UserID Availability');
		$this->Modal->Display('verify_displayname_modal','<i class="fa fa-pencil"></i>','0','2','Check Display Name Availability');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_verify_userid_modal',function(e){
			e.preventDefault();

			$('#verify_userid_modal #dynamic-content').html('');
			$('#verify_userid_modal #modal-loader').show();

			$.ajax({
				url: "AJAX/Site/Registration/verify_userid.php",
				type: 'POST',
				data: $('form#register').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				$('#verify_userid_modal #dynamic-content').html('');
				$('#verify_userid_modal #dynamic-content').html(data);
				$('#verify_userid_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#verify_userid_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#verify_userid_modal #modal-loader').hide();
			});
		});
		$(document).on('click','.open_verify_displayname_modal',function(e){
			e.preventDefault();

			$('#verify_displayname_modal #dynamic-content').html('');
			$('#verify_displayname_modal #modal-loader').show();

			$.ajax({
				url: "AJAX/Site/Registration/verify_displayname.php",
				type: 'POST',
				data: $('form').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
					console.log(data);
				<?php } ?>
				$('#verify_displayname_modal #dynamic-content').html('');
				$('#verify_displayname_modal #dynamic-content').html(data);
				$('#verify_displayname_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#verify_displayname_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#verify_displayname_modal #modal-loader').hide();
			});
		});
	});
</script>