<?php
/*
	echo '<pre>';
		var_dump($_POST);
	echo '</pre>';
	exit();
*/
	if(isset($_POST["sub_login"])){
		$UserID	=	isset($_POST["UserID"])	?	$this->Data->escData(trim($_POST["UserID"]))	:	false;
		$Pw		=	isset($_POST["Pw"])		?	$this->Data->escData(trim($_POST["Pw"]))		:	false;

		if(empty($UserID) || $UserID == ""){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x01';
		}elseif(strlen($UserID) < 3 || strlen($UserID) > 16 ){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x02';
		}elseif(ctype_alnum($UserID) === false){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x03';
		}

		if(empty($Pw)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x04';
		}elseif(strlen($Pw) < 3 || strlen($Pw) > 16){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x05';
		}elseif(ctype_alnum($Pw) === false){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='SL-0x06';
		}
		if(count($_SESSION["MESSAGES"]['type']) == 0){
			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE('WEB_PRESENCE').'
							WHERE UserID=? AND Pw=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($UserID,$Pw);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					if($userInfo = odbc_fetch_array($stmt)){
						if($userInfo["Status"] == 0 || $userInfo["Status"] == 16 || $userInfo["Status"] == 32 || $userInfo["Status"] == 64){
							session_name("CMS_SESS_VALIDATED");

							$_SESSION["UserUID"]		=	$userInfo["UserUID"];
							$_SESSION["UserID"]			=	$userInfo["UserID"];
							$_SESSION["Status"]			=	$userInfo["Status"];
							$_SESSION["AdminLevel"]		=	$userInfo["AdminLevel"];
							$_SESSION["Email"]			=	$userInfo["Email"];

							$_SESSION["CMS_SID"]		=	$this->Session->CREATE_SESSION($userInfo["UserID"]);
							$this->Session->STORE_SESSION('Logged In - UserID/Pw Access for '.$userInfo["UserID"].' from '.$this->Browser->UserIP);

							$_SESSION["MESSAGES"]["type"][].='3';
							$_SESSION["MESSAGES"]["body"][].='SL-0x08';

							header('location: ?'.$this->Setting->PAGE_PREFIX.'=AUTH&Valid=true');
						}
						elseif($userInfo['Status'] < 0){
							# Acct locked by admin
							$_SESSION["MESSAGES"]["type"][].='0';
							$_SESSION["MESSAGES"]["body"][].='SL-0x07';
							$this->Session->STORE_SESSION("Login attempt failed on banned account for $UserID from $UserIP.");
						}
						else{
							$_SESSION["MESSAGES"]["type"][].='3';
							$_SESSION["MESSAGES"]["body"][].='L-0x08';
						}
					}
					else{
#						echo 'prep failed';
	#					$_SESSION["MESSAGES"]["type"][].='0';
	#					$_SESSION["MESSAGES"]["body"][].='L-0x09';
					}
				}
				else{
					echo 'Account not found!';
				}
			}
			else{
				echo 'Prep failed';
			}
		}
		else{
			header('location: ?'.$this->Setting->PAGE_PREFIX.'=Auth&Valid=false');
		}
	}
	elseif(isset($_POST["sub_reg"])){
		#require_once($this->Plugins->get_PHPMailer_DIR().'PHPMailerAutoload.php');

		# ACCOUNT
		$DisplayName	=	isset($_POST["DisplayName"])	?	$this->Data->escData(trim($_POST["DisplayName"]))	:	false;	#0
		$UserID			=	isset($_POST["UserID"])			?	$this->Data->escData(trim($_POST["UserID"]))		:	false;	#1
		$Password		=	isset($_POST["Password"])		?	$this->Data->escData(trim($_POST["Password"]))		:	false;	#2
		$c_Password		=	isset($_POST["c_Password"])		?	$this->Data->escData(trim($_POST["c_Password"]))	:	false;	#3
		$Referer		=	isset($_POST["Referer"])		?	$this->Data->escData(trim($_POST["Referer"]))		:	false;	#4
		# PERSONAL
		$DOB			=	isset($_POST["DOB"])			?	$this->Data->escData(trim($_POST["DOB"]))			:	false;	#5
		$Gender			=	isset($_POST["Gender"])			?	$this->Data->escData(trim($_POST["Gender"]))		:	false;	#6
		$SecQuestion	=	isset($_POST["SecQuestion"])	?	$this->Data->escData(trim($_POST["SecQuestion"]))	:	false;	#7
		$SecAnswer		=	isset($_POST["SecAnswer"])		?	$this->Data->escData(trim($_POST["SecAnswer"]))		:	false;	#8
		$EMail			=	isset($_POST["EMail"])			?	$this->Data->escData(trim($_POST["EMail"]))			:	false;	#9
		# TOS
		$Checkbox		=	isset($_POST["Checkbox"])		?	$this->Data->escData(trim($_POST["Checkbox"]))		:	false;	#10
		# MISC
		$UserIP			=	$this->Browser->UserIP;																				#11
		$ActivationKey	=	$this->Data->rand_str();																			#12
		$ResendURI		=	$this->Setting->SITE_DOMAIN.'?'.$this->Setting->PAGE_PREFIX.'=ResendValidation&Key='.$ActivationKey;			#13
		$ValidateURI	=	$this->Setting->SITE_DOMAIN.'?'.$this->Setting->PAGE_PREFIX.'=Validate&Key='.$ActivationKey;					#14

		$CheckUser		=	odbc_exec($this->db->conn,"SELECT UserID,Email FROM ".$this->db->get_TABLE('WEB_PRESENCE')." WHERE UserID='".$UserID."'");
		$CheckEmail		=	odbc_exec($this->db->conn,"SELECT Email FROM ".$this->db->get_TABLE('WEB_PRESENCE')." WHERE Email='".$EMail."'");

		$_SESSION["REG_TEXT"]	=	array(0=>$DisplayName,1=>$UserID,2=>$Password,3=>$c_Password,4=>$Referer,5=>$DOB,6=>$Gender,7=>$SecQuestion,8=>$SecAnswer,9=>$EMail,10=>$Checkbox,11=>$UserIP,12=>$ActivationKey,13=>$ResendURI,14=>$ValidateURI);
		$RegInfo = $_SESSION["REG_TEXT"];

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

		# Validate username
		if(empty($UserID)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x01';
		}elseif(strlen($UserID) < 3 || strlen($UserID) > 16){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x02';
		}elseif(ctype_alnum($UserID) === false){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x03';
		}
		elseif($row = odbc_fetch_array($CheckUser)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x04';
		}
		# DisplayName
		if(empty($DisplayName)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x05';
		}
		# Validate Passwords
		if(empty($Password)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x06';
		}elseif(strlen($Password) < 3 || strlen($Password) > 16){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x07';
		}elseif($Password != $c_Password){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x08';
		}
		# Date of Birth
		if(empty($DOB)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x09';
		}
		# Gender
		if(empty($Gender)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x10';
		}
		# Validate Email
		if(empty($EMail)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x11';
		}elseif(!filter_var($EMail,FILTER_VALIDATE_EMAIL)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x12';
		}elseif($row = odbc_fetch_array($CheckEmail)){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x13';
		}
		# Validate Checkbox
		if(!isset($_POST['Checkbox']) || empty($_POST["Checkbox"])){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x16';
		}

		if($this->Setting->DEBUG === "1"){
			echo 'Err Cnt: '.count($_SESSION["MESSAGES"]['type']);
			exit();
		}

		if(count($_SESSION["MESSAGES"]['type']) < 1){
			echo 'in err check zone';
			# create clause for different site types

			if($this->Setting->SITE_TYPE == 'SHAIYA'){
				$REG_USER	=	$this->SQL->REGISTER_USER_GAME($RegInfo[1],$RegInfo[2],$RegInfo[9],$RegInfo[11]);
				$REG_WEB	=	$this->SQL->REGISTER_USER_WEB($RegInfo[1],$RegInfo[2],$RegInfo[0],$RegInfo[5],$RegInfo[6],$RegInfo[4],$RegInfo[7],$RegInfo[8],$RegInfo[12],$RegInfo[9],$RegInfo[11]);
			}
#			elseif($this->Setting->SITE_TYPE === 0){
				$REG_WEB = $this->SQL->REGISTER_USER_WEB($RegInfo[1],$RegInfo[2],$RegInfo[0],$RegInfo[5],$RegInfo[6],$RegInfo[4],$RegInfo[7],$RegInfo[8],$RegInfo[12],$RegInfo[9],$RegInfo[11]);
#			}

			echo 'passed reg_web';
			if($REG_WEB){
				# Send Registration E-Mail
				if($this->MailSys->ENABLED){
					$MAIL_FOR	=	"register";
					$MAIL		=	new PHPMailer(true);
					$this->MailSys->do_SendMail($MAIL,$MAIL_FOR,$RegInfo);

					if(!$MAIL->Send()){
						$_SESSION["MESSAGES"]["type"][].='3';
						$_SESSION["MESSAGES"]["head"][].='0';
						$_SESSION["MESSAGES"]["body"][].='R-0x19';
						echo '<pre>';
							echo "Mailer Error: ".$MAIL->ErrorInfo;
						echo '</pre>';
					}
					else{
						$_SESSION["MESSAGES"]["type"][].='0';
						$_SESSION["MESSAGES"]["head"][].='0';
						$_SESSION["MESSAGES"]["body"][].='R-0x18';

						header('location: ?'.$this->Setting->PAGE_PREFIX.'=REGISTRATION_COMPLETE&Valid=true');
					}
				}

				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x20';

				header('location: ?'.$this->Setting->PAGE_PREFIX.'=REGISTER&Valid=true');
			}
		}
		else{
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["head"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x19';
		}
	}
	else{
		echo 'No submission data found!<br>';
		echo 'Are you sure that you filled out the form?';
	}
?>