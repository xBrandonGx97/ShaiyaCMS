<?php
    # Authorization
	$this->User->Auth();
	$this->User->AuthGM();

	$UserUID = isset($_POST["UserUID"]) ? $this->Data->escData(trim($_POST["UserUID"])) : false;
	$UserID = isset($_POST["UserID"]) ? $this->Data->escData(trim($_POST["UserID"])) : false;
	$ItemUID = isset($_POST["ItemUID"]) ? $this->Data->escData(trim($_POST["ItemUID"])) : false;

	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"6","W.H. Items Delete");

	if (isset($_POST['SCN'])) 
	{
		$Set    = false;
		$sql = ("
					DELETE FROM ".$this->db->get_TABLE("SH_USERWH")." Where ItemUID=?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($ItemUID);
		$stmt->execute($args);
		
		if($stmt){
			echo 'Item Deleted Successfully!!<br>';
		}

		echo '<form class="form-inline" method="POST">';
		echo "<input type='hidden' name='UserUID' value='".$UserUID."' />";
		echo '<input type="submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" name="SCI" value="Same Char">';
	}

	elseif (isset($_POST['SC'])) 
	{
		if(empty($UserID)){
			die('You didn\'t specify a Character Name!');
		}

		$sql = ("
					SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")." where CharName = ?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($UserID);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);

		if($rowCount==0){
			die('Admin Account Log returned no results');
		}
		
		$sql = ("
					SELECT UserID,UserUID,CharName FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE CharName = ?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($UserID);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);

		if($rowCount==0){
			echo 'Character search for: "'.$UserID.'" returned no results.';
		}
		echo '<form method="POST">';
		echo '<div class="table-responsive">';
							echo '<table class="table table-dark">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>CharName</th>';
										echo '<th>UserID</th>';
										echo '<th>UserUID</th>';
										echo '<th>Select</th>';
									echo '</tr>';
								echo '</thead>';
							echo '<tbody>';
		foreach($result as $Row){
			echo '<tr><td>' . $Row['CharName'] . '</td><td>' . $Row['UserID'] . '</td><td>' . $Row['UserUID'] . '</td><td><input type="radio" name="UserUID" value="' . $Row['UserUID'] . '"></td></tr>';
		}
		echo '</tbody>';
		echo '</table>';
		echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SCI">Submit</button>';
		echo '</form>';
	} 

	elseif (isset($_POST['SCI'])) 
	{
		if (!isset($UserUID)) 
		{
			die('You didn\'t select a Character!');
		}

		$Bag = array(
			0 => 'Equipped',
			1 => 'Bag 1',
			2 => 'Bag 2',
			3 => 'Bag 3',
			4 => 'Bag 4',
			5 => 'Bag 5'
		);

		$sql = ("
					SELECT I.ItemName,CI.Slot,CI.Count,CI.ItemUID,CI.UserUID FROM ".$this->db->get_TABLE("SH_USERWH")." CI INNER JOIN ".$this->db->get_TABLE("SH_ITEMS")." I ON I.ItemID=CI.ItemID WHERE CI.UserUID = ? ORDER BY CI.Slot
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($UserUID);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);
		
		if($rowCount==0){
			echo '<font class="b u">Search returned no results.</font>';
		}

		echo '<form method="POST">';
		echo '<div class="form-group">';
		echo '<div class="table-responsive">';
		echo '<table class="table table-dark"><tr>
			<th>ItemName</th>
			<th>Slot</th>
			<th>Count</th>
			<th>Select</th></tr>';
		
		foreach($result as $Row){
			echo '<tr><td>' . $Row['ItemName'] . '</td>
			<td>' . $Row['Slot'] . '</td>
			<td>' . $Row['Count'] . '</td>
			<td><input type="radio" name="ItemUID" value="' . $Row['ItemUID'] . '"></td>
			</tr>';
		}

		echo '</table>';
		echo "<input type='hidden' name='UserUID' value='".$UserUID."' />";
		echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SCN">Submit</button>';
		echo '</div>';
		echo '</div>';
		echo '</form>';
	}
	else
	{
		echo '<form method="POST">';
		echo '<div class="form-group mx-sm-3 mb-2">';
		echo '<input type="text" name="UserID" placeholder="Character Name" class="form-control tac b_i"/></td>';
		echo '</div>';
		echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SC" style="margin-left:5px;">Submit</button>';
	echo '</form>';
	}
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
?>
