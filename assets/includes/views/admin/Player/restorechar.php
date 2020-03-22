<?php
    # Authorization
	User::Auth();
	User::AuthStaff();

	# Start Template
	Template::doACP_Head("","",true,"6","Resurrect A Character");

	$login = isset($_POST["login"]) ? Settings::$purifier->purify(trim($_POST["login"])) : false;
	$class = array(
		0 => 'Warrior', 1 => 'Guardian', 2 => 'Assasin', 3 => 'Hunter', 4 => 'Pagan', 5 => 'Oracle',
		6 => 'Fighter', 7 => 'Defender', 8 => 'Ranger', 9 => 'Archer', 10 => 'Mage', 11 => 'Priest'
	);
	$toon = isset($_POST["char"]) ? Settings::$purifier->purify(trim($_POST["char"])) : false;

	if (isset($_POST['submit'])) {
		if (strlen($login) < 1) {
			die("Invalid User Name.");
		}
		$sql = ("
					SELECT * FROM ".Database::getTable("SH_USERDATA")." WHERE UserID=?
		");
		$stmt=Database::connect()->prepare($sql);
		$args = array($login);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);
		if($rowCount==0){
			die("User ".$login." does not exist");
		}else{
			$sql2 = ("
						SELECT umg.Country, c.Family, c.CharName, c.CharID, c.Job, c.Level FROM ".Database::getTable("SH_UMG")." AS umg
						INNER JOIN ".Database::getTable("SH_CHARDATA")." AS c ON
						umg.UserUID = c.UserUID WHERE c.UserID=? AND c.Del=?
			");
			$stmt2=Database::connect()->prepare($sql2);
			$args2 = array($login,1);
			$stmt2->execute($args2);
			$result2 = $stmt2->fetchAll();
			$rowCount2 = count($result2);
			if($rowCount2==0){
				die("Account does not contain any dead characters.");
			}else{
						echo '<form method="POST">';
							echo '<font class="b u">Select Character To Resurrect :</font>';
							echo '<input type="hidden" name="username" value="'.$login.'">';
							echo '<table class="table table-dark">';
								echo '<tr>';
									echo '<th>Select</th>';
									echo '<th>CharName</th>';
									echo '<th>Class</th>';
									echo '<th>Level</th>';
								echo '</tr>';
					foreach($result2 as $chars){
						if ($chars['Country'] == 0) {
							if ($chars['Family'] == 0 || $chars['Family'] == 1) {
								echo '<tr>';
									echo '<td><input type="radio" name ="char" value="'.$chars['CharName'].','.$chars['CharID'].'"></td>';
									echo '<td>'.$chars['CharName'].'</td>';
									echo '<td>'.$class[$chars['Job'] + 6].'</td>';
									echo '<td>'.$chars['Level'].'</td>';
								echo '</tr>';
							}
						} else if ($chars['Country'] == 1) {
							if ($chars['Family'] == 2 || $chars['Family'] == 3) {
								echo '<tr>';
									echo '<td><input type="radio" name ="char" value="'.$chars['CharName'].','.$chars['CharID'].'"></td>';
									echo '<td>'.$chars['CharName'].'</td><td>'.$class[$chars['Job']].'</td>';
									echo '<td>'.$chars['Level'].'</td>';
								echo '</tr>';
							}
						}
					}
					echo '</table>';
                    echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit2" style="margin-top:5px;">Submit</button>';
			}
		}
	} else if (isset($_POST['submit2'])) {
		$login = isset($_POST["username"]) ? Settings::$purifier->purify(trim($_POST["username"])) : false;
		$slot  = -1;
		$sql1 = ("
					SELECT MIN(Slots.Slot) AS OpenSlot FROM
					(SELECT 0 AS Slot UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) AS Slots
					LEFT JOIN
					(SELECT c.Slot
					FROM ".Database::getTable("SH_USERDATA")." AS um
					INNER JOIN ".Database::getTable("SH_CHARDATA")." AS c ON c.UserUID = um.UserUID
					WHERE um.UserID=?
					AND c.Del=?) AS Chars ON Chars.Slot = Slots.Slot
					WHERE Chars.Slot IS NULL
			");
			$stmt1=Database::connect()->prepare($sql1);
			$args1 = array($login,0);
			$stmt1->execute($args1);
		$slot = $stmt1->FETCH();
		$toon2 = explode(',', $toon);
        if ($slot['OpenSlot'] > -1 && $slot['OpenSlot'] < 5) {
			$sql = ("
						UPDATE ".Database::getTable("SH_CHARDATA")."
						SET Del=?, Slot=?,Map=?,PosX=? ,PosZ=?,DeleteDate=NULL,RemainTime=?
						WHERE CharID=?
			");
			$stmt=Database::connect()->prepare($sql);
			$args = array(0,$slot['OpenSlot'],42,63,57,0,$toon2[1]);
			$stmt->execute($args);
					           echo '<div class="panel-body">';
					echo 'Successfully resurrected <br /> Account = '.$login.'<br />In Slot = '.($slot[0] + 1).'<br />Character = '.$toon2[0].'';
			LogSys::createLog("Resurrected Character: ".$toon2[0]."");
		} else {
					echo 'No slots avaliable.';
die();
		}
	} else {
				echo '<form method="POST">';
                     echo '<div class="form-group mx-sm-3 mb-2">';
							echo '<input type="text" placeholder="Account ID" class="form-control tac b_i" name="login" />';
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-left:5px;">Submit</button>';
                echo '</form>';
	}
# End Template
Template::doACP_Foot();
?>