<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Browser;
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	\Classes\Utils\Browser::run();
	
	# check if isset Google reCAPTCHA
	if (isset($_POST['g-recaptcha-response'])) {
		$captcha = $_POST['g-recaptcha-response'];
	}
	
	# Account
	$DisplayName = isset($_POST["DisplayName"]) ? Data::_do('escData', trim($_POST["DisplayName"])) : false;
	$UserName = isset($_POST["UserName"]) ? Data::_do('escData', trim($_POST["UserName"])) : false;
	$Password = isset($_POST["Password"]) ? Data::_do('escData', trim($_POST["Password"])) : false;
	$cPassword = isset($_POST["cPassword"]) ? Data::_do('escData', trim($_POST["cPassword"])) : false;
	$Pin = isset($_POST["Pin"]) ? Data::_do('escData', trim($_POST["Pin"])) : false;
	$Referer = isset($_POST["Referer"]) ? Data::_do('escData', trim($_POST["Referer"])) : false;
	# Personal
	$Email = isset($_POST["email"]) ? Data::_do('escData', trim($_POST["email"])) : false;
	$SecQuestion = isset($_POST["SecQuestion"]) ? Data::_do('escData', trim($_POST["SecQuestion"])) : false;
	$SecAnswer = isset($_POST["SecAnswer"]) ? Data::_do('escData', trim($_POST["SecAnswer"])) : false;
	# Terms of Use
	$Terms = isset($_POST["Terms"]) ? Data::_do('escData', trim($_POST["Terms"])) : false;
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
	$errors = array ();
	
	if (isset($_POST['doReg'])) {
		# Validate Display Name
		if (empty($DisplayName)) {
			$errors[] .= 'R-0x05';
		} else if (ctype_alnum($DisplayName) === false) {
			$errors[] .= 'R-0x24';
		} else {
			# Check If DisplayName Already Exists
			$CheckDisplayName = MSSQL::connect()->prepare("SELECT Count(DisplayName) FROM " . MSSQL::getTable('WEB_PRESENCE') . " WHERE DisplayName = ?");
			$CheckDisplayName->bindParam(1, $DisplayName, PDO::PARAM_STR);
			$CheckDisplayName->execute();
			$ChkDisplayName = $CheckDisplayName->fetchColumn();
			if ($ChkDisplayName > 0) {
				$errors[] .= 'R-0x25';
			}
		}
		# Validate Username
		if (empty($UserName)) {
			$errors[] .= 'R-0x01';
		} else if (strlen($UserName) < 3 || strlen($UserName) > 16) {
			$errors[] .= 'R-0x02';
		} else if (ctype_alnum($UserName) === false) {
			$errors[] .= 'R-0x03';
		} else {
			# Check if Username Already Exists
			$CheckUserID = MSSQL::connect()->prepare("SELECT Count(UserID) FROM " . MSSQL::getTable('WEB_PRESENCE') . " WHERE UserID = ?");
			$CheckUserID->bindParam(1, $UserName, PDO::PARAM_STR);
			$CheckUserID->execute();
			$ChkUser = $CheckUserID->fetchColumn();
			if ($ChkUser > 0) {
				$errors[] .= 'R-0x04';
			}
		}
		# Validate Password
		if (empty($Password)) {
			$errors[] .= 'R-0x06';
		} else if (strlen($Password) < 8 || strlen($Password) > 16) {
			$errors[] .= 'R-0x07';
		} else if (!$UpperCase) {
			$errors[] .= 'R-0x31';
		} else if (!$Number) {
			$errors[] .= 'R-0x32';
		} else if (!$SpecialChars) {
			$errors[] .= 'R-0x33';
		} else if ($Password != $cPassword) {
			$errors[] .= 'R-0x08';
		}
		
		# Validate Pin
		if (empty($Pin)) {
			$errors[] .= 'R-0x28';
		} else if (strlen($Pin) < 4 || strlen($Pin) > 6) {
			$errors[] .= 'R-0x29';
		} else if (!is_numeric($Pin)) {
			$errors[] .= 'R-0x30';
		}
		
		# Validate Email
		if (empty($Email)) {
			$errors[] .= 'R-0x11';
		} else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
			$errors[] .= 'R-0x12';
		} else {
			# Check If Email Already Exists
			$CheckEmail = MSSQL::connect()->prepare("SELECT Count(Email) FROM " . MSSQL::getTable('WEB_PRESENCE') . " WHERE Email = ?");
			$CheckEmail->bindParam(1, $Email, PDO::PARAM_STR);
			$CheckEmail->execute();
			$ChkEmail = $CheckEmail->fetchColumn();
			if ($ChkEmail > 0) {
				$errors[] .= 'R-0x13';
			}
		}
		# Validate security question.
		if (empty($SecQuestion)) {
			$errors[] .= 'R-0x14';
		}
		# Validate security answer.
		if (empty($SecAnswer)) {
			$errors[] .= 'R-0x15';
		}
		
		# Validate Terms of Use
		if (!isset($_POST['Terms']) || empty($_POST["Terms"])) {
			$errors[] .= 'R-0x16';
		}
		# Validate Google Response
		/*if ($response['success'] == false) {
			$errors[] .= 'R-0x27';
			#var_dump($response);
		}*/
		# Check errors
		if (count($errors)) {
			echo '<ul>';
			foreach ($errors as $error) {
				echo '<li>' . Data::_do('MessagesArr', $error) . '</li><br>';
			}
			echo '</ul>';
		}
		# If No Errors Continue
		if (count($errors) == 0) {
			$sql = ('
							INSERT INTO ' . MSSQL::getTable('WEB_PRESENCE') . '
								(UserID,Pw,PIN,DisplayName,Referer,SecQuestion,SecAnswer,ActivationKey,Email,UserIP)
							VALUES
								(?,?,?,?,?,?,?,?,?,?)
			');
			$stmt = MSSQL::connect()->prepare($sql);
			$stmt->bindParam(1, $UserName, PDO::PARAM_STR);
			$stmt->bindParam(2, $Password, PDO::PARAM_STR);
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
				echo 'Account for: ' . $UserName . ' Created Successfully.';
			} else {
				echo 'Account for: ' . $UserName . ' Could not be created. Please try again later.';
			}
			
			# Auto login
			$sql = ("
							SELECT * FROM " . MSSQL::getTable("SH_USERDATA") . " WHERE UserID=? AND PwPlain=?
			");
			$stmt = MSSQL::connect()->prepare($sql);
			$stmt->bindParam(1, $UserName, PDO::PARAM_STR);
			$stmt->bindParam(2, $Password, PDO::PARAM_STR);
			$stmt->execute();
			if ($fetchUserInfo = $stmt->fetch()) {
				$_SESSION['User']['UserUID'] = $fetchUserInfo['UserUID'];
				$_SESSION['User']['UserID'] = $fetchUserInfo['UserID'];
				$_SESSION['User']['Status'] = $fetchUserInfo['Status'];
				//Refresh page
				echo '<script>location.reload();</script>';
			}
		}
	}