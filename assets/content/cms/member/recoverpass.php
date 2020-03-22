<?php

$UserID = isset($_POST["UserID"]) ? $this->Data->escData(trim($_POST["UserID"])) : false;
$Email = isset($_POST["Email"]) ? $this->Data->escData(trim($_POST["Email"])) : false;
$DOB = isset($_POST["DOB"]) ? $this->Data->escData(trim($_POST["DOB"])) : false;
$SecQuestion = isset($_POST["SecQuestion"]) ? $this->Data->escData(trim($_POST["SecQuestion"])) : false;
$SecAnswer = isset($_POST["SecAnswer"]) ? $this->Data->escData(trim($_POST["SecAnswer"])) : false;
$NewPass = isset($_POST["NewPass"]) ? $this->Data->escData(trim($_POST["NewPass"])) : false;
$confNewPass = isset($_POST["confNewPass"]) ? $this->Data->escData(trim($_POST["confNewPass"])) : false;
$errors = array();
$success = false;

if(isset($_POST) && !empty($_POST)){
    # Check Username
    $sql	=	('
					SELECT UserID FROM PS_UserData.dbo.Users_Master WHERE UserID=?
	');
	$stmt = $this->db->conn->prepare($sql);
	$params = array($UserID);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    $rowCount = count($result);
    if($rowCount==0){
        $errors[] = 'Invalid Username.';
    }

    # Check Email
    $sql	=	('
					SELECT UserID FROM '.$this->db->get_TABLE('WEB_PRESENCE').' WHERE UserID=? AND Email=?
	');
	$stmt = $this->db->conn->prepare($sql);
	$params = array($UserID,$Email);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    $rowCount = count($result);
    if($rowCount==0){
        $errors[] = 'Invalid email.';
    }

    # Verify DOB
    $sql	=	('
					SELECT UserID FROM '.$this->db->get_TABLE('WEB_PRESENCE').' WHERE UserID=? AND DOB=?
	');
	$stmt = $this->db->conn->prepare($sql);
	$params = array($UserID,$DOB);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    $rowCount = count($result);
    if($rowCount==0){
        $errors[] = 'Invalid DOB.';
    }

    # Verify Security Question/Answer
    $sql	=	('
					SELECT UserID FROM '.$this->db->get_TABLE('WEB_PRESENCE').' WHERE SecQuestion=? AND SecAnswer=? AND UserID=?
	');
	$stmt = $this->db->conn->prepare($sql);
	$params = array($SecQuestion,$SecAnswer,$UserID);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    $rowCount = count($result);
    if($rowCount==0){
        $errors[] = 'Invalid Security Question or Answer.';
    }

    # Verify new passwords.
	if(empty($NewPass)){
		$errors[] = 'Please provide a new password.';
	}else if(strlen($NewPass) < 3 || strlen($NewPass) > 13){
		$errors[] = 'New password must be between 3 and 13 characters in length.';
	}else if($NewPass != $confNewPass){
		$errors[] = 'New passwords do not match.';
    }
    
    if(count($errors) == 0){
        $sql = ("
                    UPDATE ".$this->db->get_TABLE('SH_USERDATA')."
                    SET Pw=?
                    Where UserID=?
        ");
        $stmt = $this->db->conn->prepare($sql);
        $params = array($NewPass,$UserID);

        $sql2 = ("
                    UPDATE ".$this->db->get_TABLE('WEB_PRESENCE')."
                    SET Pw=?
                    Where UserID=?
        ");
        $stmt2 = $this->db->conn->prepare($sql2);
        $params2 = array($NewPass,$UserID);

		if($stmt->execute($params) && $stmt2->execute($params2)){
            echo '<div class="user_info">';
			$success =  "Password for: ".$UserID." was successfully changed!";
            echo '</div>';
		}else{
			// This means the insert statement is probably not valid for your database.  Fix the stmt or fix your database, your choice ;)
			$errors[] = 'Failed to change password, please try again later';
		}
	}
}

    $this->Tpl->_do_pageHead("Account Recovery");
    if(count($errors)){
        echo '<ul id="error">';
        foreach($errors as $error){
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
        } else {
            echo '<div id="success">'.$success.'</div>';
        }
        echo '<form method="post" id="recover">';
            echo '<div class="form-group row">';
                echo '<div class="col-md-4 hidden-sm-down"></div>';
                echo '<div class="input-group col-md-4 col-sm-12">';
                    echo '<input autocomplete="off" class="form-control tac" id="Input-UserID" name="UserID" placeholder="UserID" type="text" />';
                echo '</div>';
            echo '</div>';
            
            echo '<div class="form-group row">';
                echo '<div class="col-md-4 hidden-sm-down"></div>';
                echo '<div class="col-md-4 col-sm-12">';
                    echo '<input autocomplete="off" class="form-control tac" id="Input-Email" name="Email" placeholder="Email" type="text" />';
                echo '</div>';
            echo '</div>';
            
            echo '<div class="form-group row">';
                echo '<div class="col-md-4 hidden-sm-down"></div>';
                echo '<div class="col-md-4 col-sm-12">';
                    echo '<input autocomplete="off" class="form-control tac" id="Input-DOB" name="DOB" placeholder="Date of Birth" type="text"/>';
                echo '</div>';
            echo '</div>';
            
            echo '<div class="form-group row">';
                echo '<div class="col-md-4 hidden-sm-down"></div>';
                echo '<div class="col-md-4 col-sm-12">';
                    echo $this->Select->sec_question();
                echo '</div>';
            echo '</div>';

            echo '<div class="form-group row">';
                echo '<div class="col-md-4 hidden-sm-down"></div>';
                echo '<div class="col-md-4 col-sm-12">';
                    echo '<input autocomplete="off" class="form-control tac" id="Input-SecAnswer" name="SecAnswer" placeholder="Security Answer" type="text"/>';
                echo '</div>';
            echo '</div>';

            echo '<div class="form-group row">';
                echo '<div class="col-md-4 hidden-sm-down"></div>';
                echo '<div class="col-md-4 col-sm-12">';
                    echo '<input autocomplete="off" class="form-control tac" id="Input-NewPass" name="NewPass" placeholder="New Password" type="password"/>';
                echo '</div>';
            echo '</div>';

            echo '<div class="form-group row">';
                echo '<div class="col-md-4 hidden-sm-down"></div>';
                echo '<div class="col-md-4 col-sm-12">';
                    echo '<input autocomplete="off" class="form-control tac" id="Input-confNewPass" name="confNewPass" placeholder="Confirm New Password" type="password"/>';
                echo '</div>';
            echo '</div>';
            
            echo '<div class="form-group row">';
                echo '<div class="col-md-12 tac">';
                    echo '<button class="btn btn-sm btn-primary m_auto" type="submit" name="sub_reg">Recover Account</button>';
                echo '</div>';
            echo '</div>';
        echo '</form>';
    $this->Tpl->_do_pageFooter();
?>