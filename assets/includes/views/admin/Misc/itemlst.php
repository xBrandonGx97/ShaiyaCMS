<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Item List Log");

	#	Form Data
	$count=1;
    $sql = ("
                SELECT * FROM ".Database::getTable("SH_ITEMS")." WHERE ItemName NOT LIKE '%?%' ORDER BY ItemName Asc
	");
	$stmt=Database::connect()->prepare($sql);
	$stmt->execute();

	# Start Template
	Template::doACP_Head("","",true,"14","Country (6=AOL/UOF,2=AOL,5=UOF) IF A 1 apears in row signifying a class that is class that wears or uses item. /getitem useing Type space TypeID space Count you want.");
		echo '<table class="table table-sm table-dark" id="ItemList">';
			echo '<thead>';
				echo '<tr>';
					echo '<td>ItemID</td>';
					echo '<td>ItemName</td>';
                	echo '<td>Type</td>';
                	echo '<td>TypeID</td>';
                	echo '<td>Requierd Level</td>';
                	echo '<td>Country</td>';
                	echo '<td>Fight/War</td>';
                	echo '<td>Def/Guard</td>';
                	echo '<td>Ranger/Sin</td>';
                	echo '<td>Archer/Hunter</td>';
                	echo '<td>Mage/Pag</td>';
                	echo '<td>Priest/Orc</td>';
                	echo '<td>Max O.J.Stats</td>';
                	echo '<td>Count Per Stack</td>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			while($row=$stmt->fetch()){
				echo '<tr>';
					echo '<td>'.$row['ItemID'].'</td>';
                    echo '<td>'.$row['ItemName'].'</td>';
                    echo '<td>'.$row['Type'].'</td>';
                    echo '<td>'.$row['TypeID'].'</td>';
                    echo '<td>'.$row['Reqlevel'].'</td>';
                    echo '<td>'.$row['Country'].'</td>';
                    echo '<td>'.$row['Attackfighter'].'</td>';
                    echo '<td>'.$row['Defensefighter'].'</td>';
                    echo '<td>'.$row['Patrolrogue'].'</td>';
                    echo '<td>'.$row['Shootrogue'].'</td>';
                    echo '<td>'.$row['Attackmage'].'</td>';
                    echo '<td>'.$row['Defensemage'].'</td>';
                    echo '<td>'.$row['ReqWis'].'</td>';
                    echo '<td>'.$row['Count'].'</td>';
				echo '</tr>';
				$count++;
			}
			echo '</tbody>';
		echo '</table>';
	Template::doACP_Foot();
?>
<script>
	$(document).ready(function(){
		$('#ItemList').dataTable({
			   "info": false,
			   "bLengthChange": false,
			   "pageLength": 15,
         });
	});
</script>