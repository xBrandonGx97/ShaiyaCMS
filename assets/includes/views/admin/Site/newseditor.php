<?php
	# Authorization
	User::Auth();
	User::AuthADM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed News Editor");

	$postSuccess='';
	$deleteSuccess='';
	$errors=array();

	if(isset($_POST['submit'])){
		$titleAdd = isset($_POST["titleAdd"]) ? Settings::$purifier->purify(trim($_POST["titleAdd"])) : false;
		$urlAdd = isset($_POST["urlAdd"]) ? Settings::$purifier->purify(trim($_POST["urlAdd"])) : false;
		$detailAdd = isset($_POST["detailAdd"]) ? Settings::$purifier->purify(trim($_POST["detailAdd"])) : false;
		$errors=array();
		if(empty($titleAdd) || empty($detailAdd)){$errors[] = 'Please verify all fields';}
		if (empty($errors)){
			$sql = ("
							INSERT INTO ".Database::getTable("NEWS")." (Title,Detail,ReadMore,Bywho) VALUES (?,?,?,?)
	        ");
			$stmt = Database::connect()->prepare($sql);
			$params = array($titleAdd,$detailAdd,$urlAdd,$_SESSION['Username']);
			$stmt->execute($params);
			$postSuccess='<strong>SUCCESS:</strong> News has been posted!';
		}
	}
	if(isset($_POST['deleteBtn'])){
		$deletes=$_POST['deleteCheck'];
		foreach($deletes as $delete){
			$sql = ("
							DELETE FROM ".Database::getTable("NEWS")." WHERE RowID=?
	        ");
			$stmt = Database::connect()->prepare($sql);
			$params = array($delete);
			$stmt->execute($params);
		}
		$deleteSuccess = '<strong>SUCCESS:</strong> News Has Been Removed!';
	}
			# Start Template
			Template::doACP_Head("","",false,"12","News Control Zone");
			echo '<div id="tabs">';
				echo '<ul>';
					echo '<li><a href="#tabs-1">Post News</a></li>';
					echo '<li><a href="#tabs-2">Delete News</a></li>';
				echo '</ul>';
				#	Post News Tab
				echo '<div id="tabs-1">';
                    echo '<form method="POST">';
						echo '<div id="error">';
							if(count($errors)!=0){
								echo '<h1>Error!</h1>';
								foreach($errors as $error){
									echo '<div id="error-msg" class="red-base">'.$error.'</div>';
								}
							}else{echo '<div id="error-msg">'.$postSuccess.'</div>';}
						echo '</div>';
                        echo '<div class="form-group">';
						echo '<div id="label1"><input type="text" name="titleAdd" class="form-control tac b_i" placeholder="Post Title" /></div><br>';
						echo '<div id="label1"><input type="text" name="urlAdd" class="form-control tac b_i" style="margin-bottom:10px" placeholder="Forum Post URL" /></div>';
						echo '<div id="label2"><textarea class="tinymce" name="detailAdd"></textarea></div>';
                        echo '</div>';
						echo '<div style="text-align: right;">';
                            echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-top:5px;">Post New News</button>';
						echo '</div>';
					echo '</form>';
				echo '</div>';
			#	Delete News Tab
				echo '<div id="tabs-2">';
					echo '<form class="form-inline" method="POST">';
					echo '<div style="text-align:center;">'.$deleteSuccess.'</div><br />';
						echo '<table cellpadding="0" cellspacing="0" width="100%" class="table table-dark">';
							echo '<tr>';
								echo '<th><input type="checkbox" disabled="disabled" /></th>';
								echo '<th>Post ID</th>';
								echo '<th>Post Title</th>';
								echo '<th>Post Date</th>';
							echo '</tr>';
						$sql = ("
										SELECT * FROM ".Database::getTable("NEWS")." ORDER BY RowID ASC
	        			");
						$stmt = Database::connect()->prepare($sql);
						$stmt->execute();
						while($NewsStats=$stmt->fetch(PDO::FETCH_NUM)){
							echo '<tr>';
								echo '<th><input type="checkbox" name="deleteCheck[]" value="'.$NewsStats[0].'"/></th>';
								echo '<td>'.Settings::$purifier->purify(htmlentities($NewsStats[0])).'</td>';
								echo '<td>'.Settings::$purifier->purify(htmlentities($NewsStats[1])).'</td>';
								echo '<td>'.Settings::$purifier->purify(htmlentities(date("m/d/y h:i:s A", strtotime($NewsStats[5])))).'</td>';
							echo '</tr>';
						}
						echo '</table>';
						echo '<div style="text-align: right;">';
							echo '<br />';
							echo '<input type="submit" class="btn btn-sm btn-primary m_auto" value="Delete Selected News" name="deleteBtn" />';
						echo '</div>';
					echo '</form>';
				echo '</div>';
			echo '</div>'; # end of tabs
			# End Template
			Template::doACP_Foot();
?>