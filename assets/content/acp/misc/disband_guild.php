<?php
    # Authorization
	$this->User->Auth();
	$this->User->AuthGM();

	$GuildID = isset($_POST["GuildID"]) ? $this->Data->escData(trim($_POST["GuildID"])) : false;
	$CharName = isset($_POST["CharName"]) ? $this->Data->escData(trim($_POST["CharName"])) : false;

	if (isset($_POST['SCN'])) 
    {
    # Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"6");
	
	$sql6 = ("
				SELECT * FROM ".$this->db->get_TABLE("SH_GUILDS")." WHERE GuildID=?
	");
	$stmt6=$this->db->conn->prepare($sql6);
	$args6 = array($GuildID);
	$stmt6->execute($args6);
	
	$Result = $stmt6->FETCH();

	$Fields = array(
		'GuildID',
		'GuildName',
		'MasterUserID',
		'MasterCharID',
		'MasterName',
		'Country',
		'TotalCount',
		'GuildPoint',
		'Del',
		'CreateDate',
		'DeleteDate'
	);

	$NoEdit = array(
		'GuildID',
		'GuildName',
		'MasterUserID',
		'MasterCharID',
		'MasterName',
		'Country',
		'TotalCount',
		'GuildPoint',
		'Del',
		'CreateDate',
		'DeleteDate'
	);

	echo '<form method="POST">';
    echo '<div class="form-group mx-sm-3 mb-2">';
    echo '<div class="table-responsive">';
	echo '<table class="table table-dark">';
    echo '<thead>';

	foreach ($Fields as $Columns) 
	{
		echo '<tr><th>' . $Columns . '</th>';
		if (in_array($Columns, $NoEdit)) 
		{
			echo '<th><input type="text" value="' . $Result[$Columns] . '" name="' . $Columns . '" class="form-control" readonly></th>';
		}
		else
		{
			if ($Set) 
			{
				if ($Columns == 'Enchant') 
				{
					echo '<td><select style="width:100%;" name="' . $Columns . '">';
					echo '<option value="00">00</option>';
					if (in_array($Result['Type'], $Armor)) 
					{
						for ($e = 50; $e <= 70; $e++) 
						{
							if ($e == $Result[$Columns]) 
							{
								echo '<option value="' . $e . '" selected>' . $e . '</option>';
							}
							echo '<option value="' . $e . '">' . $e . '</option>';
						}
					} 
					else 
					{
						for ($a = 1; $a <= 20; $a++) 
						{
							$a = str_pad($a, 2, 0, STR_PAD_LEFT);
							if ($a == $Result[$Columns]) 
							{
								echo '<option value="' . $a . '" selected>' . $a . '</option>';
							}
							echo '<option value="' . $a . '">' . $a . '</option>';
						}
					}
					echo '</select></td>';
				} 
				else
				{
					echo '<td><select style="width:100%;" name="' . $Columns . '">';
					for ($i = 0; $i <= $Result['ReqWis']; $i++) 
					{
						$i = str_pad($i, 2, 0, STR_PAD_LEFT);
						if ($i == $Result[$Columns]) 
						{
							echo '<option value="' . $i . '" selected>' . $i . '</option>';
						}
						else
						{
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
					}
					echo '</select></td>';
				}
			} 
			else 
			{
				echo '<th><input type="text" name="' . $Columns . '" value="' . $Result[$Columns] . '" /></th>';
			}
		}
		echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
	}
     echo '</tbody>';
	echo '</table>';
    echo '<button type="submit" class="btn btn-sm btn-primary tac" name="CNE" style="margin-top:10px;">Submit</button>';
	echo '</form>';
        echo '</div>';
        
    # End Template
	$this->Tpl->_do_ACP_pageFooter();
}

elseif (isset($_POST['CNE'])) 
{
    
    # Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"6");
	
	$sql6 = ("
			SELECT * FROM ".$this->db->get_TABLE("SH_GUILDS")." WHERE GuildID=?
	");
	$stmt6=$this->db->conn->prepare($sql6);
	$args6 = array($GuildID);
	$stmt6->execute($args6);
    
    while($Row=$stmt6->fetch()){
        $this->LogSys->createLog("Deleted Guild: ".$Row['GuildName']."");
    }
	
	$sql = ("
				DELETE FROM ".$this->db->get_TABLE("SH_GUILDS")." WHERE GuildID=?
	");
	$stmt=$this->db->conn->prepare($sql);
	$args = array($GuildID);
	$stmt->execute($args);
	
	$sql1 = ("
				DELETE FROM ".$this->db->get_TABLE("SH_GUILD_CHARS")." WHERE GuildID=?
	");
	$stmt1=$this->db->conn->prepare($sql1);
	$args1 = array($GuildID);
	$stmt1->execute($args1);

	foreach ($_POST as $Name => $Value){
		echo $Name . '=>' . $Value . '<br>';
	}
    
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
} 

elseif (isset($_POST['SC'])){
	if (empty($CharName)){
		die('You didn\'t specify a Character Name!');
	}
    
    # Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"6");
	
	$sql4 = ("
				SELECT GuildName,GuildID FROM ".$this->db->get_TABLE("SH_GUILDS")." WHERE GuildName=?
	");
	$stmt4=$this->db->conn->prepare($sql4);
	$args4 = array($CharName);
	$stmt4->execute($args4);
	$result4 = $stmt4->fetchAll();
	$rowCount4 = count($result4);

	if($rowCount4==0){
		echo 'Guild search for: "'.$CharName.'" returned no results.';
	}
	
	echo '<form method="POST">';
    echo '<div class="form-group mx-sm-3 mb-2">';
	echo '<table class="table table-dark"><tr>
		<th>GuildName</th>
		<th>Select</th></tr>';
	foreach($result4 as $Row){
		echo '<tr><td>' . $Row['GuildName'] . '</td><td><input type="radio" name="GuildID" value="' . $Row['GuildID'] . '"></td></tr>';
	}
	echo '</table>';
    echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SCI" style="margin-top:10px;">Submit</button>';
	echo '</form>';
        echo '</div>';
    
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
} 

elseif (isset($_POST['SCI'])){
	if (!isset($GuildID)){
		die('You didn\'t select a Guild!');
	}
    
        # Start Template
	$this->Tpl->_do_ACP_pageHeader("","",false,"12");
	
	$sql5 = ("
				SELECT * FROM ".$this->db->get_TABLE("SH_GUILDS")." WHERE GuildID = ?
	");
	$stmt5=$this->db->conn->prepare($sql5);
	$args5 = array($GuildID);
	$stmt5->execute($args5);
	$result5 = $stmt5->fetchAll();
	$rowCount5 = count($result5);

	if($rowCount5==0){
		echo 'Search returned no results.';
	}
	echo '<form method="POST">';
    echo '<div class="form-group mx-sm-3 mb-2">';
	echo '<table class="table table-dark"><tr>
		<th>GuildID</th>
		<th>GuildName</th>
		<th>MasterUserID</th>
		<th>MasterName</th>
		<th>Country</th>
        <th>Select</th></tr>';
	foreach($result5 as $Row){
		echo '<tr><td>' . $Row['GuildID'] . '</td>
		<td>' . $Row['GuildName'] . '</td>
		<td>' . $Row['MasterUserID'] . '</td>
		<td>' . $Row['MasterName'] . '</td>
		<td>' . $Row['Country'] . '</td>
		<td><input type="radio" name="GuildID" value="' . $Row['GuildID'] . '"></td>
		</tr>';
	}
	echo '</table>';
    echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SCN" style="margin-top:10px;">Submit</button>';
	echo '</form>';
    echo '</div>';
	
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
}
else {
	# Start Template
	$this->Tpl->_do_ACP_pageHeader("","",true,"6","Disband Guild");
	echo '<form method="POST">';
		echo '<div class="form-group mx-sm-3 mb-2">';
			echo '<input type="text" class="form-control tac b_i" placeholder="Guild Name" name="CharName">';
		echo '</div>';
			echo '<button type="submit" class="btn btn-sm btn-primary tac" name="SC" style="margin-left:5px;">Submit</button>';
	echo '</form>';
	# End Template
	$this->Tpl->_do_ACP_pageFooter();
}
?>