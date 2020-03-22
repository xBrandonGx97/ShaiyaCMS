<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	# Start Template
	Template::doACP_Head("","",true,"6","DP Handout");
	//Form Data
	$DP			=	isset($_POST["DP"])		?	Settings::$purifier->purify(trim($_POST["DP"]))		:	false;
	$UserID		=	isset($_POST["UserID"])	?	Settings::$purifier->purify(trim($_POST["UserID"]))	:	false;
	$success = false;

if (isset($_POST['submit'])){
	if (empty($_POST['UserID'])){
		die('You didn\'t specify an Account Name!');
	}

	$sql = ("
					SELECT * FROM ".Database::getTable("SH_CHARDATA")." where CharName = ?
	");
	$query=Database::connect()->prepare($sql);
	$query->bindValue(1, $UserID, PDO::PARAM_INT);
	$query->execute();
	$result = $query->fetchAll();
	$rowCount = count($result);
		if($rowCount==0){
			echo 'No chars matched the query';
		}
		else{
			foreach($result as $res){
				$queryPoint=Database::connect()->prepare("
					UPDATE ".Database::getTable("SH_USERDATA")." SET Point = Point + ? WHERE UserID = ?
				");
				$params = array($DP,$res['UserID']);
				$queryPoint->execute($params);

				$success = 'Sucesfuly added '.$params[0].' Point(s) to ' . $UserID . '\'s account.';
			}
				$queryChar=Database::connect()->prepare("
					SELECT * FROM ".Database::getTable("SH_CHARDATA")." where CharName = ?
				");
				$paramsChar = array($UserID);
				$queryChar->execute($paramsChar);
		echo $success;
		}
}
else{
		echo '<form method="POST">';
		echo '<div class="form-group mx-sm-3 mb-2">';
			echo '<input type="text" name="UserID" placeholder="Char Name" class="form-control tac b_i"/>';
		echo '</div>';
		echo '<div class="form-group mx-sm-3 mb-2">';
			echo '<input type="text" name="DP" placeholder="DP Amount" class="form-control tac b_i" style="margin-left:5px !important"/>';
		echo '</div>';
			echo '<input type="submit" class="btn btn-sm btn-primary m_auto" style="margin-left:5px !important;" value="Submit" name="submit" />';
		echo '</form>';
}
# End Template
Template::doACP_Foot();
?>
