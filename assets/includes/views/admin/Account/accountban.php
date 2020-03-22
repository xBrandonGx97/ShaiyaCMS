<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	$CharName=isset($_POST['CharName']) ? Settings::$purifier->purify(trim(htmlentities($_POST['CharName']))) : false;
	$Reason=isset($_POST['Reason']) ? Settings::$purifier->purify(trim(htmlentities($_POST['Reason']))) : false;
	$Len=isset($_POST['Length']) ? Settings::$purifier->purify(trim($_POST['Length'])) : false;
	$Length=array("12hr"=>'12 hours',"5days"=>'5 days',"2weeks"=>'2 weeks',"perma"=>'permanent');
	if(isset($_POST['submit'])){
		if(strlen($Reason)<1){die("Reason is too short.");}
		elseif(strlen($CharName)<1){die("Character's name is too short.");}
		if(!array_key_exists($Len,$Length)){$Len = "perma";}
		$stmt = Database::connect()->prepare("
			SELECT UserUID FROM ".Database::getTable('SH_CHARDATA')." WHERE CharName = '".$CharName."' AND Del=?
		");
		$params = array(0);
		$stmt->execute($params);
		if(!$stmt->fetch(PDO::FETCH_NUM)){
			LogSys::createLog("Failed Ban On ".$CharName.": Doesn't Exist");
			# Start Template
			Template::doACP_Head("","",true,"6","Character doesn't exist!");
			# End Template
			Template::doACP_Foot();
			die();
		}
		$row=$stmt->FETCH(PDO::FETCH_NUM);
		$stmt2 =  Database::connect()->prepare("
			SELECT * FROM ".Database::getTable("SH_BANNED")." WHERE CharName = '".$CharName."'
        ");
		$stmt2->execute();
		if($stmt2->fetch(PDO::FETCH_NUM)){
			LogSys::createLog("Failed Ban On ".$CharName.": Already Banned.");
			# Start Template
			Template::doACP_Head("","",true,"6","Character is already banned!");
			# End Template
			Template::doACP_Foot();
			die();
		}
		$stmt3 = Database::connect()->prepare("
			UPDATE ".Database::getTable("SH_USERDATA")." SET Status = -1 WHERE UserUID = (SELECT UserUID FROM ".Database::getTable("SH_CHARDATA")." WHERE CharName = '".$CharName."' AND Del=0)
        ");
		$stmt3->execute();
		if($stmt3===false){
			LogSys::createLog("Failed Ban On ".$CharName.": Query Error(".$error[0]['message'].")");
			# Start Template
			Template::doACP_Head("","",true,"6","Something went wrong! Error Logged.");
			# End Template
			Template::doACP_Foot();
			die();
		}
		$stmt4 = Database::connect()->prepare("
			INSERT INTO ".Database::getTable("SH_BANNED")."
			(CharName, Reason, Duration, UserUID, BannedBy)
			VALUES
			('".$CharName."','".$Reason."','".$Length[$Len]."','".$row['UserUID']."','".$_SESSION['Username']."')
        ");
		$stmt4->execute();
			# Start Template
			Template::doACP_Head("","",true,"6","Successfully banned '".$CharName."'!");
			# End Template
			Template::doACP_Foot();
		LogSys::createLog("Banned Character: ".$CharName);
	}else{
			# Start Template
			Template::doACP_Head("","",true,"6","Account Ban!");
				echo '<form method="POST">';
							echo '<div class="form-group">';
								echo '<div id="label1">Character: <input type="text" class="form-control tac b_i" name="CharName" placeholder="Character Name" /></div><div style="margin-top:5px"></div>';
					echo '<div id="label2"><textarea class="tinymce" name="Reason" cols="50" rows="10" placeholder="Enter ban reason here" >Reason/Infraction</textarea></div>';
					echo '<div id="label1">Ban Length: ';
							echo '</div>';
        echo '<select name="Length" class="form-control tac b_i style="width:20%">';
							echo '<option value="12hr">12 Hours</option>';
							echo '<option value="5days">5 Days</option>';
							echo '<option value="2weeks">2 Weeks</option>';
							echo '<option value="perma">Permanent</option>';
						echo '</select>';
					echo '</div>';
                        echo '<button type="submit" class="btn btn-sm btn-primary tac" style="margin-top:5px" name="submit">Submit</button>';
				echo '</form>';
			# End Template
			Template::doACP_Foot();
	}
?>