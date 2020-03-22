<?php
	# Authorization
	User::Auth();
	User::AuthADM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed GM Command Log");
	# Start Template
	Template::doACP_Head("","",false,"12","GM Commands Log ~ Last 50 Commands");
			$sql = ("
							SELECT TOP 50 * FROM ".Database::getTable("LOG_GM_COMMANDS")." ORDER BY ActionTime DESC
	        ");
			$stmt =  Database::connect()->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			$rowCount = count($result);
			if($rowCount==0){
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
				foreach($result as $row){
				echo "<tr>";
					echo "<td>".$row['CharName']."</td>";
					echo "<td>".User::get_Map($row['MapID'])."</td>";
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
	Template::doACP_Foot();
?>