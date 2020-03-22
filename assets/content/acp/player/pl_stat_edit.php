<?php
    # Authorization
	$this->User->Auth();
	$this->User->AuthGM();
	
	#	Create DATABASE LOG
	$this->LogSys->createLog("Viewed Player Edit");
	
	# Start
	$char = isset($_POST["char"]) ? $this->Data->escData(trim($_POST["char"])) : false;
	$count = 0;

    # Arrays
	$columns = array(
        'UserID','UserUID','CharID','CharName','Slot','Family','Grow','Hair',
        'Face','Size','Job','Sex','Level','StatPoint','SkillPoint',
        'Str','Dex','Rec','Int','Luc','Wis','Map','Dir','Exp','Money',
        'PosX','PosY','Posz','K1','K2','K3','K4','KillLevel','DeadLevel',
        'OldCharName'
    );
	$greyed  = array(
        'UserID','UserUID','CharID','Slot','KillLevel','DeadLevel',
    );

	if((isset($_POST['submit'])) || strlen($char)>1){
        if(strlen($char)<1){
            die("Invalid Char Name.");
        }
    
		$sql = ("
					SELECT * FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE CharName=?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($char);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);
			if($rowCount==0){
				echo 'User '.$char.' does not exist.';
			die();
			}else{
             # Load Template
			$this->Tpl->_do_ACP_pageHeader("","",false,"12","Current Status of ".$char."");
				echo '<form method="POST">';
				echo '<div class="table-responsive">';
					echo '<table class="table table-dark">';
                        echo '<thead>';
							echo "<tr>";
								echo "<td>NO.</td>";
								echo "<td>Name</td>";
								echo "<td>Value</td>";
								foreach($result as $Info){
							    foreach ($columns as $value){
								echo '<tr>';
									echo '<td>'.$count.'</td>';
									echo '<th>'.$value.':</th>';
								    if(in_array($value,$greyed)){
									    echo '<td><input type="text" readonly="readonly" style="color: #000;" class="form-control" name="'.$value.'" value="'.$Info[$value].'" /></td>';
								echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
								    }
								    else{
									    echo '<td><input type="text" style="background: #808080;color: #000;" class="form-control" name="'.$value.'" value="'.$Info[$value].'" /></td>';
							echo '</tr>';
								    }
							        $count++;
								}
								}
                        echo '</tbody>';
					echo '</table>';
                    	echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit2" style="margin-top:10px;margin-left:15px;">Submit</button>';
				echo '</form>';
			# End Template
			$this->Tpl->_do_ACP_pageFooter();
		}
	}
	elseif(isset($_POST['submit2'])){
         # Load Template
		$this->Tpl->_do_ACP_pageHeader("","",false,"12",false);
		$charid = isset($_POST["CharID"]) ? $this->Data->escData(trim($_POST["CharID"])) : false;
		$Report="";
        $columns=array(
            'CharName','Grow','Hair','Face','Size','Job',
            'Sex','Level','StatPoint','SkillPoint','Str',
            'Dex','Rec','Int','Luc','Wis','Map','Dir','Exp',
            'Money','PosX','PosY','Posz','K1','K2','K3',
            'K4','KillLevel','DeadLevel','OldCharName',
        );
		echo "Results updated successfully. <br>";
			foreach($columns as $value){
				$sql = ("
							UPDATE ".$this->db->get_TABLE("SH_CHARDATA")." SET ".$value."='".$_REQUEST[$value]."' WHERE CharID=?
				");
				$stmt=$this->db->conn->prepare($sql);
				$args = array($charid);
				$stmt->execute($args);
			}
			foreach($_POST as $Name=>$Value){
				if($Name !="submit2"){
					echo $Name.'='.$Value.'<br>';
					$Report.=$Name."=>".$Value.";";
				}
			}
        echo '<a href="?'.$this->Setting->PAGE_PREFIX.'=PLR_EDIT" class="btn btn-sm btn-primary tac" style="margin-top:15px">Go Back</a>';
             # End Template
			$this->Tpl->_do_ACP_pageFooter();
	           }else{
			# Load Template
			$this->Tpl->_do_ACP_pageHeader("","",true,"6","Edit Player");
			echo '<form method="POST">';
                echo '<div class="form-group mx-sm-3 mb-2">';
					echo '<input type="text" name="char" placeholder="Enter Character Name" class="form-control tac b_i"/></td>';
                echo '</div>';
                	echo '<button type="submit" class="btn btn-sm btn-primary tac" name="submit" style="margin-left:10px;">Submit</button>';
			echo '</form>';
				}
			# End Template
			$this->Tpl->_do_ACP_pageFooter();
?>