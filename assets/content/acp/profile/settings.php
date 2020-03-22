<?php
	# Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	
	$userFile=false;
	$userFile1=false;
	$success=false;

	$ImageName = @$_FILES['userFile']['name'];
	$fileElementName = 'userFile';
	$path = 'assets/Themes/Standard/images/profile/headers/'; 
	$location = $path . @$_FILES['userFile']['name']; 
	move_uploaded_file(@$_FILES['userFile']['tmp_name'], $location); 

	$ImageName1 = @$_FILES['userFile1']['name'];
	$fileElementName1 = 'userFile1';
	$path1 = 'assets/Themes/Standard/images/profile/avatars/'; 
	$location1 = $path1 . @$_FILES['userFile1']['name']; 
	move_uploaded_file(@$_FILES['userFile1']['tmp_name'], $location1);

	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(!isset($_FILES['userFile1']) || $_FILES['userFile1']['error'] == UPLOAD_ERR_NO_FILE) {
			# echo "No avatar selected"; 
		} else {
			$sql = ("
						UPDATE ".$this->db->get_TABLE('WEB_PRESENCE')." SET Avatar='{$ImageName1}' Where UserUID=?
			");
			$query=$this->db->conn->prepare($sql);
			$args = array($_SESSION["uuid"]);
			$query->execute($args);
#			$success = "Updated Avatar!";
		}
		if(!isset($_FILES['userFile']) || $_FILES['userFile']['error'] == UPLOAD_ERR_NO_FILE) {
			# echo 'No header selected';
		} else {
			$sql = ("
						UPDATE ".$this->db->get_TABLE('WEB_PRESENCE')." SET Header='{$ImageName}' Where UserUID=?
			");
			$query=$this->db->conn->prepare($sql);
			$args = array($_SESSION["uuid"]);
			$query->execute($args);
#			$success = "Updated Header!";
		}
			$success	=	"Settings Updated Successfully";
/*	echo '
		<script type="text/javascript">
			  window.location.replace("?pageid=USER_STNGS");
		</script>
';*/
	}
	# Start Template
		$this->Tpl->_do_ACP_pageHeader("","",true,"6","Welcome to your settings");
			if(isset($success) && !empty($success)){
				echo '<div id="success tac">';
					echo $success;
				echo '</div>';
			}
			echo '<form class="form-inline text-center" method="POST" enctype="multipart/form-data">';
			echo '<div class="form-group">';
				echo '<label for="username" class="form-control m_t_5" style="margin-left:5px;margin-bottom:5px">Header</label>';
#				echo '<input type="file" class="form-control" id="username" name="userFile">';
				echo '<div class="btn btn-sm btn-primary" style="margin-left:5px" onclick="getFile()">Browse Header</div>';
				echo '<div style="height: 0px;width:0px; overflow:hidden;"><input id="upfile" name="userFile" type="file" value="upload"/></div>';
#					echo '<button name="upload_header" type="submit" class="btn btn-sm btn-primary">Update Header</button>';
			echo '</div>';
			echo '<div class="form-group">';
					echo '<label for="name" class="form-control" style="margin-left:5px;margin-bottom:5px">Avatar</label>';
#					echo '<input type="file" class="form-control" name="userFile1">';
					echo '<div class="btn btn-sm btn-primary" style="margin-left:5px" onclick="getFile1()">Browse Avatar</div>';
					echo '<div style="height: 0px;width:0px; overflow:hidden;"><input id="upfile1" name="userFile1" type="file" value="upload"/></div>';
#					echo '<button name="upload_avatar" type="submit" class="btn btn-sm btn-primary">Update Avatar</button>';
			echo '</div>';
			echo '<div class="col-md-12 text-center">';
				echo '<button name="submit" type="submit" class="btn btn-sm btn-primary">Update Settings</button>';
			echo '</div>';
		# End Template
		$this->Tpl->_do_ACP_pageFooter();
?>
<script>
function getFile(){
     document.getElementById("upfile").click();
}
function getFile1(){
     document.getElementById("upfile1").click();
}
function myFunction() {
    location.reload();
}
</script>