<?php
	# Authorization
	User::Auth();
	User::AuthADM();

	#	Create DATABASE LOG
	LogSys::createLog("Viewed Patchnotes Editor");

	$postSuccess='';
	$deleteSuccess='';

	$errors=array();
	if(isset($_POST['submit'])){
		$titleAdd = isset($_POST["titleAdd"]) ? Settings::$purifier->purify(trim($_POST["titleAdd"])) : false;
		$detailAdd = isset($_POST["detailAdd"]) ? Settings::$purifier->purify(trim($_POST["detailAdd"])) : false;
		if(empty($titleAdd) || empty($detailAdd)){
			$errors[]='Please verify all fields';}
		if(empty($errors)){
            $sql = ("
							INSERT INTO ".Database::getTable("PATCHNOTES")."
							(title,detail)
							VALUES(?,?)
	        ");
            $stmt = Database::connect()->prepare($sql);
			$params = array($titleAdd,$detailAdd);
			$stmt->execute($params);
			$postSuccess='<strong>SUCCESS:</strong> News has been posted!';
		}
	}
	if(isset($_POST['deleteBtn'])){
		$deletes=$_POST['deleteCheck'];
		foreach($deletes as $delete){
            $sql = ("
							DELETE FROM ".Database::getTable("PATCHNOTES")."
							WHERE RowID=?
	        ");
            $stmt = Database::connect()->prepare($sql);
			$params = array($delete);
			$stmt->execute($params);
		}
			$deleteSuccess = '<strong>SUCCESS:</strong> News Has Been Removed!';
	}
								# Start Template
								Template::doACP_Head("","",false,"12","Patchnotes Content Control");
			                         echo '<div id="tabs">';
				                        echo '<ul>';
					                       echo '<li><a href="#tabs-1">Post Content</a></li>';
					                       echo '<li><a href="#tabs-2">Delete Content</a></li>';
				                        echo '</ul>';
				                            echo '<div id="tabs-1">';
                                                if(count($errors)!= 0){
                                                echo '<div id="error" class="red-base">';
                                                    echo '<h1>Error!</h1>';
                                                    echo '<div id="error-msg">';
                                                        foreach($errors as $error){echo $error;}
                                                    echo '</div>';
                                                echo '</div>';
											echo '</div>';
										echo '</div>';
                                                }else{echo '<div id="error-msg">'.$postSuccess.'</div>';}
                                                echo '<form method="POST">';
                                                    echo '<div class="form-group">';
                                                    echo '<div id="label1"><input type="text" name="titleAdd" class="form-control tac b_i" placeholder="Post Title" maxlength="50" /></div>';
                                                    echo '<br />';
                                                    echo '<div id="label2"><textarea class="tinymce" name="detailAdd"></textarea></div>';
                                                    echo '</div>';
                                                    echo '<div style="text-align: right;">';
                                                        echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-top:5px;">Post Content</button>';
                                                    echo '</div>';
                                                echo '</form>';
                                            echo '</div>';
                                            echo '<div id="tabs-2">';
                                                echo '<div id="error">'.$deleteSuccess.'</div><br />';
                                                echo '<form class="form-inline" method="POST">';
                                                    echo '<table cellpadding="0" cellspacing="0" width="100%" class="table table-dark">';
                                                        echo '<tr>';
                                                            echo '<th><input type="checkbox" disabled="disabled" /></th>';
                                                            echo '<th>Post ID</th>';
                                                            echo '<th>Post Title</th>';
                                                            echo '<th>Post Details</th>';
                                                            echo '<th>Post Date</th>';
                                                        echo '</tr>';
                                                        $sql = ("
                                                                        SELECT * FROM ".Database::getTable("PATCHNOTES")." ORDER BY RowID ASC
	                                                    ");
                                                        $stmt = Database::connect()->prepare($sql);
                                                        $stmt->execute();
                                                        while($PatchStats=$stmt->fetch(PDO::FETCH_NUM)){
                                                        echo '<tr>';
                                                            echo '<th><input type="checkbox" name="deleteCheck[]" value="'.$PatchStats[0].'"/></th>';
                                                            echo '<td>'.Settings::$purifier->purify(htmlentities($PatchStats[0])).'</td>';
                                                            echo '<td>'.Settings::$purifier->purify(htmlentities($PatchStats[1])).'</td>';
                                                            echo '<td>'.Settings::$purifier->purify(htmlspecialchars_decode(htmlentities($PatchStats[3]))).'</td>';
                                                            echo '<td>'.Settings::$purifier->purify(htmlentities(date("m/d/y h:i A", strtotime($PatchStats[4])))).'</td>';
                                                        echo '</tr>';
                                                    }
                                                    echo '</table>';
                                                    echo '<br />';
                                                    echo '<div style="text-align: right;">';
                                                        echo '<input type="submit" class="btn btn-sm btn-primary m_auto" value="Delete Content" name="deleteBtn" />';
                                                    echo '</div>';
                                                echo '</form>';
                                            echo '</div>';
                                        echo '</div>'; # end of tabs
										# End Template
										Template::doACP_Foot();
?>