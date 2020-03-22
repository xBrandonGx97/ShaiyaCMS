<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Item Search Log");

	# Form Data
	$count=0;
	# Start Template
	Template::doACP_Head("","",true,"6","Item Search By Category");

	if(isset($_POST['submit'])){

	$itemid = isset($_POST["ItemID"]) ? Settings::$purifier->purify(trim($_POST["ItemID"])) : false;
	$sql = ("
				SELECT * FROM ".Database::getTable("SH_ITEMS")." WHERE Type=? AND LEFT(ItemName, 1) != '?' ORDER BY ItemID
	");
	$stmt=Database::connect()->prepare($sql);
	$args = array($itemid);
	$stmt->execute($args);
	$result = $stmt->fetchAll();
	$rowCount = count($result);

	if($rowCount==0){
		echo 'Search returned no results.';
	}
		echo '<form method="POST">';
			echo '<div class="form-group mx-sm-3 mb-2">';
				echo '<table class="table table-dark"><tr>
					 <th>ItemName</th>
					 <th>ItemID</th>
					 <th>Type</th>
					 <th>TypeID</th></tr>';
					foreach($result as $row){
					echo '<tr><td>'.$row['ItemName'].'</td>
						<td>'.$row['ItemID'].'</td>
						 <td>'.$row['Type'].'</td>
						 <td>'.$row['TypeID'].'</td>
					</tr>';
					}
                echo '</table>';
			echo '</div>';
		echo '</form>';
	}
	else{
	echo '<form method="POST">';
		echo '<div class="form-group mx-sm-3 mb-2">';
			echo '<table class="table table-dark">';
            echo 'Item Category:';
				echo '
                <select name="ItemID" class="form-control">
					<option value="1">1 Handed Sword</option>
					<option value="2">2 Handed Sword</option>
					<option value="3">1 Handed Axe</option>
					<option value="4">2 Handed Sword</option>
					<option value="5">Duel Swords/Axes</option>
					<option value="6">Spears</option>
					<option value="7">1 Handed Blunts</option>
					<option value="8">2 Handed Blunts</option>
					<option value="9">1 Handed Dagger</option>
					<option value="10">Dagger</option>
					<option value="11">Javelings</option>
					<option value="12">Staffs</option>
					<option value="13">Bow</option>
					<option value="14">Crossbows</option>
					<option value="15">Claws</option>
					<option value="16">AOL Helms</option>
					<option value="17">AOL Tops</option>
					<option value="18">AOL Pants</option>
					<option value="19">AOL Shields</option>
					<option value="20">AOL Gaunts</option>
					<option value="21">Aol Boots</option>
					<option value="22">Rings</option>
					<option value="23">Amulets</option>
					<option value="24">AOL Caps/Dashing Extream</option>
					<option value="25">Potions / Enchant Items</option>
					<option value="27">Quest Items</option>
					<option value="28">More Quest Items</option>
					<option value="29">More Quest Items</option>
					<option value="30">Lapis</option>
					<option value="31">UOF Helms</option>
					<option value="32">UOF Tops</option>
					<option value="33">UOF Pants</option>
					<option value="34">UOF Shields</option>
					<option value="35">UOF Gaunts</option>
					<option value="36">UOF Boots</option>
					<option value="38">EP5 Enchant Items</option>
					<option value="39">Fury Caps</option>
					<option value="40">Loops</option>
					<option value="42">Mounts</option>
					<option value="43">Etin</option>
					<option value="44">Few Enchants/Quest Items</option>
					<option value="94">Gold Bars</option>
					<option value="95">Lapisia</option>
					<option value="100">DP Items</option>
                </select>
                ';
			echo '</table>';
				echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-left:5px;">Submit</button>';
		echo '</div>';
	echo '</form>';
	}
	# End Template
	Template::doACP_Foot();
?>