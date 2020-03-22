<?php

// Recoded by [Dev]Velocity - Credit to Trayne01 for some code that i used

$Item		=	isset($_POST["item"])			?	$this->Data->escData(trim($_POST["item"]))		:	false;
$ItemName	=	$this->Data->escData($Item);
$MobID		=	isset($_POST["MobID"])			?	$this->Data->escData(trim($_POST["MobID"]))		:	false;
$ItemID		=	isset($_POST["ItemID"])			?	$this->Data->escData(trim($_POST["ItemID"]))	:	false;

# Start Template
$this->Tpl->_start_mainSection();
$this->Tpl->Separator(20);
$this->Tpl->_do_pageHead("Drop Finder","Find Drops here!");

if (isset($_POST['SCN'])) 
{
	
	if (!isset($_POST['MobID'])) {
		die('You didn\'t select an item!');
	}

	$this->sql = ("
					SELECT DISTINCT m.ItemName,m.Grade,m.ItemID,mi.MobID,mi.ItemOrder 
					FROM ".$this->db->get_TABLE("SH_ITEMS")."
					m INNER JOIN ".$this->db->get_TABLE("SH_MOBITEMS")." 
					mi on mi.Grade = m.Grade Where mi.MobID = ? AND m.ItemName NOT LIKE '%'+'???'+'%'
	");
	$this->query=$this->db->conn->prepare($this->sql);
	$this->query->bindValue(1, $MobID, PDO::PARAM_INT);
	$this->query->execute();
	
	echo '<form method="POST">';
		echo '<div class="table-responsive">';
			echo '<table class="table table-sm">';
			echo '<thead>';
				echo "<tr bgcolor='194360'>";
				echo '<th>Item Name</th>';
				echo '</tr>';
				echo '</thead>';
					echo '<tbody>';
					while($this->fet=$this->query->fetch(PDO::FETCH_NUM)){
						echo '<tr>';
							echo '<td>'.$this->fet['ItemName'].'</td>';
						echo '</tr>';
					}
					echo '</tbody>';
			echo '</table>';
		echo '</div>';
			echo '<button type="submit" class="btn btn-sm btn-primary tac" name="CNE" style="margin-left:10px;">Submit</button>';
	echo '</form>';
}

elseif (isset($_POST['SC'])) 
{
	$this->sql = ("
					SELECT DISTINCT ItemName,ItemID 
					FROM ".$this->db->get_TABLE("SH_ITEMS")."
					WHERE ItemName LIKE '%".$ItemName."%' ORDER BY ItemID
	");
	$this->query=$this->db->conn->prepare($this->sql);
	$this->query->bindValue(1, $Item, PDO::PARAM_INT);
	$this->query->execute();
	$this->result = $this->query->fetchAll();
	$this->rowCount = count($this->result);

	if($this->rowCount>0){
		echo '<form method="POST">';
		echo '<div class="table-responsive">';
			echo '<table class="table table-sm table-dark">';
				echo '<thead>';
					echo "<tr>";
						echo '<th align="middle">Item Name</th>';
						echo '<th align="middle">Select</th>';
					echo '</tr>';
				echo '</thead>';
					echo '<tbody>';
					foreach($this->result as $this->fet){
						echo '<tr>';
							echo '<td>'.$this->fet[0].'</td>';
							echo '<td><input align="middle" type="radio" name="ItemID" value="'. $this->fet['ItemID'].'"></td>';
						echo '</tr>';
					}
					echo '</tbody>';
			echo '</table>';
		echo '</div>';
			echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SCI" style="margin-left:10px;">Submit</button>';
		echo '</form>';
	}else{
		echo '<h1 class="display-7">No Item\'s Found!!</h1>';
	}
}

elseif (isset($_POST['SCI'])) 
{
	if (!isset($_POST['ItemID'])) {
		die('You didn\'t select an item!');
	}

	$this->sql = ("
					SELECT DISTINCT m.MobName,m.MobID,mi.Grade,mi.DropRate,drp.MapID,m.Attrib,m.Level,mi.ItemOrder
					FROM ".$this->db->get_TABLE("SH_MOBS")."
					m INNER JOIN ".$this->db->get_TABLE("SH_MOBITEMS")." mi on mi.MobID = m.MobID
					INNER JOIN ".$this->db->get_TABLE("SH_ITEMS")." i on mi.Grade = i.Grade
					INNER JOIN ".$this->db->get_TABLE("SH_DROP_FINDER")." drp on m.MobID = drp.MobID
					WHERE i.ItemID = ? AND m.MobName not like '%Error Monster%' order by m.MobID
	");
	$this->query=$this->db->conn->prepare($this->sql);
	$this->query->bindValue(1, $ItemID, PDO::PARAM_INT);
	$this->query->execute();
	$this->result = $this->query->fetchAll();
	$this->rowCount = count($this->result);

	if($this->rowCount>0){
		echo '<form method="POST">';
		echo '<div class="table-responsive">';
			echo '<table class="table table-sm table-dark">';
				echo '<thead>';
					echo "<tr>";
						echo '<th>MobName</th>';
						echo '<th>Mob Ele</th>';
						echo '<th>Mob Level</th>';
						echo '<th>Map Name</th>';
						echo '<th>Drop Rate</th>';
					echo '</tr>';
				echo '</thead>';
					echo '<tbody>';
					foreach($this->result as $this->fet){
						echo '<tr>';
							echo '<td>' .$this->fet['MobName'].'</td>';
							echo '<td><img src="assets/Themes/Standard/images/dropfinder/ele_'.$this->fet['Attrib'].'.png"</td>';
							echo '<td>' .$this->fet['Level'].'</td>';
							echo '<td>' .$this->User->get_Map($this->fet['MapID']).'</td>';
							echo "<td>";
							$DropRate=$this->fet['DropRate'];
								if ($this->fet['ItemOrder']>5)
								{
									$DropRate=($DropRate/100);
								}
								if ($DropRate>100)
								{
									$DropRate=100;
								}
									echo (($DropRate)." %");
							echo "</td>";
						echo '</tr>';
					}
				echo '</tbody>';
		echo '</table>';
	echo '</div>';
echo '</form>';
	}else{
		echo '<h1 class="display-7">No Drops Found!!</h1>';
	}
}
else{
		echo '<form method="POST">';
			echo '<div class="form-group row">';
				echo '<div class="col-md-4 hidden-sm-down"></div>';
				echo '<div class="input-group col-md-4 col-sm-12">';
					echo '<input type="text" placeholder="Item Name" class="form-control tac b_i" name="item" />';
						echo '<div class="input-group-append">';
							echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SC" style="margin-left:10px;">Submit</button>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</form>';
		$this->Tpl->Separator(10);
}
# End Template
$this->Tpl->_do_pageFooter();
$this->Tpl->Separator(20);
$this->Tpl->_end_mainSection();
?>