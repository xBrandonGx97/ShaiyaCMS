<?php
	# Authorization
	User::Auth();
	User::AuthStaff();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Stat Padders Log");

	#	Form Data
		$sql = ("
					SELECT * FROM ".Database::getTable("SH_STATPADDERS")."
		");
		$stmt=Database::connect()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$rowCount = count($result);

	# Start Template
	Template::doACP_Head("","",false,"12","Possible Stat Padders");
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
	Template::doACP_Foot();
?>