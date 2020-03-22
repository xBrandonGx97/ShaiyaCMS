<?php
	class Messenger{

		public $text0;public $text1;public $text2;public $text3;public $text4;public $text5;public $text6;public $text7;public $text8;public $text9;
		public $text10;public $text11;public $text12;public $text13;public $text14;public $text15;public $text16;public $text17;public $text18;public $text19;

		protected $_systemMessage	=	null;

		function __construct($Browser,$Setting,$User){
			$this->Browser	=	$Browser;
			$this->Setting	=	$Setting;
			$this->User		=	$User;
		}
		function Init(){
			$messenger				=	array();
			$messenger["type"]		=	array();
			$messenger["head"]		=	array();
			$messenger["body"]		=	array();
			$messenger["footer"]	=	array();

			return $messenger;
		}
		function TextArr(){
			$Reg				=	array();
			$Reg["Text"]		=	array();

			return $Reg;
		}
		function Display($data){
			$return = false;
			if(isset($data["type"]) && count($data["type"]) > 0){
				for($i=0; $i < count($data["type"]); $i++){
					$return	.=	'<div class="container no_padding">';
						$return	.=	'<div class="row">';
							$return	.=	'<div class="col-md-12">';
								$return	.=	$this->Display_Alert_Type($data["type"][$i]);
								if(isset($data["head"]) && !empty($data["head"])){
									$return	.=	$this->Display_Header_Type($data["head"][$i]);
								}
	//								$return	.=	$this->Display_Header($data["type"][$i],$data["body"][$i]);
									$return	.=	$this->MessagesArr($data["body"][$i]);
								$return	.=	'</div>';
							$return	.=	'</div>';
						$return	.=	'</div>';
					$return	.=	'</div>';
				}
			}
			echo $return;
		}
		function Display_Header_Type($head){
			switch($head){
				case '0':	return '<h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> <strong>Danger!</strong></h4>';	break;
				case '1':	return '<h4 class="alert-heading"><i class="fa fa-info-circle"></i> <strong>Warning</strong></h4>';				break;
				case '2':	return '<h4 class="alert-heading"><i class="fa fa-info-circle"></i> <strong>Notice</strong></h4>';				break;
				case '3':	return '<h4 class="alert-heading"><i class="fa fa-check-circle"></i> <strong>Success</strong></h4>';			break;
			}
		}
		function Display_Alert_Type($type){
			switch($type){
				case '0':
					return '
						<div class="alert badge-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					';
					break;
				case '1':
					return '
						<div class="alert badge-warning alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					';
					break;
				case '2':
					return '
						<div class="alert badge-info alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					';
					break;
				case '3':
					return '
						<div class="alert badge-success alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					';
					break;
			}
		}
		function Display_Header($type,$body){
			switch($type){
				case '0':	return '<legend><font class="red">Error: '.$body.'</font></legend>';		break;
				case '1':	return '<legend><font class="orange">Warning: '.$body.'</font></legend>';	break;
				case '2':	return '<legend><font class="green">Notice: '.$body.'</font></legend>';		break;
				case '3':	return '<legend><font class="green">Success: '.$body.'</font></legend>';	break;
			}
		}
		function MessagesArr($data){
			switch($data){
				# SITE-WIDE MESSAGES
				case 'ERR-0x01' : return 'The page you are looking for either doesn\'t exist or has been moved.'; break;
				# LOGIN MSGS - STANDARD
				case 'SL-0x01': return 'A UserID is required. How else would you be able to log in?'; break;
				case 'SL-0x02': return 'Your UserID must be between 3 and 16 characters in length.'; break;
				case 'SL-0x03': return 'Your UserID must consist of numbers and letters only.<br>Special characters are not allowed.'; break;
				case 'SL-0x04': return 'A password is required for all accounts.<br>Please provide a password.'; break;
				case 'SL-0x05': return 'Your password must be between 3 and 16 characters in length.'; break;
				case 'SL-0x06': return 'Your password must consist of numbers and letters only.<br>Special characters are not allowed.'; break;
				case 'SL-0x08': return 'Login successful.<br>Loading your homepage now...'; break;
				case 'SL-0x09': return 'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.'; break;
				# LOGIN MSGS - SHAIYA
				case 'SHL-0x07': return 'Your account has been banned due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a GM or GS.'; break;
				# LOGIN MSGS - BDSM
				

				# Registration Messages
				# UserID
				case 'R-0x01': return 'Please provide a UserID.<br>'; break;
				case 'R-0x02': return 'UserID must be between 3 and 16 characters in length.<br>'; break;
				case 'R-0x03': return 'UserID must consist of numbers and letters only.<br>'; break;
				case 'R-0x04': return 'UserID already exists, please choose a different UserID.<br>'; break;
				# DisplayName
				case 'R-0x05': return 'Please provide a display name for others to see.<br>'; break;
				case 'R-0x024': return 'Display Name is already In Use.<br>'; break;
				case 'R-0x025': return 'Display name must consist of numbers and letters only.<br>'; break;
				# Password
				case 'R-0x06': return 'Please provide a password.<br>'; break;
				case 'R-0x07': return 'Password must be between 3 and 16 characters in length.<br>'; break;
				case 'R-0x08': return 'Passwords do not match.<br>'; break;
				# Date of Birth
				case 'R-0x09': return 'Please provide a Date of birth.<br>'; break;
				# Gender
				case 'R-0x10': return 'Please provide your Gender.<br>'; break;
				# E-Mail
				case 'R-0x11': return 'Please provide your e-mail.<br>'; break;
				case 'R-0x12': return 'Invalid e-mail format<br>'; break;
				case 'R-0x13': return 'The e-mail address provided has already been used. Please choose a different e-mail address.<br>'; break;
				# Security Q & A
				case 'R-0x14': return 'Please provide a Security Question.<br>'; break;
				case 'R-0x15': return 'Please provide a Security Answer.<br>'; break;
				# ToS
				case 'R-0x16': return 'You must agree to our Terms Of Use to register.<br>'; break;
				# Validation - User
				case 'R-0x17': return 'Game account creation has failed. Please contact an admin for assistance.<br>'; break;
				case 'R-0x18': return 'Your account, <font class="b_i">'.$_POST["UserID"].',</font> has been successfully created!<br>'; break;
				# Validation - Web
				case 'R-0x19': return 'Web account creation has failed. Please contact an admin for assistance.<br>'; break;
				case 'R-0x20': return 'Your web account, <font class="b_i">'.$_POST["DisplayName"].' for '.$_POST["UserID"].',</font> has been successfully created!<br>'; break;
				# Validation - Email
				case 'R-0x21': return 'Verification e-mail failed to send to the e-mail that you provided. Please contact an administrator for further assistance.<br>'; break;
				case 'R-0x22': return 'A verification email has been sent to <font class="b_i">'.$_POST["REG_TEXT"][9].'</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.<br>'; break;
				# Resend
				case 'R-0x23': return 'A verification email has been resent to <font class="b_i">'.$_POST["REG_TEXT"][9].'</font> with an activation key for the account <font class="b_i">'.$_SESSION["REG_TEXT"][1].'</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.<br>Still didn\'t receive the e-mail? Contact an administrator for further assistance.<br>'; break;
				# Misc
				case 'M-0x01': return 'I see that you\'re new here. You must <strong>Register</strong> in order to view the rest of <font class="b_i">My Domain</font>.<br>If you already have an account, you can update it by clicking <strong><a href="javascript:;" class="open_acct_reset_modal" data-id="UserIP~'.$this->Browser->UserIP.'" data-target="#acct_reset_modal" data-toggle="modal">here</a></strong><br>'; break;
				case 'M-0x02': return 'Welcome back, <strong>'.$this->User->UserID.'</strong>.<br>Please <strong>Log In</strong> and enjoy your stay here at <font class="b_i">'.$this->Setting->SITE_TITLE().'</font>.<br>'; break;
				# ACP E-Mail Test System
				case "EM-0x01": return "Check the receiver e-mail for the message you just sent.<br>";break;
				case "EM-0x02": return "<br>";break;
				case "EM-0x03": return "<br>";break;
				case "EM-0x04": return "<br>";break;
				case "EM-0x05": return "Validation email failed to send. Contact an administrator.<br>";break;
			}
		}
		function SysMsgsLogin(){
			if(!User::IsLoggedIn){
				echo '<div class="row modal_container">';
					echo '<div class="alert alert-danger" role="alert">';
						echo 'I\'ve noticed that you\'re not logged in. You must be logged in to use many features here.<br>';
						echo 'To log in, simply click on the welcome message at the top-right of this page & select either <b>Login</b> or <b>Register</b>.<br>';
						echo 'Doing so will grant access to aditional features currently unavailable to you.';
					echo '</div>';
				echo '</div>';
			}
		}
		function Close(){
			unset($modal);
			unset($_SESSION["MESSAGES"]);
		}
		function Props(){
			echo '<b>Messenger Class: Properties:</b>';
			echo '<pre>';
				print_r(get_object_vars($this));
			echo '</pre>';
		}
		public function getSystemMessages(){
			if(isset($this->_systemMessage) && is_array($this->_systemMessage)){
				return $this->_systemMessage;
			}
			else{
				return false;
			}
		}
		public function setSystemMessage($type, $text){
			// Create empty message array if it doesn't already exist
			if(isset($this->_systemMessage) && !is_array($this->_systemMessage)){
				$this->_systemMessage = array();
			}
			// Set the error message
			$this->_systemMessage[] = array(
				'type'  => $type,
				'text'  => $text
			);

			return true;
		}
	}
?>