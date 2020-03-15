<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Browser;
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	use \Classes\Utils\Session;
	
	Session::init('Default');
	Browser::run();
	
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
	
	if ($contentType === "application/json") {
		//Receive the RAW post data.
		$content = trim(file_get_contents("php://input"));
		
		$decoded = json_decode($content, true);
		
		//If json_decode succeeded, the JSON is valid.
		if(is_array($decoded)) {
			# check if isset Google reCAPTCHA
			if (isset($_POST['g-recaptcha-response'])) {
				$captcha = $_POST['g-recaptcha-response'];
			}
			
			# Account
			$DisplayName = isset($decoded["display"]) ? Data::_do('escData', trim($decoded["display"])) : false;
			$UserName = isset($decoded["user"]) ? Data::_do('escData', trim($decoded["user"])) : false;
			$Password = isset($decoded["pw"]) ? Data::_do('escData', trim($decoded["pw"])) : false;
			$cPassword = isset($decoded["repeat_pw"]) ? Data::_do('escData', trim($decoded["repeat_pw"])) : false;
			$hashedPassword	=	password_hash($Password, PASSWORD_DEFAULT);
			#$Referer = isset($decoded["Referer"]) ? Data::_do('escData', trim($decoded["Referer"])) : false;
			# Personal
			$Email = isset($decoded["email"]) ? Data::_do('escData', trim($decoded["email"])) : false;
			$SecQuestion = isset($decoded["security_question"]) ? Data::_do('escData', trim($decoded["security_question"])) : false;
			$SecAnswer = isset($decoded["security_answer"]) ? Data::_do('escData', trim($decoded["security_answer"])) : false;
			# Terms of Use
			$Terms = isset($decoded["terms"]) ? Data::_do('escData', trim($decoded["terms"])) : false;
			# Misc
			$UserIP = Browser::$IP;
			$ActivationKey = Data::_do('rand_str');
			#$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".Settings::$secretkey."&response=$captcha&remoteip=$UserIP"),true);
			# Preg Match
			$UpperCase = preg_match('@[A-Z]@', $Password);
			$LowerCase = preg_match('@[a-z]@', $Password);
			$Number = preg_match('@[0-9]@', $Password);
			$SpecialChars = preg_match('@[^\w]@', $Password);
			# Error Checking
			$errors = [];
			$arr	=	[
					'finished' => '',
					'errors' => []
			];
			
			if (isset($decoded['register'])) {
				# Validate Username
				if (empty($UserName)) {
					$arr['errors'][] .= '1';
				} else if (strlen($UserName) < 3 || strlen($UserName) > 16) {
					$arr['errors'][] .= '2';
				} else if (ctype_alnum($UserName) === false) {
					$arr['errors'][] .= '3';
				} else {
					# Check if Username Already Exists
					$CheckUserID = MSSQL::connect()->prepare("SELECT Count(UserID) FROM " . MSSQL::getTable('WEB_PRESENCE') . " WHERE UserID = ?");
					$CheckUserID->bindParam(1, $UserName, PDO::PARAM_STR);
					$CheckUserID->execute();
					$ChkUser = $CheckUserID->fetchColumn();
					if ($ChkUser > 0) {
						$arr['errors'][] .= '4';
					}
				}
				# Validate Display Name
				if (empty($DisplayName)) {
					$arr['errors'][] .= '5';
				} else if (ctype_alnum($DisplayName) === false) {
					$arr['errors'][] .= '6';
				} else {
					# Check If DisplayName Already Exists
					$CheckDisplayName = MSSQL::connect()->prepare("SELECT Count(DisplayName) FROM " . MSSQL::getTable('WEB_PRESENCE') . " WHERE DisplayName = ?");
					$CheckDisplayName->bindParam(1, $DisplayName, PDO::PARAM_STR);
					$CheckDisplayName->execute();
					$ChkDisplayName = $CheckDisplayName->fetchColumn();
					if ($ChkDisplayName > 0) {
						$arr['errors'][] .= '7';
					}
				}
				# Validate Email
				if (empty($Email)) {
					$arr['errors'][] .= '8';
				} else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
					$arr['errors'][] .= '9';
				} else {
					# Check If Email Already Exists
					$CheckEmail = MSSQL::connect()->prepare("SELECT Count(Email) FROM " . MSSQL::getTable('WEB_PRESENCE') . " WHERE Email = ?");
					$CheckEmail->bindParam(1, $Email, PDO::PARAM_STR);
					$CheckEmail->execute();
					$ChkEmail = $CheckEmail->fetchColumn();
					if ($ChkEmail > 0) {
						$arr['errors'][] .= '10';
					}
				}
				# Validate Password
				if (empty($Password)) {
					$arr['errors'][] .= '11';
				} else if (strlen($Password) < 8 || strlen($Password) > 16) {
					$arr['errors'][] .= '12';
				} else if (!$UpperCase) {
					$arr['errors'][] .= '13';
				} else if (!$Number) {
					$arr['errors'][] .= '14';
				} else if (!$SpecialChars) {
					$arr['errors'][] .= '15';
				} else if ($Password != $cPassword) {
					$arr['errors'][] .= '16';
				}
				
				/*# Validate Pin
				if (empty($Pin)) {
					$arr['errors'][] .= 'R-0x28';
				} else if (strlen($Pin) < 4 || strlen($Pin) > 6) {
					$arr['errors'][] .= 'R-0x29';
				} else if (!is_numeric($Pin)) {
					$arr['errors'][] .= 'R-0x30';
				}*/
				
				# Validate security question.
				if (empty($SecQuestion)) {
					$arr['errors'][] .= '17';
				}
				# Validate security answer.
				if (empty($SecAnswer)) {
					$arr['errors'][] .= '18';
				}
				
				# Validate Terms of Use
				if (!isset($Terms) || empty($Terms)) {
					$arr['errors'][] .= '19';
				}
				# Validate Google Response
				/*if ($response['success'] == false) {
					$errors[] .= 'R-0x27';
					#var_dump($response);
				}*/
				# Check errors
				if (count($arr['errors'])) {
					#echo '<ul>';
					foreach($arr['errors'] as $error){
						#echo '<li>' . Data::_do('MessagesArr', $error) . '</li><br>';
					}
					#echo '</ul>';
				}
				# If No Errors Continue
				if (count($arr['errors']) == 0) {
					$sql = ('
									INSERT INTO ' . MSSQL::getTable('WEB_PRESENCE') . '
										(UserID,Pw,PIN,DisplayName,Referer,SecQuestion,SecAnswer,ActivationKey,Email,UserIP)
									VALUES
										(?,?,?,?,?,?,?,?,?,?)
					');
					$stmt = MSSQL::connect()->prepare($sql);
					$stmt->bindParam(1, $UserName, PDO::PARAM_STR);
					$stmt->bindParam(2, $hashedPassword, PDO::PARAM_STR);
					$stmt->bindParam(3, $Pin, PDO::PARAM_STR);
					$stmt->bindParam(4, $DisplayName, PDO::PARAM_STR);
					$stmt->bindParam(5, $Referer, PDO::PARAM_STR);
					$stmt->bindParam(6, $SecQuestion, PDO::PARAM_STR);
					$stmt->bindParam(7, $SecAnswer, PDO::PARAM_STR);
					$stmt->bindParam(8, $ActivationKey, PDO::PARAM_STR);
					$stmt->bindParam(9, $Email, PDO::PARAM_STR);
					$stmt->bindParam(10, $UserIP, PDO::PARAM_STR);
					$sql1 = ('
									INSERT INTO ' . MSSQL::getTable('SH_USERDATA') . '
										(UserID,Pw,UserIP)
									VALUES
										(?,?,?)
					');
					$stmt1 = MSSQL::connect()->prepare($sql1);
					$stmt1->bindParam(1, $UserName, PDO::PARAM_STR);
					$stmt1->bindParam(2, $Password, PDO::PARAM_STR);
					$stmt1->bindParam(3, $UserIP, PDO::PARAM_STR);
					if ($stmt->execute() && $stmt1->execute()) {
						#echo 'Account for: ' . $UserName . ' Created Successfully.';
						$arr['finished']  .=  'true';
					} else {
						#echo 'Account for: ' . $UserName . ' Could not be created. Please try again later.';
					}
					
					# Auto login
					$sql = ("
								SELECT [U].[UserUID],[U].[UserID],[U].[Status] FROM " . MSSQL::getTable("SH_USERDATA") . " AS [U]
								INNER JOIN " . MSSQL::getTable("WEB_PRESENCE") . " AS [WP] ON [U].[UserID] = [WP].[UserID]
								WHERE [WP].[UserID]=? AND [WP].[Pw]=?
					");
					$stmt = MSSQL::connect()->prepare($sql);
					$stmt->bindParam(1, $UserName, PDO::PARAM_STR);
					$stmt->bindParam(2, $hashedPassword, PDO::PARAM_STR);
					$stmt->execute();
					if ($fetchUserInfo = $stmt->fetch()) {
						$_SESSION['User']['UserUID'] = $fetchUserInfo['UserUID'];
						$_SESSION['User']['UserID'] = $fetchUserInfo['UserID'];
						$_SESSION['User']['Status'] = $fetchUserInfo['Status'];
						Bootstrap::load_defaults();
						//Refresh page
						#echo '<script>location.reload();</script>';
					}
				}
				echo json_encode($arr);
			}
		}
	}