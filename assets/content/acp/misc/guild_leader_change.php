<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();

	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"6","Guild Leader Change");
	
		$guild = isset($_POST["guild"]) ? $this->Data->escData(trim($_POST["guild"])) : false;
		if (isset($_POST['submit'])){
			if (strlen($guild)<1){die("Invalid Guild Name.");}
			$sql = ("
						SELECT g.MasterName,g.GuildID,c.CharName,c.UserUID,c.UserID,c.CharID
						FROM ".$this->db->get_TABLE("SH_CHARDATA")." as c
						INNER JOIN ".$this->db->get_TABLE("SH_GUILD_CHARS")." as gc on c.CharID=gc.CharID
						INNER JOIN ".$this->db->get_TABLE("SH_GUILDS")." as g on gc.GuildID=g.GuildID
						WHERE gc.GuildLevel=? and g.GuildName=?
			");
			$stmt=$this->db->conn->prepare($sql);
		 	$args = array(2,$guild);
			$stmt->execute($args);
			$result = $stmt->fetchAll();
			$rowCount = count($result);
			if($rowCount==0){
				die("Guild '".$guild."' does not exist");
			}else{
				echo '<form method="POST">';
					echo 'Select New Leader: ';
						echo '<input type="hidden" name="guild" value="'.$guild.'">';
						foreach($result as $chars){
						echo '<input type="hidden" name="guild-id" value="'.$chars['GuildID'].'">';
						echo '<input type="hidden" name="oldlead" value="'.$chars['MasterName'].'">';
						echo '<select name="newlead" class="form-control" width="20" style="width:20%">';
#				echo "<option value=\"".$chars['UserUID'].",".$chars['UserID'].",".$chars['CharName'].",".$chars['CharID']."\">".$chars['CharName']."</option>";
							echo "<option value=\"".$chars['UserUID'].",".$chars['UserID'].",".$chars['CharName'].",".$chars['CharID']."\">".$chars['CharName']."</option>";
						}
						echo "</select>";
						echo '<br /><br />';
					echo "<input type=\"submit\" value=\"Submit\" class=\"btn btn-sm btn-primary m_auto\" name=\"submit2\" />";
				echo "</form>";
			}
		}else if (isset($_POST['submit2'])){
			$newlead = isset($_POST["newlead"]) ? $this->Data->escData(trim($_POST["newlead"])) : false;
			$oldlead = isset($_POST["oldlead"]) ? $this->Data->escData(trim($_POST["oldlead"])) : false;
			$guild 	 = isset($_POST["guild"]) ? $this->Data->escData(trim($_POST["guild"])) : false;
			$guildid = isset($_POST["guild-id"]) ? $this->Data->escData(trim($_POST["guild-id"])) : false;
			$newlead = explode(',', $newlead);
			echo "Guild = ".$guild."<br />";
			echo "Old Leader = ".$oldlead."<br />";
			echo "New Leader = ".$newlead[2]."";
			$sql = ("
						UPDATE ".$this->db->get_TABLE("SH_GUILD_CHARS")."
						SET GuildLevel=?
						WHERE GuildLevel=? and GuildID=?
			");
			$stmt=$this->db->conn->prepare($sql);
		 	$args = array(8,1,$guildid);
			$stmt->execute($args);
			$sql = ("
						UPDATE ".$this->db->get_TABLE("SH_GUILDS")."
						SET MasterUserID=?, MasterCharID=?,MasterName=? 
						WHERE GuildName=?
			");
			$stmt=$this->db->conn->prepare($sql);
		 	$args = array($newlead[1],$newlead[3],$newlead[2],$guild);
			$stmt->execute($args);
			$sql = ("
						UPDATE ".$this->db->get_TABLE("SH_GUILD_CHARS")." 
						SET GuildLevel=?
						WHERE CharID=?
			");
			$stmt=$this->db->conn->prepare($sql);
		 	$args = array(1,$newlead[3]);
			$stmt->execute($args);
			$this->LogSys->createLog("Guild leader changed. Guild Name: (".$guild.") Old Leader: (".$oldlead.") => New Leader: (".$newlead[2].")");
		}else{
			echo '<form method="POST">';
				echo '<div class="form-group mx-sm-3 mb-2">';
					echo '<input type="text" class="form-control tac b_i" placeholder="Guild Name" name="guild" />';
				echo '</div>';
                	echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-left:10px;">Submit</button>';
			echo '</form>';
		}
		# End Template
		$this->Tpl->_do_ACP_pageFooter();
?>