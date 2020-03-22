<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Mob List Log");

	#	Form Data
	$count=1;

	$sql = ("
				SELECT * FROM ".Database::getTable("SH_MOBS")."
				WHERE MobName NOT LIKE '%Error Monster%' AND MobName NOT LIKE '%WING%' AND MobName NOT Like '%?%'
				ORDER by MobID
	");
	$stmt=Database::connect()->prepare($sql);
	$stmt->execute();

	# Start Template
	Template::doACP_Head("","",false,"13","Country (6=AOL/UOF,2=AOL,5=UOF) IF A 1 apears in row signifying a class that is class that wears or uses item. /getitem useing Type space TypeID space Count you want.");
			echo '<table class="table table-dark" id="MobList">';
				echo '<thead>';
					echo '<tr>';
						echo '<td>MobID</td>';
						echo '<td>Mob Name</td>';
						echo '<td>Mob Ele</td>';
						echo '<td>Mob LVL</td>';
						echo '<td>Mob HP</td>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				while($row=$stmt->fetch()){
					echo '<tr>';
						echo '<td>'.$row['MobID'].'</td>';
						echo '<td>'.$row['MobName'].'</td>';
						echo '<td><img src="'.DOC_ROOT.'/assets/Themes/shCMS/images/dropfinder/ele_'.$row['Attrib'].'.png"</td>';
                        echo '<td>'.$row['Level'].'</td>';
                        echo '<td>'.$row['HP'].'</td>';
                    echo '</tr>';
                    $count++;
				}
				echo '</tbody>';
			echo "</table>";
	# End Template
	Template::doACP_Foot();
?>
<script>
	$(document).ready(function(){
		$('#MobList').dataTable({
			   "info": false,
			   "bLengthChange": false,
			   "pageLength": 10,
         });
	});
</script>