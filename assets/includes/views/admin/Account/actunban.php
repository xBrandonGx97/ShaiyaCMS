<?php
    # Authorization
	User::Auth();
	User::AuthGM();

	$CharName = isset($_POST["CharName"]) ? Settings::$purifier->purify(trim($_POST["CharName"])) : false;
	if(isset($_POST['submit']) || strlen($CharName)>1){
		$sql = ("
					SELECT * FROM ".Database::getTable("SH_CHARDATA")." WHERE CharName=? AND Del=?
		");
		$query=Database::connect()->prepare($sql);
		$args = array($CharName,0);
		$query->execute($args);
		$result = $query->fetchAll();
		$rowCount = count($result);
		if($rowCount==0){
			LogSys::createLog("Failed Unban: Character Doesn't Exist");
			Template::doACP_Head("","",true,"6","Character Doesn't Exist!");
				echo '<h1 class="display-7">Character Doesn\'t Exist!</div>';
			Template::doACP_Foot();
			die();
		}
		$sql2 = ("
					UPDATE ".Database::getTable("SH_USERDATA")."
					SET Status=?
					WHERE UserUID=(SELECT UserUID FROM ".Database::getTable("SH_CHARDATA")."
					WHERE CharName='".$CharName."' AND Del=?)
		");
		$query2=Database::connect()->prepare($sql2);
		$args2 = array(0,0);
		$query2->execute($args2);
		if($query2===false){
			LogSys::createLog("Failed Unban: Query Error(".$Error[0]["message"].")");
			Template::doACP_Head("","",true,"6","Something's Happened! Error Logged!");
				echo '<h1 class="display-7">Something\'s Happened! Error Logged!</div>';
			Template::doACP_Foot();
			die();
		}
		$sql3 = ("
					DELETE FROM ".Database::getTable("SH_BANNED")." WHERE CharName =?
		");
		$query3=Database::connect()->prepare($sql3);
		$args3 = array($CharName);
		$query3->execute($args3);
		LogSys::createLog("Unbanned '".$CharName."'!");
			Template::doACP_Head("","",true,"6","Successfully unbanned '".$CharName."'!");
				echo '<h1 class="display-7">Successfully unbanned '.$CharName.'!</div>';
			Template::doACP_Foot();
	} else {
		Template::doACP_Head("","",true,"6","Unban An Account");
		echo '<form class="form-inline" method="POST">';
            echo '<div class="form-group">';
            	echo '<input type="text" name="CharName" class="form-control" placeholder="Character Name"/>';
            echo '</div>';
            	echo '<button type="submit" class="btn btn-sm btn-primary tac" style="margin-left:5px" name="submit">Submit</button>';
		echo '</form>';
		Template::doACP_Foot();
	}
?>