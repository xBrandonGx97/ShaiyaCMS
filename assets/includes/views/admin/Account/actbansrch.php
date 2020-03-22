<?php
    # Authorization
	User::Auth();
	User::AuthGM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Banned Users");

    # Start Template
	Template::doACP_Head("","",false,"12","Banned Accounts");
			$stmt = Database::connect()->prepare("
				SELECT * FROM ShaiyaCMS.dbo.BANNED ORDER BY BanDate DESC
			");
			$stmt->execute();
			$CheckCount = Database::connect()->prepare("
				SELECT Count(*) FROM ShaiyaCMS.dbo.BANNED
			");
			$CheckCount->execute();
			$ChkCount = $CheckCount->fetchColumn();
			if($ChkCount==0){
				die("No Banned Users!");
			}
			echo '<table class="table table-dark">';
			echo '<thead>';
				echo '<tr>';
					echo '<th>CharName</th>';
					echo '<th>Reason</th>';
					echo '<th>Duration</th>';
					echo '<th>Banned By</th>';
					echo '<th>Date</th>';
#					echo '<th>Release Date</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			$Length=array(4=>"5 Days",13=>"2 Weeks",0=> "Permanent");
			while($data=$stmt->fetch(PDO::FETCH_NUM)){
				if($data[2]==='permanent')
				echo "<tr>";
#					echo "<td><a href=\"unban_account.php?CharName=".$data[0]."\">".$data[0]."</a></td>";
					echo "<td>".$data[0]."</td>";
					echo "<td>".$data[1]."</td>";
					echo "<td>".$data[2]."</td>";
					echo "<td>".$data[4]."</td>";
					echo "<td>".date("m/d/Y g:i:s A", strtotime($data[5]))."</td>";
				echo "</tr>";
			}
			echo '</tbody>';
			echo '</table>';
	# End Template
	Template::doACP_Foot();
?>