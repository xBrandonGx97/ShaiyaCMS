<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');
	
	$UserUID = isset($_POST["id"]) ? Data::_do('escData', trim($_POST["id"])) : false;
	$Category = isset($_POST["Category"]) ? Data::_do('escData', trim($_POST["Category"])) : false;
	$Subject = isset($_POST["Subject"]) ? Data::_do('escData', trim($_POST["Subject"])) : false;
	$Message = isset($_POST["Message"]) ? Data::_do('escData', trim($_POST["Message"])) : false;
	$TicketKey = Data::_do('member_id_rand');
	# Error Checking
	$errors = array();
	
	if(empty($UserUID)) {
		$errors[]  .=  'UserUID can not be empty.';
	}
	if(empty($Category) || $Category=='Choose One') {
		$errors[]  .=  'Category can not be empty.';
	}
	if(empty($Subject)) {
		$errors[]  .=  'Subject can not be empty.';
	}
	if(empty($Message)) {
		$errors[]  .=  'Message can not be empty.';
	}
	# If No Errors Continue
	if(count($errors)==0) {
		$sql1 = ("
					SELECT TOP 1 TicketID
					FROM " . MSSQL::getTable("SH_TICKETS") . "
					ORDER BY TicketID DESC
		");
		$stmt1 = MSSQL::connect()->prepare($sql1);
		$stmt1->execute();
		
		$arr = $stmt1->FETCH();
		$checkTicketID = $arr["TicketID"];
		$TicketID = $checkTicketID + 1;
		
		$sql = ("
							INSERT INTO " . MSSQL::getTable("SH_TICKETS") . "
							(UserUID,TicketID,Type,Status,Category,Subject,Message,Main,TicketKey)
							VALUES (?,?,?,?,?,?,?,?,?)
				");
		$stmt = MSSQL::connect()->prepare($sql);
		$stmt->bindParam(1, $UserUID, PDO::PARAM_INT);
		$stmt->bindParam(2, $TicketID, PDO::PARAM_INT);
		$stmt->bindValue(3, 0, PDO::PARAM_INT);
		$stmt->bindValue(4, 1, PDO::PARAM_INT);
		$stmt->bindParam(5, $Category, PDO::PARAM_STR);
		$stmt->bindParam(6, $Subject, PDO::PARAM_STR);
		$stmt->bindParam(7, $Message, PDO::PARAM_STR);
		$stmt->bindValue(8, 1, PDO::PARAM_INT);
		$stmt->bindParam(9, $TicketKey, PDO::PARAM_STR);
		$stmt->execute();
		
		echo '<div class="text-center">';
			echo 'UserUID: ' . $UserUID . '<br>';
			echo 'TicketID: ' . $TicketID . '<br>';
			echo 'Category: ' . $Category . '<br>';
			echo 'Subject: ' . $Subject . '<br>';
			echo 'Sent Message: ' . $Message . '<br>';
			echo 'Ticket Key: ' . $TicketKey . '<br>';
		echo '</div>';
	}
	# Check Errors
	if(count($errors)){
		echo '<ul>';
		foreach($errors as $error){
			echo '<li>'.$error.'</li><br>';
		}
		echo '</ul>';
	}