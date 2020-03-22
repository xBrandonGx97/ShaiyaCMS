<?php
/*
	echo '<pre>';
		var_dump($_POST);
	echo '</pre>';
	exit();
*/
	# Start Template
	$this->Tpl->_start_mainSection();
	$this->Tpl->Separator(20);
	$this->Tpl->_do_pageHead("Account Validation");

	if(isset($_POST["sub_login"])){
		$UserID	=	isset($_POST["UserID"])	?	$this->Data->escData(trim($_POST["UserID"]))	:	false;
		$Pw		=	isset($_POST["Pw"])		?	$this->Data->escData(trim($_POST["Pw"]))		:	false;
		# Error Checking
		$errors_body = array();

		if(empty($UserID) || $UserID== ""){
			$errors_body[].='A UserID is required. How else would you be able to log in?';
		}
		else if(strlen($UserID) < 3 || strlen($UserID) > 16){
			$errors_body[].='Your UserID must be between 3 and 16 characters in length.';
		}
		else if(ctype_alnum($UserID)===false){
			$errors_body[].='Your UserID must consist of numbers and letters only.<br>Special characters are not allowed.';
		}
		if(empty($Pw)){
			$errors_body[].='A password is required for all accounts.<br>Please provide a password.';
		}
		else if(strlen($Pw) < 3 || strlen($Pw) > 16){
			$errors_body[].='Your password must be between 3 and 16 characters in length.';
		}
		else if(ctype_alnum($Pw)===false){
			$errors_body[].='Your password must consist of numbers and letters only.<br>Special characters are not allowed.';
		}
		if(count($errors_body)==0){
			$sql = ("
						SELECT * FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE UserID=? AND Pw=?
			");
			$stmt = $this->db->conn->prepare($sql);
			$params = array($UserID,$Pw);
			if(!$stmt->execute($params)){
				$errors_body[].='Your password must consist of numbers and letters only.<br>Special characters are not allowed.';
			}
			if($userInfo=$stmt->fetch()){
				if($userInfo["Status"] == 0 || $userInfo["Status"] == 16 ||  $userInfo["Status"] == 17 || $userInfo["Status"] == 32 || $userInfo["Status"] == 48 || $userInfo["Status"] == 64 || $userInfo["Status"] == 80 || $userInfo["Status"] == 128 ){
					# Remember me Function
					if($_POST['remember-me']){
						$hour = time() + 10 * 365 * 24 * 60 * 60;
						setcookie("login_id",$UserID,$hour,"/",null,null,true);
						setcookie("login_password",$Pw,$hour,"/",null,null,true);
					}

					$_SESSION["uuid"]=$userInfo["UserUID"];
					$_SESSION["uid"]=$userInfo["UserID"];
					$_SESSION['Status'] = $userInfo['Status'];
					$_SESSION['Staff'] = $userInfo['Staff'];
					
					$_SESSION["CMS_SID"]		=	$this->Session->CREATE_SESSION($userInfo["UserID"]);
					$this->Session->STORE_SESSION('Logged In - UserID/Pw Access for '.$userInfo["UserID"].' from '.$this->Browser->UserIP);
					$this->User->_do_avatar($userInfo["UserUID"],$userInfo["UserID"]);

					header('location: ?'.$this->Setting->PAGE_PREFIX.'=AUTH&Valid=true');
				}
				elseif($userInfo['Status'] < 0){
					# Acct locked by admin
					$errors_body[].='Your account has been banned due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a Staff member.';
					$this->Session->STORE_SESSION("Login attempt failed on banned account for $UserID from $UserIP.");
				}
				else{
					echo '0x08';
				}
			}
			else{
				header('location: ?'.$this->Setting->PAGE_PREFIX.'=AUTH&Valid=false');
			}
		}
		if(count($errors_body)){
			echo '<ul>';
			foreach($errors_body as $error){
				echo '<li>'.$error.'</li>';
			}
			echo '</ul>';
		}
	}
	elseif(isset($_POST["sub_reg"])){
		# ACCOUNT
		$DisplayName	=	isset($_POST["DisplayName"])	?	$this->Data->escData(trim($_POST["DisplayName"]))	:	false;
		$UserID			=	isset($_POST["UserID"])			?	$this->Data->escData(trim($_POST["UserID"]))		:	false;
		$Password		=	isset($_POST["Password"])		?	$this->Data->escData(trim($_POST["Password"]))		:	false;
		$c_Password		=	isset($_POST["c_Password"])		?	$this->Data->escData(trim($_POST["c_Password"]))	:	false;
		$Referer		=	isset($_POST["Referer"])		?	$this->Data->escData(trim($_POST["Referer"]))		:	false;
		# PERSONAL
		$DOB			=	isset($_POST["DOB"])			?	$this->Data->escData(trim($_POST["DOB"]))			:	false;
		$Gender			=	isset($_POST["Gender"])			?	$this->Data->escData(trim($_POST["Gender"]))		:	false;
		$SecQuestion	=	isset($_POST["SecQuestion"])	?	$this->Data->escData(trim($_POST["SecQuestion"]))	:	false;
		$SecAnswer		=	isset($_POST["SecAnswer"])		?	$this->Data->escData(trim($_POST["SecAnswer"]))		:	false;
		$Email			=	isset($_POST["Email"])			?	$this->Data->escData(trim($_POST["Email"]))			:	false;
		$Avatar=false;
		# TOS
		$Checkbox		=	isset($_POST["Checkbox"])		?	$this->Data->escData(trim($_POST["Checkbox"]))		:	false;
		# MISC
		$ActivationKey	=	$this->Data->rand_str();
		$UserIP			=	$this->Browser->UserIP;
		# Error Checking
		$errors_body = array();

		if($this->Setting->DEBUG === "1"){
			echo '<div class="row">';
				echo '<div class="col-md-6">';
					echo 'Array 1<br>';
					echo '<pre>';
						var_dump($_POST);
					echo '</pre><br>';
				echo '</div>';

				echo '<div class="col-md-6">';
					echo 'Array 2<br>';
					echo '<pre>';
						echo 'Display Name: '.$RegInfo[0].'<br>';
						echo 'UserID: '.$RegInfo[1].'<br>';
						echo 'Pw: '.$RegInfo[2].'<br>';
						echo 'Conf Pw: '.$RegInfo[3].'<br>';
						echo 'Referer: '.$RegInfo[4].'<br>';
						echo 'DOB: '.$RegInfo[5].'<br>';
						echo 'Gender: '.$RegInfo[6].'<br>';
						echo 'Question: '.$RegInfo[7].'<br>';
						echo 'Answer: '.$RegInfo[8].'<br>';
						echo 'E-mail: '.$RegInfo[9].'<br>';
						echo 'Checkbox: '.$RegInfo[10].'<br>';
						echo 'UserIP: '.$RegInfo[11].'<br>';
						echo 'ActivationKey: '.$RegInfo[12].'<br>';
						echo 'ResendURI: '.$RegInfo[13].'<br>';
						echo 'ValidateURI: '.$RegInfo[14].'<br>';

					#	echo $this->MailSys->get_messages(0,$RegInfo);
					echo '</pre>';
				echo '</div>';
			echo '</div>';
			exit();
		}

		# Validate User Name
		if(empty($UserID)){
			$errors_body[].='Please provide a UserID.';
		}else if(strlen($UserID) < 3 || strlen($UserID) > 16){
			$errors_body[].='UserID must be between 3 and 16 characters in length.';
		}else if(ctype_alnum($UserID) === false){
			$errors_body[].='UserID must consist of numbers and letters only.';
		}else{
		# Check if Username Already Exists
		$CheckUserID = $this->db->conn->prepare("SELECT Count(UserID) FROM ".$this->db->get_TABLE('SH_USERDATA')." WHERE UserID = :UserID");
		$CheckUserID->execute(array(':UserID'=>$UserID));
		$ChkUser = $CheckUserID->fetchColumn();
			if($ChkUser>0){
				$errors_body[].='UserID already exists, please choose a different UserID.';
			}
		}
		# Validate Display Name
		if(empty($DisplayName)){
			$errors_body[].='Please provide a display name for others to see.';
		}else if(ctype_alnum($DisplayName) === false){
			$errors_body[].='Display name must consist of numbers and letters only.';
		}
		# Check If DisplayName Already Exists
		$CheckDisplayName = $this->db->conn->prepare("SELECT Count(DisplayName) FROM ".$this->db->get_TABLE('WEB_PRESENCE')." WHERE DisplayName = :DisplayName");
		$CheckDisplayName->execute(array(':DisplayName'=>$DisplayName));
		$ChkDisplayName = $CheckDisplayName->fetchColumn();
		if($ChkDisplayName>0){
			$errors_body[].='Display Name is already In Use.';
		}
		# Validate security question.
    	if(empty($SecQuestion)) {
			$errors_body[].='Please provide a Security Question.';
		}
    	# Validate security answer.
    	if(empty($SecAnswer)) {
			$errors_body[].='Please provide a Security Answer.';
		}
		# Validate user password.
		if(empty($Password)){
			$errors_body[].='Please provide a password.';
		}else if(strlen($Password) < 3 || strlen($Password) > 16){
			$errors_body[].='Password must be between 3 and 16 characters in length.';
		}else if($Password != $c_Password){
			$errors_body[].='Passwords do not match.';
		}
		# Validate Email
		if(empty($Email)){
			$errors_body[].='Please provide your e-mail.';
		}else if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
			$errors_body[].='Invalid e-mail format.';
		}else{
		# Check If Email Already Exists
		$CheckEmail = $this->db->conn->prepare("SELECT Count(Email) FROM ".$this->db->get_TABLE('WEB_PRESENCE')." WHERE Email = :Email");
		$CheckEmail->execute(array(':Email'=>$Email));
		$ChkEmail = $CheckEmail->fetchColumn();
			if($ChkEmail>0){
				$errors_body[].='The e-mail address provided has already been used. Please choose a different e-mail address.';
			}
		}
		# Avatar Upload
		$ImageName = @$_FILES['Avatar']['name'];
		$fileElementName = 'Avatar';
		$path = 'assets/Themes/Standard/images/profile/avatars/'; 
		$location = $path . @$_FILES['Avatar']['name']; 
		move_uploaded_file(@$_FILES['Avatar']['tmp_name'], $location);
		if(isset($_FILES['Avatar']) && !empty($_FILES['Avatar']['name'])) { 
			# Avatar Found
		}
		else{
			$errors_body[].='no Avatar';
		}
		# Check If ToS Checked
		if(!isset($_POST['Checkbox']) || empty($_POST["Checkbox"])){
			$errors_body[].='You must agree to our Terms Of Use to register.';
		}
		if(count($errors_body)==0){
			$REG_USER	=	$this->SQL->REGISTER_USER_GAME($UserID,$Password,$UserIP);
			$REG_WEB	=	$this->SQL->REGISTER_USER_WEB($UserID,$Password,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP,$ImageName);
			# Auto login
			$sql = ("
						SELECT * FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE UserID=? AND Pw=?
			");
			$stmt = $this->db->conn->prepare($sql);
			$params = array($UserID,$Password);
			$stmt->execute($params);
			if($fetchUserInfo=$stmt->fetch()){
				$_SESSION["uuid"] = $fetchUserInfo['UserUID'];
				$_SESSION["uid"] = $UserID;
				$_SESSION["Status"] = $fetchUserInfo['Status'];
				$_SESSION["Staff"] = $fetchUserInfo['Staff'];
				$_SESSION["CMS_SID"] =	$this->Session->CREATE_SESSION($fetchUserInfo["UserID"]);
			}
		}
		if(count($errors_body)){
			echo '<ul>';
			foreach($errors_body as $error){
				echo '<li>'.$error.'</li>';
			}
			echo '</ul>';
		}
	}
	# End Template
	$this->Tpl->_do_pageFooter();
	$this->Tpl->Separator(20);
	$this->Tpl->_end_mainSection();
?>