<?php
	define('AJAX_CALL', true);
	# Autoloader
	require_once($_SERVER['DOCUMENT_ROOT'] . "/../app/bootstrap.php");
	Bootstrap::_is_ajax();
	
	use \Classes\Utils\Data;
	use \Classes\DB\MSSQL;
	
	\Classes\Utils\Session::init('Default');

	$UserUID	=	$_REQUEST['UserUID'];
	$ticketID 	= 	$_REQUEST['TicketID'];
	$Category 	= 	$_REQUEST['Category'];
	$Subject	=	$_REQUEST['Subject'];
	$Message	=	$_REQUEST['Message'];

	if($_POST["UserUID"] && !empty($_POST["UserUID"])){
		$sql = ("
					INSERT INTO ".MSSQL::getTable("SH_TICKETS")."
						(UserUID,ticketID,Type,Status,Category,Subject,Message,Main)
					VALUES
						(?,?,?,?,?,?,?,?)
		");
		$stmt   =   MSSQL::connect()->prepare($sql);
		$stmt   ->  bindParam(1, $UserUID, PDO::PARAM_INT);
		$stmt   ->  bindParam(2, $ticketID, PDO::PARAM_INT);
		$stmt   ->  bindValue(3, 0, PDO::PARAM_INT);
		$stmt   ->  bindValue(4, 1, PDO::PARAM_INT);
		$stmt   ->  bindParam(5, $Category, PDO::PARAM_STR);
		$stmt   ->  bindParam(6, $Subject, PDO::PARAM_STR);
		$stmt   ->  bindParam(7, $Message, PDO::PARAM_STR);
		$stmt   ->  bindValue(8, 0, PDO::PARAM_INT);

		if($stmt->execute()){
			$sql = ("
						UPDATE ".MSSQL::getTable("SH_TICKETS")."
						SET Status=?
						WHERE TicketID=? AND Main=?
			");
			$stmt   =   MSSQL::connect()->prepare($sql);
			$stmt   ->  bindValue(1, 1, PDO::PARAM_INT);
			$stmt   ->  bindParam(2, $ticketID, PDO::PARAM_INT);
			$stmt   ->  bindValue(3, 1, PDO::PARAM_INT);
			$stmt   ->  execute();

			echo '<button class="badge badge-success text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Support ticket has been successfully updated.</button>';
		}else{
			echo '<button class="badge badge-danger text-center w_100_p fs_20"><i class="fa fa-info-circle"></i> Support ticket update failed.</button>';
		}
	}
	
?>