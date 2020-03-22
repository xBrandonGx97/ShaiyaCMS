<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Mob List Log");
	
	#	Form Data
	$count=1;

	$sql = ("
				SELECT * FROM ".$this->db->get_TABLE("SH_MOBS")." 
				WHERE MobName NOT LIKE '%Error Monster%' AND MobName NOT LIKE '%WING%' AND MobName NOT Like '%?%' 
				ORDER by MobID
	");
	$stmt=$this->db->conn->prepare($sql);
	$stmt->execute();

	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",false,"13","Country (6=AOL/UOF,2=AOL,5=UOF) IF A 1 apears in row signifying a class that is class that wears or uses item. /getitem useing Type space TypeID space Count you want.");
		echo "
			<table class='table table-dark'>
				<tr>
					<td>MobID</td>
					<td>Mob Name</td>
					<td>Mob Ele</td>
                    <td>Mob LVL</td>
                    <td>Mob HP</td>";
					while($row=$stmt->fetch()){
					echo "<tr style=\"color:white\">";
						echo "<td>".$row['MobID']."</td>";
						echo "<td>".$row['MobName']."</td>";
						echo '<td><img src="assets/Themes/Standard/images/dropfinder/ele_'.$row['Attrib'].'.png"</td>';
                        echo "<td>".$row['Level']."</td>";
                        echo "<td>".$row['HP']."</td>";
                    echo "</tr>";
                        $count++;
                    }
			echo "</table>";
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
?> 