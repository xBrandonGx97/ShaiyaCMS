<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	
		//Form Data
		$char = isset($_POST["char"]) ? $this->Data->escData(trim($_POST["char"])) : false;
		$count=0;
		$Lapis=array();
		if((isset($_POST['submit'])) || strlen($char)>1){
			if(strlen($char)<1){die('Invalid Character Name. Please try again.</div>');}
			$sql = ("
						SELECT i.ItemName, ci.ItemUID, ci.Gem1, ci.Gem2, ci.Gem3, ci.Gem4, ci.Gem5, ci.Gem6
						FROM ".$this->db->get_TABLE("SH_CHARITEMS")." ci
						INNER JOIN ".$this->db->get_TABLE("SH_ITEMS")." i ON i.ItemID=ci.ItemID
						WHERE CharID = (SELECT CharID FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE CharName =? AND Del=?) AND Bag=?
		 	");
		 	$stmt=$this->db->conn->prepare($sql);
			$args = array($char,0,0);
			$stmt->execute($args);
			$sql1 = ("
						SELECT ItemName,TypeID FROM ".$this->db->get_TABLE("SH_ITEMS")." WHERE Type=?
		 	");
		 	$stmt1=$this->db->conn->prepare($sql1);
			$args1 = array(30);
			$stmt1->execute($args1);
			$result1 = $stmt1->fetchAll();
			$rowCount1 = count($result1);
			if($rowCount1==0){
				die("User ".$char." does not exist");
			}else{
				foreach($result1 as $rowL){
					$Lapis[$rowL['TypeID']] = $rowL['ItemName'];
				}
				$this->Tpl->_do_ACP_pageHeader("","",false,"12","View Gear Links of Character");
				# Start Template
				echo '<font class="b u">Current Links In Equipped Gear Of: '.$char.'</font>';
					echo '<table class="table table-dark">';
						echo '<tr>';
							echo '<th>ItemName</th>';
							echo '<th>ItemUID</th>';
							echo '<th>Lapis Slot 1</th>';
							echo '<th>Lapis Slot 2</th>';
							echo '<th>Lapis Slot 3</th>';
							echo '<th>Lapis Slot 4</th>';
							echo '<th>Lapis Slot 5</th>';
							echo '<th>Lapis Slot 6</th>';
						echo '</tr>';
					while($row=$stmt->fetch()){
						echo "<tr>";
							echo "<td>".$row['ItemName']."</td>";
							echo "<td>".$row['ItemUID']."</td>";
							echo "<td>"; echo $row['Gem1'] != 0 ? "<b>".$Lapis[$row['Gem1']]."</b>" : "Empty Slot"; echo "</td>";
							echo "<td>"; echo $row['Gem2'] != 0 ? "<b>".$Lapis[$row['Gem2']]."</b>" : "Empty Slot"; echo "</td>";
							echo "<td>"; echo $row['Gem3'] != 0 ? "<b>".$Lapis[$row['Gem3']]."</b>" : "Empty Slot"; echo "</td>";
							echo "<td>"; echo $row['Gem4'] != 0 ? "<b>".$Lapis[$row['Gem4']]."</b>" : "Empty Slot"; echo "</td>";
							echo "<td>"; echo $row['Gem5'] != 0 ? "<b>".$Lapis[$row['Gem5']]."</b>" : "Empty Slot"; echo "</td>";
							echo "<td>"; echo $row['Gem6'] != 0 ? "<b>".$Lapis[$row['Gem6']]."</b>" : "Empty Slot"; echo "</td>";
						echo "</tr>";
					}
					echo "</table>";
				# End Template
				$this->Tpl->_do_ACP_pageFooter();
			}
		$this->LogSys->createLog("Viewed Equipped Item Links (Player: ".$char.")");
	}else{
	# Start Template
		$this->Tpl->_do_ACP_pageHeader("","",true,"6","View Gear Links of Character");
			echo '<form method="POST">';
				echo '<div class="form-group mx-sm-3 mb-2">';
					echo '<input type="text" name="char" placeholder="Character Name" class="form-control tac b_i">';
                echo '</div>';
					echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-left:10px;">Submit</button>';
			echo '</form>';
	}
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
?>