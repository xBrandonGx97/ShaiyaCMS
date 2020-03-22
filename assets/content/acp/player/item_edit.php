<?php
    # Authorization
	$this->User->Auth();
	$this->User->AuthGM();

$CharID = isset($_POST["CharID"]) ? $this->Data->escData(trim($_POST["CharID"])) : false;
$CharName = isset($_POST["CharName"]) ? $this->Data->escData(trim($_POST["CharName"])) : false;
$ItemID = isset($_POST["ItemID"]) ? $this->Data->escData(trim($_POST["ItemID"])) : false;
$ItemUID = isset($_POST["ItemUID"]) ? $this->Data->escData(trim($_POST["ItemUID"])) : false;
$Type = isset($_POST["Type"]) ? $this->Data->escData(trim($_POST["Type"])) : false;
$TypeID = isset($_POST["TypeID"]) ? $this->Data->escData(trim($_POST["TypeID"])) : false;
$Gem1 = isset($_POST["Gem1"]) ? $this->Data->escData(trim($_POST["Gem1"])) : false;
$Gem2 = isset($_POST["Gem2"]) ? $this->Data->escData(trim($_POST["Gem2"])) : false;
$Gem3 = isset($_POST["Gem3"]) ? $this->Data->escData(trim($_POST["Gem3"])) : false;
$Gem4 = isset($_POST["Gem4"]) ? $this->Data->escData(trim($_POST["Gem4"])) : false;
$Gem5 = isset($_POST["Gem5"]) ? $this->Data->escData(trim($_POST["Gem5"])) : false;
$Gem6 = isset($_POST["Gem6"]) ? $this->Data->escData(trim($_POST["Gem6"])) : false;
$Count = isset($_POST["Count"]) ? $this->Data->escData(trim($_POST["Count"])) : false;
$Str = isset($_POST["Str"]) ? $this->Data->escData(trim($_POST["Str"])) : false;
$Dex = isset($_POST["Dex"]) ? $this->Data->escData(trim($_POST["Dex"])) : false;
$Rec = isset($_POST["Rec"]) ? $this->Data->escData(trim($_POST["Rec"])) : false;
$Int = isset($_POST["Int"]) ? $this->Data->escData(trim($_POST["Int"])) : false;
$Wis = isset($_POST["Wis"]) ? $this->Data->escData(trim($_POST["Wis"])) : false;
$Luc = isset($_POST["Luc"]) ? $this->Data->escData(trim($_POST["Luc"])) : false;
$HP = isset($_POST["HP"]) ? $this->Data->escData(trim($_POST["HP"])) : false;
$MP = isset($_POST["MP"]) ? $this->Data->escData(trim($_POST["MP"])) : false;
$SP = isset($_POST["SP"]) ? $this->Data->escData(trim($_POST["SP"])) : false;
$Enchant = isset($_POST["Enchant"]) ? $this->Data->escData(trim($_POST["Enchant"])) : false;

	if(isset($_POST['SCN'])){
		$Set = false; //Change to True to have it based off ReqWis, false for custom input.
		$Armor = array(16,17,18,19,20,21,31,32,33,34,35,36,67,68,69,70,71,82,83,84,85);

		$sql = ("
					SELECT c.Count,c.ItemID,c.Type,c.TypeID,c.Gem1,c.Gem2,c.Gem3,c.Gem4,c.Gem5,Gem6,
					SUBSTRING(c.Craftname, 1, 2) AS 'Str',
					SUBSTRING(c.Craftname, 3, 2) AS 'Dex',
					SUBSTRING(c.Craftname, 5, 2) AS 'Rec',
					SUBSTRING(c.Craftname, 7, 2) AS 'Int',
					SUBSTRING(c.Craftname, 9, 2) AS 'Wis',
					SUBSTRING(c.Craftname, 11, 2) AS 'Luc',
					SUBSTRING(c.Craftname, 13, 2) AS 'HP',
					SUBSTRING(c.Craftname, 15, 2) AS 'MP',
					SUBSTRING(c.Craftname, 17, 2) AS 'SP',
					SUBSTRING(c.Craftname, 19, 2) AS 'Enchant',
					c.ItemUID,I.ItemName,I.ReqWis,I.Type
					FROM ".$this->db->get_TABLE("SH_CHARITEMS")." c
					INNER JOIN ".$this->db->get_TABLE("SH_ITEMS")." I ON I.ItemID=c.ItemID
					WHERE c.ItemUID=?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($ItemUID);
		$stmt->execute($args);

		$Fields = array(
            'ItemName','ItemUID','ItemID','Type','TypeID',
            'Gem1','Gem2','Gem3','Gem4','Gem5','Gem6',
            'Str','Dex','Rec','Int','Wis','Luc','HP','MP',
            'SP','Enchant','Count'
        );
		$NoEdit = array(
            'ItemName','ItemUID'
        );

		try{
			$this->Tpl->_do_ACP_pageHeader("","",false,"12","Edit Player Items");
			echo '<form method="POST">';
				echo 'IF Weapon Enchant = 1-50<p>If Gear Enchant = 51-99<p> Gem = slots Use TypeID of the lapis to link<p> IE: Max craft = 30007 so Gem would be 7!!';
				echo '<div class="table-responsive">';
					echo '<table class="table table-dark">';
						while($data=$stmt->fetch()){
							foreach($Fields as $Columns){
								echo '<tr>';
									echo '<th>'.$Columns.'</th>';
									if(in_array($Columns,$NoEdit)){
										echo '<th><input type="text" class="form-control" value="'.$data[$Columns].'" name="'.$Columns.'" style="background:#c0c0c0;" READONLY></th>';
									}
									else{
									if($Set){
										if($Columns == 'Enchant'){
											echo '<td>';
												echo '<select class="form-control" style="width:100%;" name="'.$Columns.'">';
													echo '<option value="00">00</option>';
												if(in_array($data['Type'],$Armor)){
													for($e=50;$e <= 70; $e++){
														if($e == $data[$Columns]){
															echo '<option value="'.$e.'" selected>'.$e.'</option>';
														}
														echo '<option value="'.$e.'">'.$e.'</option>';
													}
												}
												else{
													for($a=1;$a <= 20; $a++){
														$a=str_pad($a,2,0,STR_PAD_LEFT);
														if($a==$data[$Columns]){
															echo '<option value="'.$a.'" selected>'.$a.'</option>';
														}
														echo '<option value="'.$a.'">'.$a.'</option>';
													}
												}
												echo '</select>';
											echo '</td>';
										}
										else{
											echo'<td><select class="form-control" style="width:100%;" name="'.$Columns.'">';
											for($i=0;$i<=$data['ReqWis'];$i++){
												$i=str_pad($i,2,0,STR_PAD_LEFT);
												if($i==$data[$Columns]){echo '<option value="'.$i.'" selected>'.$i.'</option>';}
												else{echo '<option value="'.$i.'">'.$i.'</option>';}
											}
											echo '</select></td>';
										}
									}
									else{
										echo '<th><input type="text" class="form-control" name="'.$Columns.'" value="'.$data[$Columns].'" /></th>';
									}
								}
							echo '</tr>';
						}
						
						}
					echo '</table>';
					echo "<input type='hidden' name='CharID' value='".$CharID."'>";
					echo '<input type="Submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" value="Submit" name="CNE">';
				echo '</div>';
			echo '</form>';
			$this->Tpl->_do_ACP_pageFooter();
		}catch (PDOException $e) {

		}
	}
	elseif(isset($_POST['CNE'])){
		$this->Tpl->_do_ACP_pageHeader("","",false,"12","Edit Player Items");
		$Craftname = $Str . $Dex . $Rec . $Int . $Wis . $Luc;
	    $Craftname .= $HP . $MP . $SP . $Enchant;

		$sql = ("
					UPDATE ".$this->db->get_TABLE("SH_CHARITEMS")."
					SET ItemID=?,Type=?,TypeID=?,Gem1=?,Gem2=?,Gem3=?,Gem4=?,Gem5=?,Gem6=?,Count=?,Craftname=?
					WHERE ItemUID=?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($ItemID,$Type,$TypeID,$Gem1,$Gem2,$Gem3,$Gem4,$Gem5,$Gem6,$Count,$Craftname,$ItemUID);
		$stmt->execute($args);

		try{
			foreach($_POST as $Name => $Value){
				echo $Name.'=>'.$Value.'<br>';
			}
			echo "$Craftname = " . $Craftname;

			echo '<form action="" method="POST">';
				echo '<input type="hidden" name="CharID" value="'.$CharID.'" />';
				echo '<input type="submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" name="SCI" value="Same Char">';
			echo '</form>';
		}catch (PDOException $e) {

		}
		$this->Tpl->_do_ACP_pageFooter();
	}

	elseif(isset($_POST['SC'])){
		if(empty($_POST['CharName'])){
			die('You didn\'t specify a Character Name!');
		}

		$sql = ("
					SELECT CharName,CharID
					FROM ".$this->db->get_TABLE("SH_CHARDATA")."
					WHERE CharName=? AND Del=?
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($_POST['CharName'],0);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);

		try{
			if($rowCount>0){
				$this->Tpl->_do_ACP_pageHeader("","",true,"6","Edit Player Items");
					echo '<form method="POST">';
						echo '<div class="table-responsive">';
							echo '<table class="table table-dark">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>CharName</th>';
										echo '<th>Select</th>';
									echo '</tr>';
								echo '</thead>';
								echo '<tbody>';
									foreach($result as $Row){
										echo '<tr>';
											echo '<td>'.$Row['CharName'].'</td>
											<td><input type="radio" name="CharID" value="'.$Row['CharID'].'"></td>';
										echo '</tr>';
									}
								echo '</tbody>';
							echo '</table>';
						echo '</div>';
						echo '<input type="Submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" value="Submit" name="SCI">';
					echo '</form>';
				}
				else{
					echo 'Character search for: "'.$_POST['CharName'].'" returned no results.';
				}
		}catch (PDOException $e) {

		}
		$this->Tpl->_do_ACP_pageFooter();
	}
	elseif(isset($_POST['SCI'])){
		if(!isset($_POST['CharID'])){
			die('You didn\'t select a Character!');
		}

		$Bag = array(0=>'Equipped',1=>'Bag 1',2=>'Bag 2',3=>'Bag 3',4=>'Bag 4',5=>'Bag 5');

		$sql = ("
					SELECT I.ItemName,CI.Bag,CI.Slot,CI.Count,CI.ItemUID
					FROM ".$this->db->get_TABLE("SH_CHARITEMS")." AS CI
					INNER JOIN ".$this->db->get_TABLE("SH_ITEMS")." AS I ON I.ItemID=CI.ItemID
					WHERE CI.CharID=?
					ORDER BY CI.Bag
		");
		$stmt=$this->db->conn->prepare($sql);
		$args = array($_POST['CharID']);
		$stmt->execute($args);
		$result = $stmt->fetchAll();
		$rowCount = count($result);

		try{
			if($rowCount>0){
				$this->Tpl->_do_ACP_pageHeader("","",false,"12","Edit Player Items");
					echo '<form method="POST">';
						echo '<div class="table-responsive">';
							echo '<table class="table table-dark">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>ItemName</th>';
										echo '<th>Bag</th>';
										echo '<th>Slot</th>';
										echo '<th>Count</th>';
										echo '<th>Select</th>';
									echo '</tr>';
								echo '</thead>';
								echo '<tbody>';
								foreach($result as $Row){
									echo '<tr>';
										echo '<td>'.$Row['ItemName'].'</td>';
										echo '<td>'.$Bag[$Row['Bag']].'</td>';
										echo '<td>'.$Row['Slot'].'</td>';
										echo '<td>'.$Row['Count'].'</td>';
										echo '<td><input type="radio" name="ItemUID" value="'.$Row['ItemUID'].'"></td>';
									echo '</tr>';
								}
								echo '</tbody>';
							echo '</table>';
							echo '<input type="hidden" name="CharID" value="'.$_POST['CharID'].'">';
							echo '<input type="Submit" class="btn btn-sm btn-primary m_auto" style="margin-top:15px" value="Submit" name="SCN">';
						echo '</div>';
					echo '</form>';
				}
				else{
					echo 'Search returned no results.';
				}
		}catch (PDOException $e) {

		}
		$this->Tpl->_do_ACP_pageFooter();
	}
	else{
	$this->Tpl->_do_ACP_pageHeader("","",true,"6","Edit Player Items");
		echo '<b>Edit Player Items<br>';
            echo '<form method="POST">';
                echo '<div class="form-group mx-sm-3 mb-2">';
				    echo '<input type="text" name="CharName" placeholder="Character Name" class="form-control tac b_i"/></td>';
                echo '</div>';
                    echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SC" style="margin-left:5px;">Submit</button>';
                echo '</div>';
			echo '</form>';
	}
	$this->Tpl->_do_ACP_pageFooter();
