<?php
    # Authorization
	User::Auth();
	User::AuthADM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Access Logs");

	$count=1;
	$Where="";
	$User="";
	$Cat	=	"";

	$Category = isset($_POST["Category"]) ? Settings::$purifier->purify(trim($_POST["Category"])) : false;
	$User = isset($_POST["User"]) 		  ? Settings::$purifier->purify(trim($_POST["User"])) 	: false;
            # Start Template
			Template::doACP_Head("","",false,"12","Admin Panel Access Logs");
			if(isset($_POST['submit'])){
				if(isset($Category)){
					$Cat=Settings::$purifier->purify($_POST['Category']);
					switch($Cat){
						case "all": break;
						case "ban": $Where .= "WHERE Action LIKE 'Banned Character: %' OR Action LIKE 'Failed Ban On %' "; break;
						case "unban": $Where .= "WHERE Action LIKE '%Unban%' "; break;
						case "vpl": $Where .= "WHERE Action = 'Viewed Panel Log' "; break;
						case "vou": $Where .= "WHERE Action = 'Viewed Online Log' "; break;
						case "vbu": $Where .= "WHERE Action = 'Viewed Banned Log' "; break;
						case "vgl": $Where .= "WHERE Action = 'Viewed GS Staff List' "; break;
						case "vprr": $Where .= "WHERE Action = 'Viewed Page Rank Requirements' "; break;
						case "fc": $Where .= "WHERE Action LIKE 'Faction Change: %' "; break;
						case "login": $Where .= "WHERE Action LIKE '%Login%' "; break;
						case "logout": $Where .= "WHERE Action = 'User logged out.' "; break;
						case "mc": $Where .= "WHERE Action LIKE 'Modified Character: %' "; break;
						case "sfc": $Where .= "WHERE Action LIKE 'Searched For Character: %' "; break;
						case "sfa": $Where .= "WHERE Action LIKE 'Searched For Account: %' "; break;
						case "sfg": $Where .= "WHERE Action LIKE 'Searched For Guild: %' "; break;
						case "glc": $Where .= "WHERE Action LIKE 'Guild Leader Changed: %' "; break;
						case "cr": $Where .= "WHERE Action LIKE 'Resurrected Character: %' "; break;
						case "ga": $Where .= "WHERE Action LIKE 'Gave 25k AP to: %' "; break;
						case "vpb": $Where .= "WHERE Action LIKE 'Viewed Player''s Buffs(Player: %)' "; break;
						case "vel": $Where .= "WHERE Action LIKE 'Viewed Equipped Item Links (Player: %)' "; break;
						default: break;
					}
				}
				if(isset($User) && $User!==""){
					$User=Settings::$purifier->purify(trim($_POST['User']));
					if($Where===""){$Where="WHERE UserID=".$User."";}
					elseif($Where==="Action LIKE 'Banned Character: %' OR Action LIKE 'Failed Ban On %' "){
						$Where="Action LIKE 'Banned Character: %' AND UserID = ".$User." OR Action LIKE 'Failed Ban On %' AND UserID=".$User."";}
					else{$Where.="AND UserID=?";}
				}
				if($User===""){
					$sql = ("
									SELECT * FROM ".Database::getTable("LOG_ACCESS")." ".$Where." ORDER BY ActionTime DESC
	        		");
					$stmt = Database::connect()->prepare($sql);
					$stmt->execute();
				}
				else{
					$sql = ("
									SELECT * FROM ".Database::getTable("LOG_ACCESS")." ".$Where." ORDER BY ActionTime DESC
	        		");
					$stmt = Database::connect()->prepare($sql);
					$stmt->execute();
				}
				if($stmt === false){
					echo 'An error has occured.';
					die();
				}
			}else{
				$sql = ("
								SELECT TOP 75 * FROM ".Database::getTable("LOG_ACCESS")." ORDER BY ActionTime DESC
	        	");
				$stmt = Database::connect()->prepare($sql);
				$stmt->execute();
			}
			if(!$stmt->fetch()){
				echo 'Nothing in the logs!';
			die();
			}
				echo '<table class="table table-dark">';
					echo '<tr>';
						echo '<th>#</th>';
						echo '<th>UserID</th>';
						echo '<th>UserIP</th>';
						echo '<th>Action</th>';
						echo '<th>Action Time</th>';
					echo '</tr>';
				while($row=$stmt->fetch()){
					echo "<tr>";
					echo "<th>".$count."</th>";
					echo "<td>".$row['UserID']."</td>";
					echo "<td>".$row['UserIP']."</td>";
					echo "<td>".$row['Action']."</td>";
					echo "<td>".date("m/d/y H:i A", strtotime($row['ActionTime']))."</td>";
					echo "</tr>";
					$count++;
				}
				echo '</table>';
				# End Template
				Template::doACP_Foot();
?>