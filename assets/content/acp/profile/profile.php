<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	

	$sql = ("
				SELECT * FROM ".$this->db->get_TABLE("SH_USERDATA")." where UserUID=?
	");
	$stmt=$this->db->conn->prepare($sql);
	$args = array($_SESSION["uuid"]);
	$stmt->execute($args);

	$sqlprofile = ("
						SELECT * FROM ".$this->db->get_TABLE('WEB_PRESENCE')." where UserUID=?
	");
	$stmtprofile=$this->db->conn->prepare($sqlprofile);
	$argsprofile = array($_SESSION["uuid"]);
	$stmtprofile->execute($argsprofile);

	$sqllastseen = ("
						SELECT * FROM ".$this->db->get_TABLE("SH_USERLOGIN")." where UserUID=?
	");
	$stmtlastseen=$this->db->conn->prepare($sqllastseen);
	$argslastseen = array($_SESSION["uuid"]);
	$stmtlastseen->execute($argslastseen);

	$sqllastseen1 = ("
						SELECT * FROM ".$this->db->get_TABLE("SH_USERLOGIN")." where UserUID=?
	");
	$stmtlastseen1=$this->db->conn->prepare($sqllastseen1);
	$argslastseen1 = array($_SESSION["uuid"]);
	$stmtlastseen1->execute($argslastseen1);

	$sqlcharget = ("
						SELECT COUNT(*) AS counter FROM ".$this->db->get_TABLE("SH_CHARDATA")." Where UserUID=? And Del=?
	");
	$stmtcharget=$this->db->conn->prepare($sqlcharget);
	$argscharget = array($_SESSION["uuid"],0);
	$stmtcharget->execute($argscharget);

	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"12","User Profile");
    
	echo '<div class="col-md-14">';
	while($profile=$stmtprofile->fetch()){
		echo '<div class="jumbotron jumbotron-fluid blur-header" style="background-image: url(\'assets/Themes/Standard/images/profile/headers/'.$profile['Header'].'\');background-size: cover;background-position: 0% 25%;">';

	echo '<div class="container">';
	echo '<div class="d-flex justify-content-center h-100">';
				echo '<div class="image_outer_container">';
					echo '<div class="green_icon"></div>';
					echo '<div class="image_inner_container">';
						echo '<img class="img-fluid" src="assets/Themes/Standard/images/profile/avatars/'.$profile['Avatar'].'">';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		while($data=$stmt->fetch()){
		echo '<h1 class="display-4 no-blur">'.$data['UserID'].'</h1>';
			echo '<div class="col-md-12">';
				echo '<span class="display-6">'.$data['Point'].' DP</span>';
			echo '</div>';
		while($row=$stmtcharget->fetch()){
		echo '<span class="textLeft m_l_20 display-5">'.$row['counter'].' Characters</span>';
		}
		echo '<span class="textRight m_r_20 display-5">'.$this->Data->status_2_text($_SESSION['Status'],$_SESSION['Status']).'</span>';
		
#		echo '<span class="display-6 bottom1" style="vertical-align: bottom;">Last Seen</span>';


		echo '<div style="clear: both;"></div>';

			echo '<nav class="centered-pills">';
				echo '<ul class="nav nav-pills">';
					echo '<li><a class="btn btn-primary pills active" data-toggle="pill" href="#home">About</a></li>';
					echo '<li><a class="btn btn-danger pills" data-toggle="pill" href="#menu1">Characters</a></li>';
				echo '</ul>';
			echo '</nav>';
		echo '</div>';
	echo '</div>';
		echo '<div class="tab-content">';
			echo '<div class="tab-pane container active" id="home"><h5>About Information</h5>';
			 echo '<span class="display-5">Total Play Time: ';
			 while($lastseen=$stmtlastseen->fetch()){
				$x=$lastseen['LastPlayTime'];
				echo intval($x/60)." Hours</span>";
				echo '<div style="margin-top:15px"></div>';
				$newdate1 = date('F d, Y', strtotime($data['RegDate']));
				echo '<span class="display-5">Member Since: '.$newdate1;
			}
		}
		echo '</div>';
			echo '<div class="tab-pane container fade" id="menu1"><h5>Character Display</5>';
				echo '<div class="table-responsive no_padding">';
				echo '<table class="table table-sm table-dark">';
					echo '<thead>';
						echo '<tr>';
							echo '<th></th>';
							echo '<th>Character 1</th>';
							echo '<th>Character 2</th>';
							echo '<th>Character 3</th>';
							echo '<th>Character 4</th>';
							echo '<th>Character 5</th>';
						echo '</tr>';
					echo '</thead>';
							$sql = ('
										SELECT * FROM '.$this->db->get_TABLE("SH_CHARDATA").' c inner join '.$this->db->get_TABLE("SH_USERDATA").' as um on um.UserUID = c.UserUID WHERE c.UserUID=? and c.Del=?
									');
							$stmt=$this->db->conn->prepare($sql);
							$args = array($_SESSION["uuid"],0);
							$stmt->execute($args);

							try{
								echo '<tbody>';
								echo '<tr>';
								echo '<th>Character Name</th>';
								while($data=$stmt->fetch()){
									echo '<td>'.$data['CharName'].'</td>';
								}
								echo '</tr>';
								echo '</tbody>';
							}catch (PDOException $e) {
	
							}
							$sql = ('
										SELECT * FROM '.$this->db->get_TABLE("SH_CHARDATA").' c inner join '.$this->db->get_TABLE("SH_USERDATA").' as um on um.UserUID = c.UserUID WHERE c.UserUID=? and c.Del=?
							');
							$stmt=$this->db->conn->prepare($sql);
							$args = array($_SESSION["uuid"],0);
							$stmt->execute($args);

							try{
								echo '<tbody>';
								echo '<tr>';
								echo '<th>Level</th>';
								while($data=$stmt->fetch()){
									echo '<td>'.$data['Level'].'</td>';
								}
								echo '</tr>';
								echo '</tbody>';
							}catch (PDOException $e) {
	
							}
							$sql = ('
										SELECT * FROM '.$this->db->get_TABLE("SH_CHARDATA").' c inner join '.$this->db->get_TABLE("SH_USERDATA").' as um on um.UserUID = c.UserUID WHERE c.UserUID=? and c.Del=?
							');
							$stmt=$this->db->conn->prepare($sql);
							$args = array($_SESSION["uuid"],0);
							$stmt->execute($args);

							try{
								echo '<tbody>';
								echo '<tr>';
								echo '<th>Mode</th>';
								while($data=$stmt->fetch()){
									echo '<td>'.$this->User->get_Mode($data['Grow']).'</td>';
								}
								echo '</tr>';
								echo '</tbody>';
							}catch (PDOException $e) {
	
							}
							$sql = ('
										SELECT * FROM '.$this->db->get_TABLE("SH_CHARDATA").' c inner join '.$this->db->get_TABLE("SH_USERDATA").' as um on um.UserUID = c.UserUID WHERE c.UserUID=? and c.Del=?
							');
							$stmt=$this->db->conn->prepare($sql);
							$args = array($_SESSION["uuid"],0);
							$stmt->execute($args);

							try{
								echo '<tbody>';
								echo '<tr>';
								echo '<th>Class</th>';
								while($data=$stmt->fetch()){
									if($data['faction']==0){
										echo '<td>'.$this->User->get_Class_L($data['Job']).'</td>';
									}
									else{
										echo '<td>'.$this->User->get_Class_D($data['Job']).'</td>';
									}
								}
								echo '</tr>';
								echo '</tbody>';
							}catch (PDOException $e) {
	
							}

							$sql = ('
										SELECT * FROM '.$this->db->get_TABLE("SH_CHARDATA").' c inner join '.$this->db->get_TABLE("SH_USERDATA").' as um on um.UserUID = c.UserUID WHERE c.UserUID=? and c.Del=?
							');
							$stmt=$this->db->conn->prepare($sql);
							$args = array($_SESSION["uuid"],0);
							$stmt->execute($args);

							try{
								echo '<tbody>';
								echo '<tr>';
								echo '<th>Map</th>';
								while($data=$stmt->fetch()){
									echo '<td>'.$this->User->get_Map($data['Map']).'</td>';
								}
								echo '</tr>';
								echo '</tbody>';
							}catch (PDOException $e) {
	
							}
							$sql = ('
										SELECT * FROM '.$this->db->get_TABLE("SH_CHARDATA").' c inner join '.$this->db->get_TABLE("SH_USERDATA").' as um on um.UserUID = c.UserUID WHERE c.UserUID=? and c.Del=?
							');
							$stmt=$this->db->conn->prepare($sql);
							$args = array($_SESSION["uuid"],0);
							$stmt->execute($args);

							try{
								echo '<tbody>';
								echo '<tr>';
								echo '<th>Kills</th>';
								while($data=$stmt->fetch()){
									echo '<td>'.$data['K1'].'</td>';
								}
								echo '</tr>';
								echo '</tbody>';
							}catch (PDOException $e) {
	
							}

							$sql = ('
										SELECT * FROM '.$this->db->get_TABLE("SH_CHARDATA").' c inner join '.$this->db->get_TABLE("SH_USERDATA").' as um on um.UserUID = c.UserUID WHERE c.UserUID=? and c.Del=?
							');
							$stmt=$this->db->conn->prepare($sql);
							$args = array($_SESSION["uuid"],0);
							$stmt->execute($args);

							try{
								echo '<tbody>';
								echo '<tr>';
								echo '<th>Deaths</th>';
								while($data=$stmt->fetch()){
									echo '<td>'.$data['K2'].'</td>';
								}
								echo '</tr>';
								echo '</tbody>';
							}catch (PDOException $e) {

							}

							$sql = ('
										SELECT * FROM '.$this->db->get_TABLE("SH_CHARDATA").' c inner join '.$this->db->get_TABLE("SH_USERDATA").' as um on um.UserUID = c.UserUID WHERE c.UserUID=? and c.Del=?
							');
							$stmt=$this->db->conn->prepare($sql);
							$args = array($_SESSION["uuid"],0);
							$stmt->execute($args);

							try{
								echo '<tbody>';
								echo '<tr>';
								echo '<th>Login Status</th>';
								while($data=$stmt->fetch()){
									echo '<td>'.$this->User->get_LoginStatus($data['LoginStatus']).'</td>';
								}
								echo '</tr>';
								echo '</tbody>';
							}catch (PDOException $e) {

							}
				echo '</table>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
?>