<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthADM();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Homepage Editor");
	
	$postSuccess='';
	$deleteSuccess='';

	$errors=array();
	if(isset($_POST['submit'])){
		$titleAdd = isset($_POST["titleAdd"]) ? $this->Data->escData(trim($_POST["titleAdd"])) : '';
		$detailAdd = isset($_POST["detailAdd"]) ? $this->Data->escData(trim($_POST["detailAdd"])) : '';
		if(empty($titleAdd) || empty($detailAdd)){
			$errors[]='Please verify all fields';}
		if(empty($errors)){
            $this->sql = ("
                            INSERT INTO ".$this->db->get_TABLE("HOMEPAGE")." (title,detail) VALUES(?,?)
	        ");
            $this->stmt = $this->db->conn->prepare($this->sql);
			$this->params = array($titleAdd,$detailAdd);
			$this->stmt->execute($this->params);
			$postSuccess='<strong>SUCCESS:</strong> News has been posted!';
		}
	}
	if(isset($_POST['deleteBtn'])){
		$deletes=$_POST['deleteCheck'];
		foreach($deletes as $delete){
            $this->sql = ("
                            DELETE FROM ".$this->db->get_TABLE("HOMEPAGE")." WHERE RowID=?
	        ");
            $this->stmt = $this->db->conn->prepare($this->sql);
			$this->params = array($delete);
			$this->stmt->execute($this->params);
		}
			$deleteSuccess = '<strong>SUCCESS:</strong> News Has Been Removed!';
	}
								# Start Template
								$this->Tpl->_do_ACP_pageHeader("","",false,"12","Homepage Content Control");
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
                                                        echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-top:5px;">Post New Content</button>';
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
                                                        $this->sql = ("
                                                                        SELECT * FROM ".$this->db->get_TABLE("HOMEPAGE")." ORDER BY RowID ASC
	                                                    ");
                                                        $this->stmt = $this->db->conn->prepare($this->sql);
                                                        $this->stmt->execute();
                                                    while($show=$this->stmt->fetch(PDO::FETCH_NUM)){
                                                        echo '<tr>';
                                                            echo '<th><input type="checkbox" name="deleteCheck[]" value="'.$show[0].'"/></th>';
                                                            echo '<td>'.$this->Data->escData(htmlentities($show[0])).'</td>';
                                                            echo '<td>'.$this->Data->escData(htmlentities($show[1])).'</td>';
                                                            echo '<td>'.$this->Data->escData(htmlspecialchars_decode(htmlentities($show[2]))).'</td>';
                                                            echo '<td>'.$this->Data->escData(htmlentities(date("m/d/y h:i A", strtotime($show[3])))).'</td>';
                                                        echo '</tr>';
                                                    }
                                                    echo '</table>';
                                                    echo '<br />';
                                                    echo '<div style="text-align: right;">';
                                                        echo '<input type="submit" class="btn btn-sm btn-primary m_auto" value="Delete Selected News" name="deleteBtn" />';
                                                    echo '</div>';
                                                echo '</form>';
                                            echo '</div>';
                                        echo '</div>'; # end of tabs
										# End Template
										$this->Tpl->_do_ACP_pageFooter();
?>