<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();

	$CharName=isset($_POST['CharName']) ? $this->Data->escData(trim(htmlentities($_POST['CharName']))) : false;
	$Reason=isset($_POST['Reason']) ? $this->Data->escData(trim(htmlentities($_POST['Reason']))) : false;
	$Len=isset($_POST['Length']) ? $this->Data->escData(trim($_POST['Length'])) : false;
	$Length=array("12hr"=>'12 hours',"5days"=>'5 days',"2weeks"=>'2 weeks',"perma"=>'permanent');
	if(isset($_POST['submit'])){
		if(strlen($Reason)<1){die("Reason is too short.");}
		elseif(strlen($CharName)<1){die("Character's name is too short.");}
		if(!array_key_exists($Len,$Length)){$Len = "perma";}
		$this->stmt = $this->db->conn->prepare("
			SELECT UserUID FROM ".$this->db->get_TABLE('SH_CHARDATA')." WHERE CharName = '".$CharName."' AND Del=?
		");
		$this->params = array(0);
		$this->stmt->execute($this->params);
		if(!$this->stmt->fetch(PDO::FETCH_NUM)){
			$this->LogSys->createLog("Failed Ban On ".$CharName.": Doesn't Exist");
			# Start Template
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Character doesn't exist!");
			# End Template
			$this->Tpl->_do_ACP_pageFooter();
			die();
		}
		$row=$this->stmt->FETCH(PDO::FETCH_NUM);
		$this->stmt2 = $this->db->conn->prepare("
			SELECT * FROM ".$this->db->get_TABLE("SH_BANNED")." WHERE CharName = '".$CharName."'
        ");
		$this->stmt2->execute();
		if($this->stmt2->fetch(PDO::FETCH_NUM)){
			$this->LogSys->createLog("Failed Ban On ".$CharName.": Already Banned.");
			# Start Template
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Character is already banned!");
			# End Template
			$this->Tpl->_do_ACP_pageFooter();
			die();
		}
		$this->stmt3 = $this->db->conn->prepare("
			UPDATE ".$this->db->get_TABLE("SH_USERDATA")." SET Status = -1 WHERE UserUID = (SELECT UserUID FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE CharName = '".$CharName."' AND Del=0)
        ");
		$this->stmt3->execute();
		if($this->stmt3===false){
			$this->LogSys->createLog("Failed Ban On ".$CharName.": Query Error(".$error[0]['message'].")");
			# Start Template
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Something went wrong! Error Logged.");
			# End Template
			$this->Tpl->_do_ACP_pageFooter();
			die();
		}
		$this->stmt4 = $this->db->conn->prepare("
			INSERT INTO ".$this->db->get_TABLE("SH_BANNED")."
			(CharName, Reason, Duration, UserUID, BannedBy)
			VALUES
			('".$CharName."','".$Reason."','".$Length[$Len]."','".$row['UserUID']."','".$_SESSION['uid']."')
        ");
		$this->stmt4->execute();
			# Start Template
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Successfully banned '".$CharName."'!");
			# End Template
			$this->Tpl->_do_ACP_pageFooter();
		$this->LogSys->createLog("Banned Character: ".$CharName);
	}else{
			# Start Template
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Account Ban!");
				echo '<form method="POST">';
							echo '<div class="form-group">';
								echo '<div id="label1">Character: <input type="text" class="form-control tac b_i" name="CharName" placeholder="Character Name" /></div><div style="margin-top:5px"></div>';
					echo '<div id="label2"><textarea class="tinymce" name="Reason" cols="50" rows="10" placeholder="Enter ban reason here" >Reason/Infraction</textarea></div>';
					echo '<div id="label1">Ban Length: ';
							echo '</div>';
        echo '<select name="Length" class="form-control tac b_i style="width:20%">';
							echo '<option value="12hr">12 Hours</option>';
							echo '<option value="5days">5 Days</option>';
							echo '<option value="2weeks">2 Weeks</option>';
							echo '<option value="perma">Permanent</option>';
						echo '</select>';
					echo '</div>';
                        echo '<button type="submit" class="btn btn-sm btn-primary tac" style="margin-top:5px" name="submit">Submit</button>';
				echo '</form>';
			# End Template
			$this->Tpl->_do_ACP_pageFooter();
	}
?>