<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	# Start Template
	Template::doACP_Head("","",true,"6","Guild Name Change");
		$guild = isset($_POST["guild"]) ? Settings::$purifier->purify(trim($_POST["guild"])) : false;
		if (isset($_POST['submit'])){
			if (strlen($guild)<1){
				die("Invalid Guild Name.");
			}
			$sql = ("
						SELECT * FROM ".Database::getTable("SH_GUILDS")." Where GuildName=?
			");
			$stmt=Database::connect()->prepare($sql);
			$args = array($guild);
			$stmt->execute($args);
			$result = $stmt->fetchAll();
			$rowCount = count($result);
			if($rowCount==0){
				die("Guild '".$guild."' does not exist");
			}
			else{
				echo '<form method="POST">';
						echo '<input type="hidden" name="guild" value="'.$guild.'">';
						foreach($result as $chars){
						echo '<input type="hidden" name="guild-id" value="'.$chars['GuildID'].'">';
						}
                        echo '<input type="text" name="newname" placeholder="New Guild Name" class="form-control tac b_i"/></td>';
#				echo "<option value=\"".$chars['UserUID'].",".$chars['UserID'].",".$chars['CharName'].",".$chars['CharID']."\">".$chars['CharName']."</option>";
						echo '<br /><br />';
					echo "<input type=\"submit\" value=\"Submit\" class=\"btn btn-sm btn-primary m_auto\" name=\"submit2\" />";
				echo "</form>";
			}
		}else if (isset($_POST['submit2'])){

			$newname = isset($_POST["newname"]) ? Settings::$purifier->purify(trim($_POST["newname"])) : false;
			$guild 	 = isset($_POST["guild"]) ? Settings::$purifier->purify(trim($_POST["guild"])) : false;
			$guildid = isset($_POST["guild-id"]) ? Settings::$purifier->purify(trim($_POST["guild-id"])) : false;

			echo "Guild = ".$guild."<br />";
			echo "New Guild Name = ".$newname."";
			$sql = ("
						UPDATE ".Database::getTable("SH_GUILDS")." SET GuildName=? WHERE GuildID=?
			");
			$stmt=Database::connect()->prepare($sql);
			$args = array($newname,5);
			$stmt->execute($args);
			LogSys::createLog("Guild name changed. Guild Name: (".$guild.") => New Name: (".$newname.")");
		}else{
			echo '<form method="POST">';
				echo '<div class="form-group mx-sm-3 mb-2">';
					echo '<input type="text" class="form-control tac b_i" placeholder="Guild Name" name="guild" />';
				echo '</div>';
                    echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-left:10px;">Submit</button>';
			echo '</form>';
		}
	# End Template
	Template::doACP_Foot();
?>