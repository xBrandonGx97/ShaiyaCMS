<?php
    # Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Banned Users");

    # Start Template
	$this->Tpl->_do_ACP_pageHeader("","",false,"12","Banned Accounts");
			$this->stmt = $this->db->conn->prepare("
				SELECT * FROM ShaiyaCMS.dbo.BANNED ORDER BY BanDate DESC
			");
			$this->stmt->execute();
			$this->CheckCount = $this->db->conn->prepare("
				SELECT Count(*) FROM ShaiyaCMS.dbo.BANNED
			");
			$this->CheckCount->execute();
			$this->ChkCount = $this->CheckCount->fetchColumn();
			if($this->ChkCount==0){
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
			while($data=$this->stmt->fetch(PDO::FETCH_NUM)){
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
	$this->Tpl->_do_ACP_pageFooter();
?>