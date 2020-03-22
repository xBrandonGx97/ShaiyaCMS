<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	$UserUID 	= isset($_POST["UserUID"]) 		? Settings::$purifier->purify(trim($_POST["UserUID"])) 	: false;
	$UserID 	= isset($_POST["UserID"]) 		? Settings::$purifier->purify(trim($_POST["UserID"])) 	: false;
	$ItemID 	= isset($_POST["ItemID"]) 		? Settings::$purifier->purify(trim($_POST["ItemID"])) 	: false;
	$ItemUID 	= isset($_POST["ItemUID"]) 		? Settings::$purifier->purify(trim($_POST["ItemUID"])) 	: false;
	$Type 		= isset($_POST["Type"]) 		? Settings::$purifier->purify(trim($_POST["Type"])) 		: false;
	$TypeID 	= isset($_POST["TypeID"]) 		? Settings::$purifier->purify(trim($_POST["TypeID"])) 	: false;
	$Gem1 		= isset($_POST["Gem1"]) 		? Settings::$purifier->purify(trim($_POST["Gem1"])) 		: false;
	$Gem2 		= isset($_POST["Gem2"]) 		? Settings::$purifier->purify(trim($_POST["Gem2"])) 		: false;
	$Gem3 		= isset($_POST["Gem3"]) 		? Settings::$purifier->purify(trim($_POST["Gem3"])) 		: false;
	$Gem4 		= isset($_POST["Gem4"]) 		? Settings::$purifier->purify(trim($_POST["Gem4"])) 		: false;
	$Gem5 		= isset($_POST["Gem5"]) 		? Settings::$purifier->purify(trim($_POST["Gem5"])) 		: false;
	$Gem6 		= isset($_POST["Gem6"]) 		? Settings::$purifier->purify(trim($_POST["Gem6"])) 		: false;
	$Count 		= isset($_POST["Count"]) 		? Settings::$purifier->purify(trim($_POST["Count"])) 		: false;
	$Str 		= isset($_POST["Str"]) 			? Settings::$purifier->purify(trim($_POST["Str"])) 		: false;
	$Dex 		= isset($_POST["Dex"]) 			? Settings::$purifier->purify(trim($_POST["Dex"])) 		: false;
	$Rec 		= isset($_POST["Rec"]) 			? Settings::$purifier->purify(trim($_POST["Rec"])) 		: false;
	$Int 		= isset($_POST["Int"]) 			? Settings::$purifier->purify(trim($_POST["Int"])) 		: false;
	$Wis 		= isset($_POST["Wis"]) 			? Settings::$purifier->purify(trim($_POST["Wis"])) 		: false;
	$Luc 		= isset($_POST["Luc"]) 			? Settings::$purifier->purify(trim($_POST["Luc"])) 		: false;
	$HP 		= isset($_POST["HP"]) 			? Settings::$purifier->purify(trim($_POST["HP"])) 		: false;
	$MP			= isset($_POST["MP"]) 			? Settings::$purifier->purify(trim($_POST["MP"])) 		: false;
	$SP 		= isset($_POST["SP"]) 			? Settings::$purifier->purify(trim($_POST["SP"])) 		: false;
	$Enchant 	= isset($_POST["Enchant"]) 		? Settings::$purifier->purify(trim($_POST["Enchant"])) 	: false;

	# Start Template
	Template::doACP_Head("","",true,"6","W.H. Items Edit");

	if (isset($_POST['SCN'])){
		$Set = false; //Change to True to have it based off ReqWis, false for custom input.
		$Armor  = array(16,17,18,19,20,21,31,32,33,34,35,36,67,68,69,70,71,82,83,84,85);
		$sql = ("
					SELECT c.Count,c.ItemID,c.Type,c.TypeID,c.Gem1,c.Gem2,c.Gem3,c.Gem4,c.Gem5,Gem6,SUBSTRING(c.Craftname, 1, 2) AS 'Str',SUBSTRING(c.Craftname, 3, 2) AS 'Dex',SUBSTRING(c.Craftname, 5, 2) AS 'Rec',
					SUBSTRING(c.Craftname, 7, 2) AS 'Int',SUBSTRING(c.Craftname, 9, 2) AS 'Wis',SUBSTRING(c.Craftname, 11, 2) AS 'Luc',
					SUBSTRING(c.Craftname, 13, 2) AS 'HP',SUBSTRING(c.Craftname, 15, 2) AS 'MP',SUBSTRING(c.Craftname, 17, 2) AS 'SP',
					SUBSTRING(c.Craftname, 19, 2) AS 'Enchant',c.ItemUID,I.ItemName,I.ReqWis,I.Type
					FROM ".Database::getTable("SH_USERWH")." c
					INNER JOIN ".Database::getTable("SH_ITEMS")." I ON I.ItemID=c.ItemID
					WHERE c.ItemUID=?
		");
		$stmt=Database::connect()->prepare($sql);
		$args = array($ItemUID);
		$stmt->execute($args);

		$Result = $stmt->FETCH();

		$Fields = array('ItemName','ItemUID','ItemID','Type','TypeID','Gem1','Gem2','Gem3','Gem4','Gem5','Gem6','Str','Dex','Rec','Int','Wis','Luc','HP','MP','SP','Enchant','Count');
		$NoEdit = array('ItemName','ItemUID');

		echo '<form method="POST">';
		echo 'IF Weapon Enchant = 1-50<p>If Gear Enchant = 51-99<p> Gem = slots Use TypeID of the lapis to link<p> IE: Max craft = 30007 so Gem would be 7!!';
		echo '<div class="table-responsive">';
		echo '<table class="table table-dark">';

		foreach ($Fields as $Columns)
		{
			echo '<tr><th>' . $Columns . '</th>';
			if (in_array($Columns, $NoEdit))
			{
				echo '<th><input type="text" class="form-control" value="' . $Result[$Columns] . '" name="' . $Columns . '" style="background:#c0c0c0;" READONLY></th>';
			}
			else
			{
				if ($Set)
				{
					if ($Columns == 'Enchant')
					{
						echo '<td><select class="form-control" style="width:100%;" name="' . $Columns . '">';
						echo '<option value="00">00</option>';
						if (in_array($Result['Type'], $Armor))
						{
							for ($e = 50; $e <= 70; $e++)
							{
								if ($e == $Result[$Columns])
								{
									echo '<option value="' . $e . '" selected>' . $e . '</option>';
								}
								echo '<option value="' . $e . '">' . $e . '</option>';
							}
						}
						else
						{
							for ($a = 1; $a <= 20; $a++)
							{
								$a = str_pad($a, 2, 0, STR_PAD_LEFT);
								if ($a == $Result[$Columns])
								{
									echo '<option value="' . $a . '" selected>' . $a . '</option>';
								}
								echo '<option value="' . $a . '">' . $a . '</option>';
							}
						}
						echo '</select></td>';
					}
					else
					{
						echo '<td><select style="width:100%;" name="' . $Columns . '">';
						for ($i = 0; $i <= $Result['ReqWis']; $i++)
						{
							$i = str_pad($i, 2, 0, STR_PAD_LEFT);
							if ($i == $Result[$Columns])
							{
								echo '<option value="' . $i . '" selected>' . $i . '</option>';
							}
							else
							{
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
						}
						echo '</select></td>';
					}
				}
				else
				{
					echo '<th><input type="text" class="form-control" name="' . $Columns . '" value="' . $Result[$Columns] . '" /></th>';
				}
			}
			echo '</tr>';
		}
		echo '</table>';
		echo "<input type='hidden' name='UserUID' value='".$UserUID."' />";
		echo '<input type="Submit" class="btn btn-sm btn-primary m_auto" value="Submit" name="CNE">';
		echo '</div>';
		echo '</form>';
	}

	elseif (isset($_POST['CNE']))
	{
		$Craftname = $Str . $Dex . $Rec . $Int . $Wis . $Luc;
		$Craftname .= $HP . $MP . $SP . $Enchant;

		$sql = ("
					UPDATE ".Database::getTable("SH_USERWH")." SET ItemID = ?, Type = ?, TypeID = ?, Gem1 = ?, Gem2 = ?, Gem3 = ?, Gem4 = ?, Gem5 = ?, Gem6 = ?, Count = ?, Craftname = ? WHERE ItemUID=?
		");
		$stmt=Database::connect()->prepare($sql);
		$args = array($ItemID,$Type,$TypeID,$Gem1,$Gem2,$Gem3,$Gem4,$Gem5,$Gem6,$Count,$Craftname,$ItemUID);
		$stmt->execute($args);

		foreach ($_POST as $Name => $Value){
			echo $Name . '=>' . $Value . '<br>';
		}

		echo '<form method="POST">';
		echo '<input type="hidden" name="UserUID" value="'.$UserUID.'" />';
		echo '<input type="submit" class="btn btn-sm btn-primary m_auto" name="SCI" value="Same Char">';
	}

	elseif (isset($_POST['SC'])){
		if (empty($UserID)){
			die('You didn\'t specify a Character Name!');
		}

		$sql = ("
					SELECT * FROM ".Database::getTable("SH_CHARDATA")." where CharName = ?
		");
		$stmt=Database::connect()->prepare($sql);
		$args = array($UserID,0);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);

		if($rowCount==0){
			die('Admin Account Log returned no results. (Char)');
		}else{
				$sql = ("
							SELECT UserID,UserUID,CharName FROM ".Database::getTable("SH_CHARDATA")." WHERE CharName = ?
				");
				$stmt=Database::connect()->prepare($sql);
				$args = array($UserID,0);
				$stmt->execute($args);
				$result = $stmt->fetchAll();
				$rowCount = count($result);

				if($rowCount==0){
					echo 'Character search for: "'.$UserID.'" returned no results.';
				}

				echo '<form method="POST">';
					echo '<div class="table-responsive">';
						echo '<table class="table table-dark">';
							echo '<thead>';
								echo '<tr>';
									echo '<tr>';
										echo '<th>CharName</th>';
										echo '<th>UserID</th>';
										echo '<th>UserUID</th>';
										echo '<th>Select</th>';
									echo '</tr>';
								echo '</thead>';
							echo '<tbody>';
				foreach($result as $Row){
					echo '<tr><td>' . $Row['CharName'] . '</td><td>' . $Row['UserID'] . '</td><td>' . $Row['UserUID'] . '</td>	<td><input type="radio" name="UserUID" value="' . $Row['UserUID'] . '"></td></tr>';
				}
				echo '</tbody>';
			echo '</table>';
				echo '<input type="Submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" value="Submit" name="SCI">';
				echo '</form>';
		}
	}

	elseif (isset($_POST['SCI'])){
		if (!isset($UserUID)) {
			die('You didn\'t select a Character!');
		}

		$Bag = array(
			0 => 'Equipped',
			1 => 'Bag 1',
			2 => 'Bag 2',
			3 => 'Bag 3',
			4 => 'Bag 4',
			5 => 'Bag 5'
		);

		$sql = ("
					SELECT I.ItemName,CI.Slot,CI.Count,CI.ItemUID,CI.UserUID FROM ".Database::getTable("SH_USERWH")." CI INNER JOIN ".Database::getTable("SH_ITEMS")." I ON I.ItemID=CI.ItemID WHERE CI.UserUID = ? ORDER BY CI.Slot
		");
		$stmt=Database::connect()->prepare($sql);
		$args = array($UserUID,0);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);

		if($rowCount==0){
			echo "Search returned no results. (Items) for ".$UserUID;
		}

		echo '<form method="POST">';
		echo '<div class="table-responsive">';
				echo '<table class="table table-dark">';
				echo '<thead>';
						echo '<tr>';
							echo '<th>ItemName</th>';
							echo '<th>Slot</th>';
							echo '<th>Count</th>';
							echo '<th>Select</th>';
						echo '</tr>';
					echo '</thead>';
				echo '<tbody>';
		foreach($result as $Row){
			echo '<tr><td>' . $Row['ItemName'] . '</td>
			<td>' . $Row['Slot'] . '</td>
			<td>' . $Row['Count'] . '</td>
			<td><input type="radio" name="ItemUID" value="' . $Row['ItemUID'] . '"></td>
			</tr>';
		}
		echo '</tbody>';
	echo '</table>';
		echo "<input type='hidden' name='UserUID' value='".$UserUID."' />";
		echo '<input type="Submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" value="Submit" name="SCN">';
		echo '</form>';
	}
	else {
	echo '<form method="POST">';
		echo '<div class="form-group mx-sm-3 mb-2">';
	echo '<input type="text" name="UserID" placeholder="Character Name" class="form-control tac b_i"></td>';
		echo '</div>';
	echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SC" style="margin-left:5px;">Submit</button>';
	echo '</form>';
	}
	Template::doACP_Foot();
?>
