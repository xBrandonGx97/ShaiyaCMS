<?php
    # Authorization
	$this->User->Auth();
	$this->User->AuthStaff();
	
	$UserID = isset($_POST["CharName"]) ? $this->Data->escData(trim($_POST["CharName"])) : false;
	
	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"6","Jail ALL toons for this account by /kicking online toon then submit the toon name here");
    
	if (isset($_POST['SC'])) {
	if (empty($UserID)) {
		die('You didnt specify a Character Name!');
	}
		
	$sql2 = ("
				SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")." where CharName = ?
	");
	$stmt2=$this->db->conn->prepare($sql2);
	$args2 = array($UserID);
	$stmt2->execute($args2);
	$result2 = $stmt2->fetchAll();
	$rowCount2 = count($result2);

	if($rowCount2==0){
		die('Admin Account Log returned no results');
	}
		
	$sql4 = ("
				SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")." where CharName = ?
	");
	$stmt4=$this->db->conn->prepare($sql4);
	$args4 = array($UserID);
	$stmt4->execute($args4);
	
	while($res=$stmt4->fetch()){
		$sql5 = ("
					SELECT TOP 1 UserUID,UserID,CharID,CharName,Map,PosX,PosY,PosZ FROM ".$this->db->get_TABLE("SH_CHARDATA")." where UserUID = ?
		");
		$stmt5=$this->db->conn->prepare($sql5);
		$args5 = array($res['UserUID']);
		$stmt5->execute($args5);
		$result5 = $stmt5->fetchAll();
		$rowCount5 = count($result5);
	}

	if($rowCount5==0){
		echo 'Character search for: "'.$UserID.'" returned no results.';
	}
	
	foreach($result5 as $Row){
		$sql6 = ("
					UPDATE ".$this->db->get_TABLE("SH_CHARDATA")." SET Map = 41,PosX = 46,PosY = 3 ,PosZ = 45 where UserUID = ?
		");
		$stmt6=$this->db->conn->prepare($sql6);
		$args6 = array($Row['UserUID']);
		$stmt6->execute($args6);
		echo $Row['CharName']." Jailed.</br>";
        $this->LogSys->createLog("Jailed ".$Row['CharName']."");
	}
    echo '<div class="form-group">';
         echo '<a class="btn btn-sm btn-primary tac" href="?pageid=PLR_JAIL" style="margin-left:5px;">Go Back</a>';
    echo '</div>';
	}
	else {
	echo '<form method="POST">';
        echo '<div class="form-group mx-sm-3 mb-2">';
            echo '<input type="text" class="form-control tac b_i" placeholder="Character Name" name="CharName">';
		echo '</div>';
                echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SC" style="margin-left:5px;">Submit</button>';
        echo '</div>';
     echo '</form>';
	}
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
?>