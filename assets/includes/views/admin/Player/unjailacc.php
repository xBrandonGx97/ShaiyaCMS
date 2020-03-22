<?php
	# Authorization
	User::Auth();
	User::AuthStaff();

	$UserID = isset($_POST["CharName"]) ? Settings::$purifier->purify(trim($_POST["CharName"])) : false;

	# Start Template
	Template::doACP_Head("","",true,"6","Release Jailed toons for this account by /kicking online toon then submit the toon name here");

	if (isset($_POST['SC'])){
	if (empty($UserID)) {
		die('You didnt specify a Character Name!');
	}
		$sql2 = ("
					SELECT * FROM ".Database::getTable("SH_CHARDATA")." where CharName = ?
		");
		$stmt2=Database::connect()->prepare($sql2);
		$args2 = array($UserID);
		$stmt2->execute($args2);
		$result2 = $stmt2->fetchAll();
		$rowCount2 = count($result2);

		if($rowCount2==0){
			die('Admin Account Log returned no results');
		}

		$sql4 = ("
					SELECT * FROM ".Database::getTable("SH_CHARDATA")." where CharName = ?
		");
		$stmt4=Database::connect()->prepare($sql4);
		$args4 = array($UserID);
		$stmt4->execute($args4);

		while($res=$stmt4->fetch()){
			$sql5 = ("
						SELECT TOP 1 UserUID,UserID,CharID,CharName,Map,PosX,PosY,PosZ FROM ".Database::getTable("SH_CHARDATA")." where UserUID = ?
			");
			$stmt5=Database::connect()->prepare($sql5);
			$args5 = array($res['UserUID']);
			$stmt5->execute($args5);
			$result5 = $stmt5->fetchAll();
			$rowCount5 = count($result5);
		}

		if($rowCount5==0){
			echo 'Character search for: "'.$UserID.'" returned no results.';
		}

		foreach($result5 as $Row){
			$sql6 = ("
						UPDATE ".Database::getTable("SH_CHARDATA")." SET Map = 42,PosX = 55,PosY = 3 ,PosZ = 54 where UserUID = ?
			");
			$stmt6=Database::connect()->prepare($sql6);
			$args6 = array($Row['UserUID']);
			$stmt6->execute($args6);
			echo $Row['CharName']." Un-Jailed.</br>";
			LogSys::createLog("Jailed ".$Row['CharName']."");
		}

        echo '<div class="form-group">';
            echo '<a class="btn btn-sm btn-primary tac" href="/acp-unjail-acc" style="margin-left:5px;">Go Back</a>';
        echo '</div>';
	}
	else{
		echo '<form method="POST">';
			echo '<div class="form-group mx-sm-3 mb-2">';
				echo '<input type="text" class="form-control tac b_i" placeholder="Character Name" name="CharName">';
			echo '</div>';
				echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SC">Submit</button>';
			echo '</div>';
		echo '</form>';
	}
	# End Template
	Template::doACP_Foot();
?>