<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	
	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"6","DP Handout");
	//Form Data
	$DP			=	isset($_POST["DP"])		?	$this->Data->escData(trim($_POST["DP"]))	:	false;
	$UserID		=	isset($_POST["UserID"])		?	$this->Data->escData(trim($_POST["UserID"]))	:	false;
	$success = false;

if (isset($_POST['submit'])){
	if (empty($_POST['UserID'])){
		die('You didn\'t specify an Account Name!');
	}

	$this->sql = ("
					SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")." where CharName = ?
	");
	$this->query=$this->db->conn->prepare($this->sql);
	$this->query->bindValue(1, $UserID, PDO::PARAM_INT);
	$this->query->execute();
	$this->result = $this->query->fetchAll();
	$this->rowCount = count($this->result);
		if($this->rowCount==0){
			echo 'No chars matched the query';
		}
		else{
			foreach($this->result as $res){
				$this->queryPoint=$this->db->conn->prepare("
					UPDATE ".$this->db->get_TABLE("SH_USERDATA")." SET Point = Point + ? WHERE UserID = ?
				");
				$params = array($DP,$res['UserID']);
				$this->queryPoint->execute($params);
		
				$success = 'Sucesfuly added '.$params[0].' Point(s) to ' . $UserID . '\'s account.';
			}
				$this->queryChar=$this->db->conn->prepare("
					SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")." where CharName = ?
				");
				$paramsChar = array($UserID);
				$this->queryChar->execute($paramsChar);
		echo $success;
		}
}
else{
		echo '<form method="POST">';
		echo '<div class="form-group mx-sm-3 mb-2">';
			echo '<input type="text" name="UserID" placeholder="Char Name" class="form-control tac b_i"/>';
		echo '</div>';
		echo '<div class="form-group mx-sm-3 mb-2">';
			echo '<input type="text" name="DP" placeholder="DP Amount" class="form-control tac b_i" style="margin-left:5px !important"/>';
		echo '</div>';
			echo '<input type="submit" class="btn btn-sm btn-primary m_auto" style="margin-left:5px !important;" value="Submit" name="submit" />';
		echo '</form>';
}
# End Template
$this->Tpl->_do_ACP_pageFooter();
?>
