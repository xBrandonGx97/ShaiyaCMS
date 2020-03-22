<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthADM();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed GM Command Log");
	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",false,"12","GM Commands Log ~ Last 50 Commands");
			$this->sql = ("
							SELECT TOP 50 * FROM ".$this->db->get_TABLE("LOG_GM_COMMANDS")." ORDER BY ActionTime DESC
	        ");
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();		
			$this->result = $this->stmt->fetchAll();
			$this->rowCount = count($this->result);
			if($this->rowCount==0){
				die("No Commands Currently Listed In Database.");
			}else{
				echo '<table class="table table-dark">';
				echo '<tr>';
					echo '<th>CharName</th>';
					echo '<th>Map</th>';
					echo '<th>PosX</th>';
					echo '<th>PosY</th>';
					echo '<th>Command</th>';
					echo '<th>Player Affected</th>';
					echo '<th>Command Result</th>';
					echo '<th>Usage Date</th>';
				echo '</tr>';
				foreach($this->result as $row){
				echo "<tr>";
					echo "<td>".$row['CharName']."</td>";
					echo "<td>".$this->User->get_Map($row['MapID'])."</td>";
					echo "<td>".$row['PosX']."</td>";
					echo "<td>".$row['PosY']."</td>";
					echo "<td>".$row['Command']."</td>";
					echo "<td>".$row['PlayerAffected']."</td>";
					echo "<td>".$row['CommandResult']."</td>";
					echo "<td width=14%>".date("m/d/y H:i A", strtotime($row['ActionTime']))."</td>";
				echo "</tr>";
			}
			echo '</table>';
		}
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
?>