<?php
    define('AJAX_CALL', true);
    # Autoloader
	require_once($_SERVER['DOCUMENT_ROOT']."/../app/bootstrap.php");
	Bootstrap::_is_ajax();

    use \Classes\Utils\Data;
    use \Classes\DB\MSSQL;
    use \Classes\Utils\Session;
    
    Session::init('Default');
	
    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    
    if ($contentType === "application/json") {
    	//Receive the RAW post data.
		$content = trim(file_get_contents("php://input"));
		
		$decoded = json_decode($content, true);
		
		//If json_decode succeeded, the JSON is valid.
		if(is_array($decoded)) {
			# Declare Required Variables
			$UserName			=	isset($decoded["user"])			?	Data::_do('escData',trim($decoded["user"]))		:	false;
			$Password	        =	isset($decoded["pw"])		    ?	Data::_do('escData',trim($decoded["pw"]))		:	false;
			$hashedPassword		=	password_hash($Password, PASSWORD_DEFAULT);
			# Error Checking
			$arr	=	[
					'finished' => '',
					'errors' => []
			];
			if(isset($decoded['login'])){
				# Validate Username
				if(empty($UserName)){
					$arr['errors'][]  .=  '1';
				}
				# Validate Password
				if(empty($Password)){
					$arr['errors'][]  .=  '2';
				}else if(strlen($Password) < 3 || strlen($Password) > 16){
					$arr['errors'][]  .=  '3';
				}
				# If No Errors Continue
				if(count($arr['errors'])==0) {
					$sql    =   ("
									SELECT [User].[UserUID],[Web].[UserID],[Web].[Pw],[Web].[Email],[User].[Status] FROM ".MSSQL::getTable('WEB_PRESENCE')." AS [Web]
									INNER JOIN ".MSSQL::getTable('SH_USERDATA')." AS [User] ON [User].UserID = [Web].[UserID]
									COLLATE SQL_Latin1_General_CP1_CI_AS WHERE (Web.UserID=:userid OR Web.Email=:email)
					");
					MSSQL::query($sql);
					MSSQL::bind(':userid', $UserName);
					MSSQL::bind(':email', $UserName);
					MSSQL::execute();
					if($userInfo = MSSQL::$stmt->fetch()){
						if(password_verify($Password, $userInfo['Pw'])) {
							if($userInfo["Status"] == 0 || $userInfo["Status"] == 16 || $userInfo["Status"] == 32 || $userInfo["Status"] == 48 || $userInfo["Status"] == 64 || $userInfo["Status"] == 80 || $userInfo["Status"] == 128 ){
								$_SESSION['User']['UserUID']=$userInfo['UserUID'];
								$_SESSION['User']['UserID']=$userInfo['UserID'];
								$_SESSION['User']['Status']=$userInfo['Status'];
								Session::updateLoginStatus(1);
								$arr['errors'][]  .=  'Login successful.<br>Loading your homepage now...';
								$LastPage   =   $_SERVER['HTTP_REFERER'];
								$arr['finished']  .=  'true';
								/*echo '<script>window.setTimeout(function(){
			
								window.location.href = "'.$LastPage.'"
			
								}, 2000);</script>';*/
							}else{
								$arr['errors'][]  .=  '6';
							}
						} else {
							$arr['errors'][]  .=  '4';
						}
					}else{
						$arr['errors'][]  .=  '5';
					}
				}
				# Check Errors
				if(count($arr['errors'])){
					//echo '<ul>';
					foreach($arr['errors'] as $error){
						//echo '<li>'.Data::_do('MessagesArr', $error).'</li><br>';
					}
					//echo '</ul>';
				}
				echo json_encode($arr);
			}
		}
	}