<?php
    define('AJAX_CALL',true);
    # Autoloader
	require_once($_SERVER['DOCUMENT_ROOT']."../app/bootstrap.php");
	Bootstrap::_is_ajax();

    use \Classes\Utils\Data;
    use \Classes\DB\MSSQL;
    use \Classes\Utils\Session;
    Session::init('Default');
    
    # Declare Required Variables
	$UserName			=	isset($_POST["UserName"])			?	Data::_do('escData',trim($_POST["UserName"]))		:	false;
	$Password	        =	isset($_POST["Password"])		    ?	Data::_do('escData',trim($_POST["Password"]))		:	false;
	$Email	            =	isset($_POST["email"])		        ?	Data::_do('escData',trim($_POST["email"]))		    :	false;
	# Error Checking
	$errors = array();

	if(isset($_POST['doLogin'])){
	    # Validate Username
        if(empty($UserName)){
            $errors[]  .=  'L-0x01';
        }
        # Validate Password
        if(empty($Password)){
            $errors[]  .=  'L-0x04';
        }else if(strlen($Password) < 3 || strlen($Password) > 16){
            $errors[]  .=  'L-0x05';
        }
        # If No Errors Continue
	    if(count($errors)==0){
            $sql    =   ("
                            SELECT [User].[UserUID],[Web].[UserID],[Web].[Pw],[Web].[Email],[User].[Status] FROM ".MSSQL::getTable('WEB_PRESENCE')." AS [Web]
						    INNER JOIN ".MSSQL::getTable('SH_USERDATA')." AS [User] ON [User].UserID = [Web].[UserID]
						    COLLATE SQL_Latin1_General_CP1_CI_AS WHERE (Web.UserID=:userid OR Web.Email=:email) AND (Web.Pw=:pwd)
            ");
            MSSQL::query($sql);
            MSSQL::bind(':userid', $UserName);
            MSSQL::bind(':email', $UserName);
            MSSQL::bind(':pwd', $Password);
            MSSQL::execute();
            if($userInfo = MSSQL::$stmt->fetch()){
                if($userInfo["Status"] == 0 || $userInfo["Status"] == 16 || $userInfo["Status"] == 32 || $userInfo["Status"] == 48 || $userInfo["Status"] == 64 || $userInfo["Status"] == 80 || $userInfo["Status"] == 128 ){
                    $_SESSION['User']['UserUID']=$userInfo['UserUID'];
                    $_SESSION['User']['UserID']=$userInfo['UserID'];
                    $_SESSION['User']['Status']=$userInfo['Status'];
                    Session::updateLoginStatus(1);
                    $errors[]  .=  'L-0x08';
                    echo '<script>location.href="/";</script>' ;
                }else{
                    $errors[]  .=  'L-0x07';
                }
            }else{
                $errors[]  .=  'L-0x09';
            }
        }
	    # Check Errors
		if(count($errors)){
			echo '<ul>';
			foreach($errors as $error){
				/*if($error=='SL-0x04'){
					echo 'testlol';
				}*/
				echo '<li>'.Data::_do('MessagesArr', $error).'</li><br>';
			}
			echo '</ul>';
		}
    }