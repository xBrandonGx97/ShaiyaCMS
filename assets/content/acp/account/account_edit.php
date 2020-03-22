<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Account Edit");

	$acc	=	isset($_POST["acc"]) ? $this->Data->escData(trim($_POST["acc"])) : false;
	$char	=	false;

	# Arrow Columns
	$columns	=	array('UserUID','UserID','Pw','JoinDate','Admin','AdminLevel','UseQueue','Status','Leave','LeaveDate','UserType','UserIp','Point','Email','Exception');
	$greyed 	=	array('UserUID','UserID','UseQueue');

	if(isset($_POST['submit']) || strlen($char)>1){
		if(strlen($acc)<1){die("Invalid User Name.");}

		$params = array($_POST["acc"]);
		$tsql = ("
					SELECT TOP 1 *
					FROM ".$this->db->get_TABLE("SH_USERDATA")."
					WHERE UserID=?
		");
		$getAccount = $this->db->conn->prepare($tsql);
		$getAccount->execute($params);
		$Account = $getAccount->fetchAll(PDO::FETCH_ASSOC);

		$UserCount = count($Account);

		if($UserCount>0){
			$headings = array('Name','Value');

			$this->Tpl->_do_ACP_pageHeader("","",false,"12","Current Status of ".$acc."");
			echo '<p class="f_18 u">';
				echo 'Status = 16 For Admin, Status = 32 For GM<br>';
				echo 'Staff = 8 for HGS, Staff = 9 for GS, Staff = 10 for TGS<br>';
				echo 'Exception = 1 for multiclient';
			echo '</p>';

			echo '<form method="POST">';
				echo '<div class="table-responsive">';
					echo '<table class="table table-sm table-dark">';
						echo '<thead>';
							echo '<tr>';
							foreach($headings as $heading){
								echo '<th>'.$heading.'</th>';
							}
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
						foreach($Account as $row){
							foreach($columns as $value){
								echo '<tr>';
								echo '<th>'.$value.'</th>';
								if(in_array($value,$greyed)){
									echo '<td>';
										echo '<input type="text" class="form-control" name="'.$value.'" value="'.$row[$value].'">';
									echo '</td>';
									echo '</tr>';
								}
								else{
									echo '<td>';
										echo '<input type="text" class="form-control form-control-sm" name="'.$value.'" value="'.$row[$value].'"/>';
									echo '</td>';
									echo '</tr>';
								}
							}
						}
						echo '</tbody>';
					echo '</table>';
					echo '<input type="submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" name="submit2" value="Submit">';
				echo '</div>';
			echo '</form>';
			$this->Tpl->_do_ACP_pageFooter();
		}
		else{
			echo '<div class="container-fluid">';
				echo 'User '.$acc.' does not exist.';
			echo '</div>';
		}
	}
	elseif(isset($_POST['submit2'])){
		$useruid=isset($_POST["UserUID"]) ? $this->Data->escData(trim($_POST["UserUID"])) : false;
		$Report="";
		$this->Tpl->_do_ACP_pageHeader("","",false,"12");
		$columns=array('Pw','Admin','AdminLevel','Status','Leave','LeaveDate','UserType','UserIp','Point','Email','Exception',);
		echo "Results updated successfully. <br>";
		foreach($columns as $value){
			$this->stmt = $this->db->conn->prepare("
													UPDATE ".$this->db->get_TABLE("SH_USERDATA")." 
													SET ".$value."='".$_REQUEST[$value]."'
													WHERE UserUID=?
			");
			$this->params=array($useruid);
			$this->stmt->execute($this->params);
		}
		foreach($_POST as $Name=>$Value){
			if($Name !="submit2"){
				echo $Name.'='.$Value.'<br>';
				$Report.=$Name."=>".$Value.";";
			}
		}
		echo '<a href="?pageid=ACCT_EDIT" class="btn btn-sm btn-primary m_auto" style="margin-top:15px">Go Back</a>';
	}
	else{
		# Start Template
		$this->Tpl->_do_ACP_pageHeader("","",true,"6","Edit Account");
		echo '<form method="POST">';
			echo '<div class="form-group mx-sm-3 mb-2">';
				echo '<input type="text" name="acc" placeholder="Enter Account Name" class="form-control tac b_i">';
			echo '</div>';

			echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-left:10px;">Submit</button>';
		echo '</form>';
		# End Template
	}
	$this->Tpl->_do_ACP_pageFooter();
?>