<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthStaff();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Stat Padders Log");
	
	#	Form Data
		$sql = ("
					SELECT * FROM ".$this->db->get_TABLE("SH_STATPADDERS")."
		");
		$stmt=$this->db->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$rowCount = count($result);
		$online = $stmt->FETCH();

	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",false,"12","Possible Stat Padders");
	if($rowCount==0){
		die('There are currently no possible stat padders.');
	}
		echo "
		<table class='table table-dark'>
			<tr>
				<td>Killer's Toon</td>
				<td>Killer's IP</td>
				<td>Killer's ID</td>
				<td>Dead Toon</td>
				<td>Dead Toon's IP</td>
				<td>Dead Toon's ID</td>
				<td>Date</td>
				<td>Map</td>";
			echo '</tr>';
			while($row=$stmt->fetch()){
				echo "<tr>";
					echo "<td>".$row['KillerToon']."</td>";
					echo "<td>".$row['KillerIP']."</td>";
					echo "<td>".$row['KillerID']."</td>";
					echo "<td>".$row['DeadToon']."</td>";
					echo "<td>".$row['DeadIP']."</td>";
					echo "<td>".$row['DeadID']."</td>";
					echo "<td>".$row['Date']."</td>";
					echo "<td>".$row['Map']."</td>";
                echo "</tr>";
            }
		echo "</table>";
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
?>