<?php
	$UserID=isset($_REQUEST['UserID']) ?  Settings::$purifier->purify(trim($_REQUEST['UserID'])) : false;
	$Status=array(0=>"(Normal)",16=>"(Administrator)",32=>"(Game Master)",48=>"(Game Master)",64=>"(Game Master)",80=>"(Game Master)",128=>"(Game Sage)",-1=>"(Banned)");

	# Authorization
	User::Auth();
	User::AuthGM();

	if (!isset($_POST['submit'])) {
	# Start Template
	Template::doACP_Head("","",true,"6","Account Search");
		echo '<form method="POST">';
			echo '<div class="form-group mx-sm-3 mb-2">';
				echo '<td><input type="text" class="form-control" name="UserID" placeholder="Account Name"/></td>';
            echo '</div>';
                    echo '<button type="submit" class="btn btn-sm btn-primary tac" style="margin-left:5px" name="submit">Submit</button>';
		echo '</form>';
	# End Template
	Template::doACP_Foot();
	}else{
		if(strlen($UserID)<1){die("Account name is too short.");}
		$sql = ("
						SELECT c.CharName, c.CharID, u.Status FROM ".Database::getTable("SH_CHARDATA")." c
						INNER JOIN ".Database::getTable("SH_USERDATA")." u ON u.UserUID = c.UserUID
						WHERE u.UserID=?
		");
		$query=Database::connect()->prepare($sql);
		$args = array($UserID);
		$query->execute($args);
		$result = $query->fetchAll();
		$rowCount = count($result);
		LogSys::createLog("Searched For Account: ".$UserID);
		if($rowCount==0){
			die("No Accounts found!");
		}
		else{
			$sql = ("
						SELECT [Status] FROM ".Database::getTable("SH_USERDATA")." WHERE UserID ='".$UserID."'
			");
			$query=Database::connect()->prepare($sql);
			$args = array($UserID);
			$query->execute($args);
			$resA = $query->FETCH();
	# Start Template
	Template::doACP_Head("","",true,"6","Search results: <br/>Account: ".$UserID.$Status[$resA['Status']]."");
						echo '<table class="table table-dark">';
						echo '<tr>';
							echo '<th>UserName</th>';
							echo '<th>Char ID</th>';
							echo '<th>Char Name</th>';
						echo '</tr>';
					foreach($result as $res){
						echo '<tr>';
							echo '<td>'.$UserID.'</td>';
							echo '<td>'.$res['CharID'].'</td>';
#							echo '<td><a href="?'.$this->Setting->PAGE_PREFIX.'=ACCT_SEARCH&char='.$res['CharName'].'">'.$res['CharName'].'</a></td>';
							echo '<td>'.$res['CharName'].'</td>';
						echo '</tr>';
					}
					echo '</table>';
	# End Template
	Template::doACP_Foot();
		}
	}
?>