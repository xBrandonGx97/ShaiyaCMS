<?php
    # Authorization
	$this->User->Auth();
	$this->User->AuthGM();

	$CharName = isset($_POST["CharName"]) ? $this->Data->escData(trim($_POST["CharName"])) : false;
	if(isset($_POST['submit']) || strlen($CharName)>1){
		$sql = ("
					SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE CharName=? AND Del=?
		");
		$query=$this->db->conn->prepare($sql);
		$args = array($CharName,0);
		$query->execute($args);
		$result = $query->fetchAll();
		$rowCount = count($result);
		if($rowCount==0){
			$this->LogSys->createLog("Failed Unban: Character Doesn't Exist");
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Character Doesn't Exist!");
				echo '<h1 class="display-7">Character Doesn\'t Exist!</div>';
			$this->Tpl->_do_ACP_pageFooter();
			die();
		}
		$sql2 = ("
					UPDATE ".$this->db->get_TABLE("SH_USERDATA")." 
					SET Status=?
					WHERE UserUID=(SELECT UserUID FROM ".$this->db->get_TABLE("SH_CHARDATA")."
					WHERE CharName='".$CharName."' AND Del=?)
		");
		$query2=$this->db->conn->prepare($sql2);
		$args2 = array(0,0);
		$query2->execute($args2);
		if($query2===false){
			$this->LogSys->createLog("Failed Unban: Query Error(".$Error[0]["message"].")");
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Something's Happened! Error Logged!");
				echo '<h1 class="display-7">Something\'s Happened! Error Logged!</div>';
			$this->Tpl->_do_ACP_pageFooter();
			die();
		}
		$sql3 = ("
					DELETE FROM ".$this->db->get_TABLE("SH_BANNED")." WHERE CharName =?
		");
		$query3=$this->db->conn->prepare($sql3);
		$args3 = array($CharName);
		$query3->execute($args3);
		$this->LogSys->createLog("Unbanned '".$CharName."'!");
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Successfully unbanned '".$CharName."'!");
				echo '<h1 class="display-7">Successfully unbanned '.$CharName.'!</div>';
			$this->Tpl->_do_ACP_pageFooter();
	} else {
		$this->Tpl->_do_ACP_pageHeader("","",true,"6","Unban An Account");
		echo '<form class="form-inline" method="POST">';
            echo '<div class="form-group">';
            	echo '<input type="text" name="CharName" class="form-control" placeholder="Character Name"/>';
            echo '</div>';
            	echo '<button type="submit" class="btn btn-sm btn-primary tac" style="margin-left:5px" name="submit">Submit</button>';
		echo '</form>';
		$this->Tpl->_do_ACP_pageFooter();
	}
?>