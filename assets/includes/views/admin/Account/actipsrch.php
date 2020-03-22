<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Account IP Search");

	$id = isset($_POST["CharName"]) ? Settings::$purifier->purify(trim($_POST["CharName"])) : false;
	$CharID = isset($_POST["CharID"]) ? Settings::$purifier->purify(trim($_POST["CharID"])) : false;

	if(isset($_POST['SC'])){
		# Start Template
		Template::doACP_Head("","",false,"12","<i class='fas fa-table'></i> Select an account to get All characters Associated to it.");
		if(empty($id)){
			die('You didn\'t specify a Character Name!');
		}

		$sql4 = ("
					SELECT * FROM ".Database::getTable("SH_CHARDATA")." WHERE CharName=?
		");
		$stmt4=Database::connect()->prepare($sql4);
		$args4 = array($id);
		$stmt4->execute($args4);
		$result = $stmt4->fetchAll();
		$rowCount = count($result);
		if($rowCount==0){
			die('No Characters found!');
		}

		foreach($result as $res){
		$sql = ("
					SELECT * FROM ".Database::getTable("SH_USERDATA")." where UserUID=?
		");
		$stmt=Database::connect()->prepare($sql);
		$args = array($res['UserUID']);
		$stmt->execute($args);

			while($res1=$stmt->fetch()){
				echo '<form method="POST">';
				$sql1 = ("
							SELECT * FROM ".Database::getTable("SH_USERDATA")." WHERE UserIp=?
				");
				$stmt1=Database::connect()->prepare($sql1);
				$args1 = array($res1['UserIp']);
				$stmt1->execute($args1);
					echo '<div class="table-responsive">';
						echo '<table class="table table-dark" id="dataTable" width="100%" cellspacing="0">';
							echo '<thead>';
								echo '<tr>';
									echo '<td>Account Name</td>';
									echo '<td>Password</th>';
									echo '<td>UserUID</th>';
									echo '<td>Select</th>';
									echo '<td>IP</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
							while($res1=$stmt1->fetch()){
								echo '<tr>';
									echo '<td>'.$res1['UserID'].'</td>';
									echo '<td>'.$res1['Pw'].'</td>';
									echo '<td>'.$res1['UserUID'].'</td>';
								echo '<td>';
									echo '<input type="radio" name="CharID" value='.$res1['UserUID'].'>';
								echo '</td>';
									echo '<td>'.$res1['UserIp'].'</td>';
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
						echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SCI" style="margin-left:10px;margin-top:5px;">Submit</button>';
					echo '</div>';
				echo '</form>';
			}
		}
		# End Template
	Template::doACP_Foot();
	}
	elseif (isset($_POST['SCI'])){
		# Start Template
		Template::doACP_Head("","",true,"6","Results");

		if(!isset($CharID)){
			die('You didn\'t select a Character!');
		}

		$sql = ("
					SELECT * FROM ".Database::getTable("SH_CHARDATA")." WHERE UserUID=? AND Del=? ORDER BY Slot
		");
		$stmt=Database::connect()->prepare($sql);
		$args = array($CharID,0);
		$stmt->execute($args);

		try{
		echo '<form method="POST">';
			echo '<div class="table-responsive">';
				echo '<table class="table table-dark">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>CharName</th>';
							echo '<th>Slot</th>';
						echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
						while($data=$stmt->fetch()){
							echo '<tr>';
								echo '<td>'.$data['CharName'].'</td>';
								echo '<td>'.$data['Slot'].'</td>';
							echo '</tr>';
						}
					echo '</tbody>';
				echo "</table>";
			echo '</div>';
		echo "</form>";
		}catch (PDOException $e) {

		}
		# End Template
		Template::doACP_Foot();
	}
	else{
	# Start Template
	Template::doACP_Head("","",true,"6","Search All Accounts Associated to IP of a Character");
		echo '<form method="POST">';
			echo '<div class="form-group mx-sm-3 mb-2">';
				echo '<input type="text" name="CharName" placeholder="Character Name" class="form-control tac b_i">';
			echo '</div>';
				echo '<button type="submit" class="btn btn-sm btn-primary text-center" name="SC" style="margin-left:10px;">Submit</button>';
		echo '</form>';
	}
	# End Template
	Template::doACP_Foot();
?>