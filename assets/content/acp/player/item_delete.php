<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();

	$CharID = isset($_POST["CharID"]) ? $this->Data->escData(trim($_POST["CharID"])) : false;
	$CharName = isset($_POST["CharName"]) ? $this->Data->escData(trim($_POST["CharName"])) : false;
	$ItemUID = isset($_POST["ItemUID"]) ? $this->Data->escData(trim($_POST["ItemUID"])) : false;

	if (isset($_POST['SCN']))
	{
		$this->Tpl->_do_ACP_pageHeader("","",true,"6","Delete Player Items");
		$Set = false;
			$sql = ("
						DELETE FROM ".$this->db->get_TABLE("SH_CHARITEMS")." Where ItemUID=?
			");
			$stmt=$this->db->conn->prepare($sql);
			$args = array($ItemUID);
			$stmt->execute($args);
		
			if ($stmt){
				echo 'Item Deleted Succesfully!!<br>';
			}

		echo '<form method="POST">';
		echo "<input type='hidden' name='CharID' value='".$CharID."'/>";
		echo '<input type="submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" name="SCI" value="Same Char">';
		$this->Tpl->_do_ACP_pageFooter();
	}

	elseif (isset($_POST['SC'])){
		if (empty($CharName))
		{
			die('You didn\'t specify a Character Name!');
		}
		
		$sql = ("
					SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")." where CharName = ?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($CharName);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);
		
		if($rowCount==0){
			die('Admin Account Log returned no results');
		}
		
		$sql = ("
					SELECT CharName,CharID FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE CharName = ? AND Del=?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($CharName,0);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);
		
		if($rowCount==0){
			echo 'Character search for: "'.$CharName.'" returned no results.';
		}
		
		$this->Tpl->_do_ACP_pageHeader("","",true,"6","Delete Player Items");
		echo '<form method="POST">';
						echo '<div class="table-responsive">';
							echo '<table class="table table-dark">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>CharName</th>';
										echo '<th>Select</th>';
									echo '</tr>';
								echo '</thead>';
								echo '<tbody>';
								foreach($result as $Row){
									echo '<tr>';
									echo '<td>'.$Row['CharName'].'</td>
									<td><input type="radio" name="CharID" value="'.$Row['CharID'].'"></td>';
									echo '</tr>';
								}
		echo '</tbody>';
		echo '</table>';
		echo '</div>';
		echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SCI">Submit</button>';
		echo '</form>';
		$this->Tpl->_do_ACP_pageFooter();
	}
	elseif (isset($_POST['SCI'])) 
	{
		if (!isset($CharID))
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
					SELECT I.ItemName,CI.Bag,CI.Slot,CI.Count,CI.ItemUID FROM ".$this->db->get_TABLE("SH_CHARITEMS")." CI INNER JOIN ".$this->db->get_TABLE("SH_ITEMS")." I ON I.ItemID=CI.ItemID WHERE CI.CharID = ? ORDER BY CI.Bag
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($CharID);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);
		
		if($rowCount==0){
			echo 'Search returned no results.';
		}
	$this->Tpl->_do_ACP_pageHeader("","",false,"12","Delete Player Items");
		echo '<form method="POST">';
		echo '<div class="form-group">';
		echo '<div class="table-responsive">';
		echo '<table class="table table-dark"><tr>
			<th>ItemName</th>
			<th>Bag</th>
			<th>Slot</th>
			<th>Count</th>
			<th>Select</th></tr>';
		foreach($result as $Row){
			echo '<tr><td>'.$Row['ItemName'].'</td>
			<td>'.$Bag[$Row['Bag']].'</td>
			<td>'.$Row['Slot'].'</td>
			<td>'.$Row['Count'].'</td>
			<td><input type="radio" name="ItemUID" value="'.$Row['ItemUID'].'"></td>
			</tr>';
		}
		echo '</table>';
		echo "<input type='hidden' name='CharID' value='".$CharID."'>";
		echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SCN">Submit</button>';
		echo '</div>';
		echo '</div>';
		echo '</form>';
		$this->Tpl->_do_ACP_pageFooter();
	}
	else {
				$this->Tpl->_do_ACP_pageHeader("","",true,"6","Delete Player Items");
				echo '<form method="POST">';
					echo '<div class="form-group mx-sm-3 mb-2">';
						echo '<input type="text" name="CharName" placeholder="Character Name" class="form-control tac b_i"/></td>';
					echo '</div>';
						echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SC" style="margin-left:5px;">Submit</button>';
				echo '</form>';
				$this->Tpl->_do_ACP_pageFooter();
		}
?>