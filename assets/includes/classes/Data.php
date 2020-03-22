<?php
	class Data{
		public static function escData($data){
			if(!isset($data) or empty($data)){
				return '';
			}

			if(is_numeric($data)){
				return $data;
			}

			$non_displayables = array(
										'/%0[0-8bcef]/',
										'/%1[0-9a-f]/',
										'/[\x00-\x08]/',
										'/\x0b/',
										'/\x0c/',
										'/[\x0e-\x1f]/'
//										'/<p\b[^>]*>(.*?)<\/p>/i'
			);

			foreach($non_displayables as $regex){
				$data = preg_replace($regex,'',$data);
				$data = str_replace("'","''",$data);
			}
			# Remove any indentations
			$data = str_replace("	","&#09;",$data);
			$data = str_replace("		","&#09;&#09;",$data);
			#$data = str_replace("     ","&nbsp;&nbsp;",$data);
			$data = str_replace("\t","&#09;",$data);
			$data = str_replace("\t\t","&#09;&#09;",$data);
			# Next replace unify all new-lines into unix LF
			$data = str_replace("\r","\n",$data);
			$data = str_replace("\n\n","\n",$data);
			# Replace all new lines with the unicode
			$data = str_replace("\n","<br>",$data);
			# Replace any new line entities between >< with a new line
			$data = str_replace(">&#10;<",">\n<",$data);

			return $data;
		}
		public static function getDateDiff($date1){
			# Time Difference
			$return = '~ ';
			$date1 = new DateTime($date1);
			$date2 = new DateTime(strtotime(time()));
			$diff = $date1->diff($date2);

			if ($diff->y != 0) {$diff->y == 1 ? $return .= '1y ' : $return .= $diff->y . 'y ';}
			if ($diff->m != 0) {$diff->m == 1 ? $return .= '1m ' : $return .= $diff->m . 'm ';}
			if ($diff->y != 0) {return $return . '';}
			if ($diff->d != 0) {$diff->d == 1 ? $return .= '1d ' : $return .= $diff->d . 'd ';}
			if ($diff->m != 0) {return $return . '';}
			if ($diff->h != 0) {$diff->h == 1 ? $return .= '1h ' : $return .= $diff->h . 'h ';}
			if ($diff->y == 0 && $diff->m == 0 && $diff->d != 0) {return $return . '';}
			if ($diff->i != 0) {$diff->i == 1 ? $return .= '1m ' : $return .= $diff->i . 'm ';}
			if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h != 0) {return $return . '';}
			if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i != 0) {return $return . '';}
			if ($diff->s != 0) {$diff->s == 1 ? $return .= '1s ' : $return .= $diff->s . 's ';}
			return $return . '';
		}
		public static function rand_str(){
			$alpha_num			=	'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$pass				=	array(); //remember to declare $pass as an array
			$alpha_num_length	=	strlen($alpha_num) - 1; //put the length -1 in cache

			for ($i=0;$i<64;$i++){
				$n		=	rand(0, $alpha_num_length);
				$pass[]	=	$alpha_num[$n];
			}

			return implode($pass); //turn the array into a string
		}
		public static function member_id_rand(){
			$random_string	=	rand(0,9).rand(0,9).rand(0,9).'-'.
								rand(0,9).rand(0,9).rand(0,9).'-'.
								rand(0,9).rand(0,9).rand(0,9).'-'.
								rand(0,9).rand(0,9).rand(0,9).'-'.
								rand(0,9).rand(0,9).rand(0,9);
			return $random_string;
			#return $this->verify_member_id_rand($random_string);
		}
		public static function chat_color($num){
			switch($num){
				case 1:		return 'normal';	break;
				case 2:		return 'whisper';	break;
				case 3:		return 'guild';		break;
				case 4:		return 'party';		break;
				case 5:		return 'trade';		break;
				case 6:		return 'yelling';	break;
				case 7:		return 'area';		break;
			}
		}
		public static function status_2_text($status,$color=false){
			$a=null;
			$b=null;

			switch($status){
				case 17		: $a .= 'Developer';				break;
				case 16		: $a .= 'Administrator';			break;
				case 32		: $a .= 'Game Master';				break;
				case 64		: $a .= 'Game Master Assistant'; 	break;
				case 128	: $a .= 'Game Sage'; 				break;
				case 0		: $a .= 'Member';					break;
				case -5		: $a .= 'Banned';					break;
				default		: $a .= 'Unverified';
			}

			switch($color){
				case 17		: $b .= '<span class="gold">'.$a.'</span>';			break;
				case 16		: $b .= '<span class="gold">'.$a.'</span>';			break;
				case 32		: $b .= '<span class="sky-blue">'.$a.'</span>';		break;
				case 64		: $b .= '<span class="sky-blue">'.$a.'</span>'; 	break;
				case 128	: $b .= '<span class="green">'.$a.'</span>'; 		break;
				case 0		: $b .= $a;											break;
				case -5		: $b .= $a; 										break;
				default		: $b .= $a;
			}

			if(!$b || empty($b)){
				$data=$a;
			}
			else{
				$data=$b;
			}

			return $data;
		}
		public static function online_status_2_text($data,$color=false){
			switch($data){
				case 0:
					if($color){
						return '<span class="label label-danger">Offline</span>';
					}
					else{
						return 'Offline';
					}
				break;
				case 1:
					if($color){
						return '<span class="label label-success">Online</span>';
					}
					else{
						return 'Online';
					}
				break;
			}
		}
		public static function err_msg_login($errors){ # Login Status Codes
		switch($errors){
		# Login Status Codes | Errors
			case 0x01:
				return 'A UserID is required.<br /><br />
						How else would you be able to log in?
						<div class="ui-dialog-content red tac">(Error Code: 0x01)</div>';
				break;
			case 0x02:
				return 'Your UserID must be between 3 and 16 characters in length.
						<div class="ui-dialog-content red tac">(Error Code: 0x02)</div>';
				break;
			case 0x03:
				return 'Your UserID must consist of numbers and letters only.<br /><br />
						Special characters are not allowed.
						<div class="ui-dialog-content red tac">(Error Code: 0x03)</div>';
				break;
			case 0x04:
				return 'A password is required for all accounts.<br /><br />
						Please provide a password.
						<div class="ui-dialog-content red tac">(Error Code: 0x04)</div>';
				break;
			case 0x05:
				return 'Your password must be between 3 and 16 characters in length.
						<div class="ui-dialog-content red tac">(Error Code: 0x05)</div>';
				break;
			case 0x06:
				return 'Invalid Username and/or password detected.<br /><br />
						An account with the Username/Password that you used was not found.
						Check your account information and try again.
						<div class="ui-dialog-content red tac">(Error Code: 0x06)</div>';
				break;
			case 0x07:
				return 'Your account has been banned due to rules infractions.<br /><br />
						To find out what infraction you were banned for, as well as ban period,<br />
						please ask a GM or GS.
						<div class="ui-dialog-content red tac">(Error Code: 0x07)</div>';
				break;
			case 0x08:
				return 'Your account has been locked per Administrative Action.<br /><br />
						For access, please request assistance from an Administrator.
						<div class="ui-dialog-content red tac">(Error Code: 0x08)</div>';
			case 0x09:
				return 'Your login attempt has failed!<br /><br />
						The Username and/or Password for your account seems to be invalid.<br /><br />
						If this issue persists, please request assistance from a GM or an ADM.
						<div class="ui-dialog-content red tac">(Error Code: 0x09)</div>';
				break;
			# placeholder
			}
		}
		public static function MessagesArr($data){
			switch($data){
				# SITE-WIDE MESSAGES
				case 'ERR-0x01' : return 'The page you are looking for either doesn\'t exist or has been moved.'; break;
				# LOGIN MSGS - STANDARD
				case 'L-0x01': return 'A Username or Email is required. How else would you be able to log in?'; break;
				case 'L-0x02': return 'Your UserID must be between 3 and 16 characters in length.'; break;
				case 'L-0x03': return 'Your UserID must consist of numbers and letters only.<br>Special characters are not allowed.'; break;
				case 'L-0x04': return 'A password is required for all accounts.<br>Please provide a password.'; break;
				case 'L-0x05': return 'Your password must be between 3 and 16 characters in length.'; break;
				case 'L-0x06': return 'Your password must consist of numbers and letters only.<br>Special characters are not allowed.'; break;
				case 'L-0x08': return 'Login successful.<br>Loading your homepage now...'; break;
				case 'L-0x09': return 'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.'; break;
				# LOGIN MSGS - SHAIYA
				case 'L-0x07': return 'Your account has been banned due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a GM or GS.'; break;

				# Registration Messages
				# Username
				case 'R-0x01': return 'Please provide a Username.'; break;
				case 'R-0x02': return 'Username must be between 3 and 16 characters in length.'; break;
				case 'R-0x03': return 'Username must consist of numbers and letters only.'; break;
				case 'R-0x04': return 'Username already exists, please choose a different Username.'; break;
				# DisplayName
				case 'R-0x05': return 'Please provide a Display name.'; break;
				case 'R-0x24': return 'Display name must consist of numbers and letters only.'; break;
				case 'R-0x25': return 'Display name already exists. please choose a different display name.'; break;
				# Password
				case 'R-0x06': return 'Please provide a password.'; break;
				case 'R-0x07': return 'Password must be between 3 and 16 characters in length.'; break;
				case 'R-0x08': return 'Passwords do not match.'; break;
				# Date of Birth
				case 'R-0x09': return 'Please provide a Date of birth.'; break;
				# Gender
				case 'R-0x10': return 'Please provide your Gender.'; break;
				# E-Mail
				case 'R-0x11': return 'Please provide your e-mail.'; break;
				case 'R-0x12': return 'Invalid e-mail format'; break;
				case 'R-0x13': return 'The e-mail address provided has already been used. Please choose a different e-mail address.'; break;
				# Security Q & A
				case 'R-0x14': return 'Please provide a Security Question.'; break;
				case 'R-0x15': return 'Please provide a Security Answer.'; break;
				# ToS
				case 'R-0x16': return 'You must agree to our Terms Of Use to register.'; break;
				# Validation - User
				case 'R-0x17': return 'Game account creation has failed. Please contact an admin for assistance.'; break;
				case 'R-0x18': return 'Your account, <font class="b_i">'.$_SESSION["REG_TEXT"][1].',</font> has been successfully created!'; break;
				# Validation - Web
				case 'R-0x19': return 'Web account creation has failed. Please contact an admin for assistance.'; break;
				case 'R-0x20': return 'Your web account, <font class="b_i">'.$_SESSION["REG_TEXT"][0].' for '.$_SESSION["REG_TEXT"][1].',</font> has been successfully created!'; break;
				# Validation - Email
				case 'R-0x21': return 'Verification e-mail failed to send to the e-mail that you provided. Please contact an administrator for further assistance.'; break;
				case 'R-0x22': return 'A verification email has been sent to <font class="b_i">'.$_SESSION["REG_TEXT"][9].'</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.'; break;
				# Resend
				case 'R-0x23': return 'A verification email has been resent to <font class="b_i">'.$_SESSION["REG_TEXT"][9].'</font> with an activation key for the account <font class="b_i">'.$_SESSION["REG_TEXT"][1].'</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.<br>Still didn\'t receive the e-mail? Contact an administrator for further assistance.'; break;
				# Misc
				case 'M-0x01': return 'I see that you\'re new here. You must <strong>Register</strong> in order to view the rest of <font class="b_i">My Domain</font>.<br>If you already have an account, you can update it by clicking <strong><a href="javascript:;" class="open_acct_reset_modal" data-id="UserIP~'.$this->Browser->UserIP.'" data-target="#acct_reset_modal" data-toggle="modal">here</a></strong>'; break;
				case 'M-0x02': return 'Welcome back, <strong>'.$this->User->UserID.'</strong>.<br>Please <strong>Log In</strong> and enjoy your stay here at <font class="b_i">'.Settings::SiteTitle().'</font>.'; break;
			}
		}
	}
?>