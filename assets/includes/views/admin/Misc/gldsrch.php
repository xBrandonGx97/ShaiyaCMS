<?php
	# Authorization
	User::Auth();
	User::AuthGM();

	$GuildName = isset($_POST["Guild"]) ? Settings::$purifier->purify(trim($_POST["Guild"])) : false;

	$Rank=array(0=>"Waiting List",1=>"Guild Leader",2=>"Officer",3=>"Rank 3",4=>"Rank 4",5=>"Rank 5",6=>"Rank 6",7=>"Rank 7",8=>"Rank 8",9=>"Rank 9");

	if(!isset($_POST['submit'])){
	# Start Template
	Template::doACP_Head("","",true,"6","Find Players Within A Guild");
				echo '<form method="POST">';
                    echo '<div class="form-group mx-sm-3 mb-2">';
				        echo '<input type="text" name="Guild" class="form-control" placeholder="Guild Name" />';
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-left:5px;">Submit</button>';
				echo '</form>';
	# End Template
	Template::doACP_Foot();
	}else{
		if(strlen($GuildName)<1){
	# Start Template
	Template::doACP_Head("","",true,"6","Find Players Within A Guild");
					echo "Guilds's name is too short!";
					echo '<form method="POST">';
						echo '<br />';
						echo '<input type="submit" class="btn btn-sm btn-primary m_auto" value="Try Again" />';
					echo '</form>';
	# End Template
	Template::doACP_Foot();
					die();
		}
		$sql = ("
					SELECT g.GuildName, gc.GuildLevel, c.CharName, gc.JoinDate
					FROM ".Database::getTable("SH_GUILD_CHARS")." gc
					INNER JOIN ".Database::getTable("SH_GUILDS")." g ON g.GuildID = gc.GuildID
					INNER JOIN ".Database::getTable("SH_CHARDATA")." c on c.CharID = gc.CharID
					WHERE gc.Del = 0 AND c.Del = 0 and g.Del = 0 AND g.GuildName = '".$GuildName."' ORDER BY gc.GuildLevel
		");
		$stmt=Database::connect()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$rowCount = count($result);
		LogSys::createLog("Searched For Guild: ".$GuildName);
		if($rowCount==0){
	# Start Template
	Template::doACP_Head("","",true,"6","Find Players Within A Guild");
					echo "No guilds were found that matched the search criteria.";
					echo '<form class="form-inline" method="POST">';
						echo '<br />';
						echo '<input type="submit" class="btn btn-sm btn-primary m_auto" value="Try Again" />';
					echo '</form>';
	# End Template
	Template::doACP_Foot();
			die();
		}else{
				# Start Template
				Template::doACP_Head("","",false,"12","Find Players Within A Guild");
				echo 'Characters Found in Guild '.$GuildName.':';
				echo '<table class="table table-dark">';
					echo '<tr>';
						echo '<th>Guild Name</th>';
						echo '<th>Rank</th>';
						echo '<th>Character Name</th>';
						echo '<th>Join Date</th>';
					echo '</tr>';
					foreach($result as $res){
					echo "<tr>";
						echo '<td>'.$res['GuildName'].'</td>';
						echo '<td>'.$Rank[$res['GuildLevel']].'</td>';
						echo '<td>'.$res['CharName'] .'</td>';
						echo '<td>'.date("m/d/Y g:i:s A", strtotime($res['JoinDate'])).'</td>';
					echo '</tr>';
				}
				echo '</table>';
				# End Template
				Template::doACP_Foot();
		}
	}
?>