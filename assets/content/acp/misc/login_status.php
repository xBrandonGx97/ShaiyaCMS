<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthStaff();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Players Online");
	
	$count=1;
	$sql = ("
				SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")."
				c inner join ".$this->db->get_TABLE("SH_USERDATA")." as um on um.UserUID = c.UserUID 
				WHERE c.LoginStatus=? and c.Del=?
	");
	$stmt=$this->db->conn->prepare($sql);
	$args = array(1,0);
	$stmt->execute($args);
	$result = $stmt->fetchAll();
	$rowCount = count($result);
	if($rowCount==0){
		echo 'There are currently no members online.';
	}else{
		$sql = ("
					SELECT (SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")."
					WHERE Family IN (0,1) AND LoginStatus=1) AS \"Light\",
					(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")."
					WHERE Family IN (2,3) AND LoginStatus=1) AS \"Fury\"
		");
		$stmt=$this->db->conn->prepare($sql);
		$stmt->execute();
		$online = $stmt->FETCH();
	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",false,"12","Online Users");
				echo $online['Light'].' Light Players Online || '.$online['Fury'].' Fury Players Online';
				echo '<table cellpadding="0" cellspacing="0" width="100%" class="table table-dark">';
					echo '<tr>';
						echo '<th>Count</th>';
						echo '<th>Character</th>';
						echo '<th>Level</th>';
						echo '<th>Location</th>';
						echo '<th>PosX</th>';
						echo '<th>PosY</th>';
						echo '<th>Faction</th>';
						echo '<th>User IP</th>';
					echo '</tr>';
				foreach($result as $row){
					echo "<tr>";
						echo "<th>".$count."</td>";
						echo "<td>".$row['CharName']."</td>";
						echo "<td>".$row['Level']."</td>";
						echo "<td>".$row['Map']."</td>";
						echo "<td>".$row['PosX']."</td>";
						echo "<td>".$row['PosY']."</td>";
						echo "<td>".($row['faction'] == 0 ? "Light" : "Fury")."</td>";
                        echo "<td>".$row['UserIp']."</td>";
					echo "</tr>";
					$count++;
				}
				echo '</table>';
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
	}
?>