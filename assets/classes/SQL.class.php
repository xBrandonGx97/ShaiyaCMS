<?php
	class SQL{

		# ARRAYS
		private $BG_COLOR_ARRAY;private $BIT_ARRAY;private $ENABLED_ARRAY;private $TXT_ARRAY;private $SB_ARRAY;private $PANE_ARRAY;
		public $output;

		function __construct($Data,$db,$Setting,$Template,$User){
			$this->db			=	$db;
			$this->Data			=	$Data;
			$this->Setting		=	$Setting;
			$this->Tpl			=	$Template;
			$this->User			=	$User;

			# LOAD ARRAYS
			$this->BG_COLOR_ARRAY();
			$this->BIT_ARRAY();
			$this->ENABLED_ARRAY();
			$this->SB_ARRAY();
			$this->TXT_ARRAY();
			$this->PANE_ARRAY();
		}
		# ARRAYS
		function BG_COLOR_ARRAY(){
			$this->BG_COLOR_ARRAY	=	array(
												'NAV_BG_COLOR',
												'CARD_BG_COLOR',
												'TITLE_BG_COLOR',
												'BREAD_BG_COLOR'
			);
		}
		function BIT_ARRAY(){
			$this->BIT_ARRAY	=	array(
											'SETUP',
											'NAV_SERVER_STATUS',
											'USE_PLUGINS'
			);
		}
		function ENABLED_ARRAY(){
			$this->ENABLED_ARRAY	=	array(
											'DEBUG',
											'HTTPS_SSL',
											'LOGGING',
											'MAINTENANCE',
											'NAV_SERVER_STATUS',
											'SHOW_SIDE_NAV',
											'USE_PLUGINS'
			);
		}
		function PANE_ARRAY(){
			$this->PANE_ARRAY	=	array(
											'PANE_BG_COLOR',
											'PANE_BG_TRANS'
			);
		}
		function SB_ARRAY(){
			$this->SB_ARRAY		=	array(
											'SIDEBAR_POS'
			);
		}
		function TXT_ARRAY(){
			$this->TXT_ARRAY	=	array(
											'CMS_BG',
											'ACP_BG',
											'LOGO_IMG',
											'FAVICON_IMAGE'
			);
		}
		function ActionLogs(){
			$display	=	false;

			$this->sql = ('
							SELECT TOP 8 *
							FROM '.$this->db->get_TABLE("LOG_ACCESS").'
							ORDER BY ActionTime DESC
			');
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			while($data=$this->stmt->fetch()){
				$display='<a href="javascript:;"><td>'.$data["UserID"].' '.$data["Action"].'</td><td><span class="badge badge-pill badge-secondary">'.$this->Data->getDateDiff($data['ActionTime']).'</span></td>';
				if($display){
				echo '<tr>';
					echo $display;
				echo '</tr>';
				}
				else{
					echo $this->err_msg;
				}
			}
		}
		function GMLogs(){
			$display	=	false;

			$this->sql = ('
							SELECT TOP 7 *
							FROM '.$this->db->get_TABLE("LOG_GM_COMMANDS").'
							ORDER BY ActionTime DESC
			');
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			while($data=$this->stmt->fetch()){
				$display='<a href="javascript:;"><td>'.$data["CharName"].'</td> <td>'.$data["Command"].'</td> <td>'.$data["CommandResult"].'</td> <td>'.$data["PlayerAffected"].'</td><td><span class="badge badge-pill badge-secondary">'.date('F d, Y', strtotime($data['ActionTime'])).'</span></td>';
				if($display){
				echo ' <tr>';
					echo $display;
				echo '</tr>';	
				}
				else{
					echo $this->err_msg;
				}
			}
		}
		function NewUsers(){
			$display	=	false;

			$this->sql = ('
							SELECT TOP 200 [UM].[UserUID],[UM].[UserID],[UM].[Email],[C].[CharName],[C].[Faction],[UM].[Point],[UM].[JoinDate],[ULS].[LogOutTime],[UM].[Status],[C].[CharID],[C].[Level],[ULS].[LogoutTime]
							FROM '.$this->db->get_TABLE("SH_CHARDATA").' AS [C]
							INNER JOIN '.$this->db->get_TABLE("SH_USERDATA").' AS [UM] ON [C].[UserUID] = [UM].[UserUID]
							INNER JOIN '.$this->db->get_TABLE("SH_USERLOGIN").' AS [ULS] ON [C].[UserUID] = [ULS].[UserUID]
							ORDER BY [UM].[JoinDate] DESC
			');
			$this->stmt = $this->db->conn->prepare($this->sql);
			$this->stmt->execute();

			while($data=$this->stmt->fetch()){
				$newdate = date('F d, Y', strtotime($data['JoinDate']));
				$newondate = date('F d, Y', strtotime($data['LogOutTime']));
				$display='<td>'.$this->User->get_Faction($data['Faction']).'</td><td>'.$data['UserID'].'</td><td>'.$newdate.'</td><td>'.$newondate.'</td><td>'.$this->User->get_Status($data['Status']).'</td><td>'.$data['Point'].'</td>';
				
				if($display){
					echo '<tr>';
						echo $display;
					echo '</tr>';
				}
				else{
					echo $this->err_msg;
				}
			}
		}
		function TransactionLogs(){
			$sql	=	('
							SELECT TOP 8 *
							FROM '.$this->db->get_TABLE("LOG_PAYMENTS").'
							ORDER BY PaymentDate DESC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					echo '<tr>';
						echo '<td>000'.$data["RowID"].'</td>';
						echo '<td>'.date("m/d/y",strtotime($data["PaymentDate"])).'</td>';
						echo '<td>'.date("h:i:s A",strtotime($data["PaymentDate"])).'</td>';
						echo '<td>$'.$data["Paid"].'</td>';
						echo '<td>'.$data["TransID"].'</td>';
						echo '<td>'.$data["PaymentStatus"].'</td>';
					echo '<tr>';
				}
			}
		}
		# THEME FUNCTIONS
		function Options($DB,$TITLEBAR,$SECTION,$SHOWHEAD=false){
			if($DB == "SETTINGS_MAIN"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->get_TABLE($DB).'
								WHERE [TYPE]=? AND [SHOW]=?
								ORDER BY [DESC] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($SECTION,1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					$this->Tpl->TitleBar($TITLEBAR);
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
						if($SHOWHEAD == true){
							echo '<thead>';
								echo '<tr>';
									echo '<th>Description</th>';
									echo '<th>Value</th>';
									echo '<th>Lock</th>';
									echo '<th>Modify</th>';
								echo '</tr>';
							echo '</thead>';
						}
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								echo '<tr>';
									echo '<td style="width:30%">'.$data["DESC"].'</td>';
								if(in_array($data["SETTING"],$this->BG_COLOR_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif(in_array($data["SETTING"],$this->BIT_ARRAY)){
									echo '<td style="width:50%">'.$this->Data->bit_2_text2($data["VALUE"]).'</td>';
								}
								elseif(in_array($data["SETTING"],$this->ENABLED_ARRAY)){
									echo '<td style="width:50%">'.$this->Data->ENABLE($data["VALUE"]).'</td>';
								}
								elseif(in_array($data["SETTING"],$this->SB_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif(in_array($data["SETTING"],$this->TXT_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif($data["SETTING"] == "CMS_THEME_NAME"){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								else{
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}

								if($data["EDIT"] == 0){
									echo '<td class="tac badge-warning"><button class="badge badge-warning open_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
									echo '<td class="tac badge-danger"><i class="fa fa-lock"></i> Locked</td>';
								}
								elseif($data["EDIT"] == 1){
									echo '<td class="tac badge-success"><button class="badge badge-warning open_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
									echo '<td class="tac badge-success"><button class="badge badge-warning open_editor_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#settings_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
								}
								else{
									echo '<td class="tac badge-secondary"><i class="fa fa-times"></i> Disabled</td>';
									echo '<td class="tac badge-secondary"><i class="fa fa-times"></i> Disabled</td>';
								}
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
			}
			elseif($DB == "SETTINGS_THEME"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->get_TABLE($DB).'
								WHERE [SECTION]=? AND [SHOW]=?
								ORDER BY [DESC] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($SECTION,1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					$this->Tpl->TitleBar($TITLEBAR);
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
						if($SHOWHEAD){
							echo '<thead>';
								echo '<tr>';
									echo '<th style="width:20%">Description</th>';
									echo '<th style="width:70%">Value</th>';
									echo '<th style="width:10%">Edit</th>';
								echo '</tr>';
							echo '</thead>';
						}
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								echo '<tr>';
									echo '<td style="width:20%">'.$data["DESC"].'</td>';
								if(in_array($data["SETTING"],$this->BIT_ARRAY)){
									echo '<td style="width:70%">'.$this->Data->bit_2_text2($data["VALUE"]).'</td>';
									echo '<td style="width:10%" class="tac"><button class="btn btn-sm btn-primary open_bit_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#bit_modal" data-toggle="modal"><i class="fa fa-eye"></i> Edit</button></td>';
								}
								elseif(in_array($data["SETTING"],$this->TXT_ARRAY)){
									echo '<td style="width:70%">'.$data["VALUE"].'</td>';
									echo '<td style="width:10%" class="tac"><button class="btn btn-sm btn-primary open_text_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#text_modal" data-toggle="modal"><i class="fa fa-eye"></i> Edit</button></td>';
								}
								elseif(in_array($data["SETTING"],$this->BG_COLOR_ARRAY)){
									echo '<td style="width:70%">'.$data["VALUE"].'</td>';
									echo '<td style="width:10%" class="tac"><button class="btn btn-sm btn-primary open_bgcolor_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#bgcolor_modal" data-toggle="modal"><i class="fa fa-eye"></i> Edit</button></td>';
								}
								elseif(in_array($data["SETTING"],$this->PANE_ARRAY)){
									echo '<td style="width:70%">'.$data["VALUE"].'</td>';
									echo '<td style="width:10%" class="tac"><button class="btn btn-sm btn-primary open_pane_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'~'.$data["SETTING"].'" data-target="#pane_modal" data-toggle="modal"><i class="fa fa-eye"></i> Edit</button></td>';
								}
								elseif(in_array($data["SETTING"],$this->SB_ARRAY)){
									echo '<td style="width:70%">'.$data["VALUE"].'</td>';
									echo '<td style="width:10%" class="tac"><button class="btn btn-sm btn-primary open_sb_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#sb_modal" data-toggle="modal"><i class="fa fa-eye"></i> Edit</button></td>';
								}
								elseif($data["SETTING"] == "CMS_THEME_NAME"){
									echo '<td style="width:70%">'.$data["VALUE"].'</td>';
									echo '<td style="width:10%" class="tac"><button class="btn btn-sm btn-primary open_theme_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#theme_modal" data-toggle="modal"><i class="fa fa-eye"></i> Edit</button></td>';
								}
								else{
									echo '<td style="width:70%">'.$data["VALUE"].'</td>';
									echo '<td class="badge-danger tac" style="width:10%"><i class="fa fa-times"></i> Disabled</td>';
								}
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
			}

			odbc_free_result($stmt);
			odbc_close($this->db->conn);
		}
		# SETTINGS FUNCTIONS
		function SettingsCards($v1,$v2){
			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE("SETTINGS_PAGES").'
							WHERE PAGE_CAT=? AND PAGE_SHOW=?
							ORDER BY PAGE_DESC ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($v1,$v2);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					echo '<div class="col-md-4 m_b_30">';
						echo '<div class="card card-inverse" style="background-color:#333;border-color:#333;">';
							echo '<div class="card-header badge-secondary tac">'.$data["METATAG_DESC"].'</div>';
							echo '<div class="card-body tac">';
								echo '<p class="card-text">'.$data["PAGE_DESC"].'</p>';
								echo '<a class="badge badge-pill badge-warning f_16" href="?'.$this->Setting->PAGE_PREFIX.'='.$data["PAGE_INDEX"].'">Modify</a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
			odbc_free_result($stmt);
			odbc_close($this->db->conn);
		}
		# REGISTRATION FUNCTIONS
		function REGISTER_USER_GAME($UserID,$Pw,$Email,$UserIP){
			$ret	=	false;

			$sql	=	('
							INSERT INTO '.$this->db->get_TABLE('SH_USERDATA').'
								(UserID,Pw,Email,UserIP)
							VALUES
								(?,?,?,?)
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($UserID,$Pw,$Email,$UserIP);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$_SESSION["MESSAGES"]["type"][].='3';
				$_SESSION["MESSAGES"]["head"][].='3';
				$_SESSION["MESSAGES"]["body"][].='R-0x18';

				$ret	=	true;
			}else{
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x17';
			}

			return $ret;
		}
		function REGISTER_USER_WEB($UserID,$Pw,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP){
			$ret	=	false;

			$sql	=	('
							INSERT INTO '.$this->db->get_TABLE('WEB_PRESENCE').'
								(UserID,Pw,DisplayName,DOB,Gender,Referer,SecQuestion,SecAnswer,ActivationKey,Email,UserIP)
							VALUES
								(?,?,?,?,?,?,?,?,?,?,?)
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($UserID,$Pw,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$_SESSION["MESSAGES"]["type"][].='3';
				$_SESSION["MESSAGES"]["head"][].='3';
				$_SESSION["MESSAGES"]["body"][].='R-0x20';

				$ret	=	true;
			}
			else{
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x19';
			}

			return $ret;
		}
		# HOMEPAGE FUNCTIONS
		function LOAD_HP(){
			$sql = ('
						SELECT TOP 25 *
						FROM '.$this->db->get_TABLE("HOMEPAGE").'
						ORDER BY RowID ASC
			');
			$query=$this->db->conn->prepare($sql);
			$query->execute(); 
			$row = $query->FETCH();

			try {
				echo $this->Tpl->PAGE_CARD($row['Title'],'',html_entity_decode($row['Detail']),'');
			} catch (PDOException $e) {
				echo $this->Tpl->PAGE_CARD('Site Information','tac','There is currently nothing to see here. Please check back later and see what has been added.','');
			}
		}
		# NEWS FUNCTIONS
		function LOAD_NEWS(){
			$sql = ('
						SELECT *
						FROM '.$this->db->get_TABLE("NEWS").'
						ORDER BY date DESC
			');
			$query=$this->db->conn->prepare($sql);
			$query->execute(); 
			$row = $query->FETCH();

			try {
				echo $this->Tpl->PAGE_CARD_NEWS($row['Title'],html_entity_decode($row['Detail']),($row['Bywho']),date("m/d/y h:i A", strtotime($row['Date'])));
			} catch (PDOException $e) {
				echo $this->Tpl->PAGE_CARD('Site Information','tac','There is currently nothing to see here. Please check back later and see what has been added.','');
			}
		}
		# PATCH FUNCTIONS
		function LOAD_PATCH(){
			$sql = ('
						SELECT *
						FROM '.$this->db->get_TABLE("PATCHNOTES").'
						ORDER BY date DESC
			');
			$query=$this->db->conn->prepare($sql);
			$query->execute(); 
			$row = $query->FETCH();

			try {
				echo $this->Tpl->PAGE_CARD_NEWS($row['Title'],html_entity_decode($row['Detail']),'',date("m/d/y h:i A", strtotime($row['Date'])));
			} catch (PDOException $e) {
				echo $this->Tpl->PAGE_CARD('Site Information','tac','There is currently nothing to see here. Please check back later and see what has been added.','');
			}
		}
		function serverStatus(){
		$hostIp = '127.0.0.1';
		$portNumbers = array(5678, 5647, 443);
		$portNames = array('Login Server&nbsp;&nbsp;&nbsp;','Game Server','Web Server');
		$portStatus='';
		$portStatus.='<table cellspacing="3">';
		for($i=0;$i<count($portNumbers);$i++){
		    $portConn = @fsockopen($hostIp, $portNumbers[$i], $errno, $errstr, 2);
			if(is_resource($portConn)){
				$portStatus.= '<tr><td class="portName">'.$portNames[$i].'</td><td class="onlineWrap"><span class="online">Online</span></td></tr><tr></tr>';
				fclose($portConn);
			}else{
				$portStatus.= '<tr><td class="portName">'.$portNames[$i].'</td><td class="offlineWrap"><span class="offline">Offline</span></td></tr><tr></tr>';
			}	
		}
		$portStatus.='</table>';
		return $portStatus;
		}
		function playersOnline($variant='',$usecolors='',$customTh='',$customTd=''){
		$return='';
		if($customTh!==''&&$customTd==''){
			$customTd='defaultTd';
		}
		if($variant==''){
		$sql="SELECT COUNT(*) AS 'Currently Online',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE [Status]=0)AS 'Active Accounts',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE Del=0 AND CharName NOT LIKE '%]%')AS 'Living Characters',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE [Status]='-5')AS 'Banned Accounts',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)) AS 'Alliance of Light',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)) AS 'Union of Fury',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=0) AS Fighter, 
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=1) AS Defender,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=2) AS Ranger,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=3) AS Archer,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=4) AS Mage,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=5) AS Priest,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=0) AS Warrior,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=1) AS Guardian,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=2) AS Assassin,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=3) AS Hunter,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=4) AS Pagan,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=5) AS Oracle 
			FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1";
		}else if($variant=='1'){
		$sql="SELECT COUNT(*) AS 'Alliance of Light',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=0) AS Fighter, 
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=1) AS Defender,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=2) AS Ranger,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=3) AS Archer,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=4) AS Mage,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=5) AS Priest
			FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)";
		}else if($variant=='2'){
		$sql="SELECT COUNT(*) AS 'Union of Fury',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=0) AS Warrior,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=1) AS Guardian,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=2) AS Assassin,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=3) AS Hunter,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=4) AS Pagan,
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=5) AS Oracle 
			FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)";
		}else if($variant=='3'){
		$sql="SELECT COUNT(*) AS 'Currently Online',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE [Status]=0)AS 'Active Accounts',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE Del=0)AS 'Living Characters',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE [Status]='-5')AS 'Banned Accounts',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Faction = '0') AS 'Alliance of Light',
			(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Faction = '1') AS 'Union of Fury'
			FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1";
		}else if($variant=='4'){
		$sql="SELECT COUNT(*) AS 'Currently Online'
			FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1";
		}
		$execSql=odbc_exec($this->db->conn,$sql);
		$results=odbc_fetch_array($execSql);
		for($i=0;$i<odbc_num_fields($execSql);$i++){
			$fieldName=odbc_field_name($execSql, ($i+1));
			$fieldValue=odbc_result($execSql,($i+1));
			if($usecolors!==''){
				if($fieldName=='Currently Online'){
					$fieldValue='<span style="color:rgba(0,253,0,1);">'.$fieldValue.'</span>';
					$fieldName='<th colspan="3" align="left" class="'.$customTh.'"><span style="font-size:22px;">'.$fieldName.'</span></th>';
				}else
				if($fieldName=='Banned Accounts'){
					$fieldName='<th colspan="2" align="left" class="'.$customTh.'">'.$fieldName.'</th>';
					$fieldValue='<span style="color:rgba(255,0,0,1);">'.$fieldValue.'</span>';
				}else
				if($fieldName=='Active Accounts'){
					$fieldName='<th colspan="2" align="left" class="'.$customTh.'">'.$fieldName.'</th>';
				}else
				if($fieldName=='Living Characters'){
					$fieldName='<th colspan="2" align="left" class="'.$customTh.'">'.$fieldName.'</th>';
				}else
				if($fieldName=='Alliance of Light'){
					if($variant>0){
						$fieldName='<th colspan="3" align="left" class="'.$customTh.'"><span style="font-size:18px;">'.$fieldName.'</span></th>';
						$fieldValue='<span style="color:rgba(0,253,0,1);">'.$fieldValue.'</span>';
					}else{
						$fieldName='<th colspan="2" align="left" class="'.$customTh.'">'.$fieldName.'</th>';
					}
				}else
				if($fieldName=='Union of Fury'){
					if($variant>0){
						$fieldName='<th colspan="3" align="left" class="'.$customTh.'"><span style="font-size:18px;">'.$fieldName.'</span></th>';
						$fieldValue='<span style="color:rgba(255,0,0,1);">'.$fieldValue.'</span>';				
					}else{
						$fieldName='<th colspan="2" align="left" class="'.$customTh.'">'.$fieldName.'</th>';
					}
				}else
				if($fieldName=='Total Accounts'){
					$fieldName='<th colspan="2" align="left" class="'.$customTh.'">'.$fieldName.'</th>';
				}else
				if($fieldName=='Total Characters'){
					$fieldName='<th colspan="2" align="left" class="'.$customTh.'">'.$fieldName.'</th>';
				}else{
					$fieldName='<th align="left" class="'.$customTh.'">'.$fieldName.'</th>';
				}
				$return.='<tr> '.$fieldName.' <td width="50" class="'.$customTd.'">'.$fieldValue.'</td></tr>';
			}else{
				$return.='<tr><th align="left" class="'.$customTh.'"> '.$fieldName.' </th><td width="50" class="'.$customTd.'">'.$fieldValue.'</td></tr>';
			}
		}
		return $return;
		odbc_free_result($execSql);
		odbc_close($this->db->conn);
	}
		# PAGING FUNCTIONS
		function _get_paging(){
			$data	=	array();

			$sql	=	("
							SELECT *
							FROM ".$this->db->get_TABLE("SETTINGS_PAGES")."
							ORDER BY ZONE DESC
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$data["head"][]	=	"Page Zone";
				$data["head"][]	=	"Page Index";
				$data["head"][]	=	"Page URI";
				$data["head"][]	=	"Show Page";
				$data["head"][]	=	"Edit";

				while($results = odbc_fetch_array($stmt)){
					if($results["SHOW"]){
						$data["body"][$results["RowID"]][]	=	$results["ZONE"];
						$data["body"][$results["RowID"]][]	=	$results["PAGE_INDEX"];
						$data["body"][$results["RowID"]][]	=	$results["PAGE_URI"];
						$data["body"][$results["RowID"]][]	=	$this->Data->bit_2_text($results["PAGE_SHOW"]);
						$data["body"][$results["RowID"]][]	=	'<button class="badge badge-primary open_editor_modal" data-id="'.$results["RowID"].'~'.$results["PAGE_INDEX"].'~'.$results["PAGE_URI"].'~'.$results["PAGE_SHOW"].'~'.$results["METATAG_TITLE"].'~'.$results["METATAG_DESC"].'~'.$results["METATAG_KEYWORDS"].'" data-target="#pages_modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</button>';
#						$data["body"][$results["RowID"]][]	=	$results["SHOW"];
					}
				}

#				$this->Tpl->OUTPUT_TABLE_HEAD($this->output["head"]);
#				if($prep){
#					while($RowID = odbc_fetch_array($stmt)){
#						echo $this->Tpl->OUTPUT_TABLE_BODY($this->output["body"][$RowID["RowID"]]);
#					}
#				}
			}
			else{
				$this->output	=	"An error has occured!";
			}
			$this->output	=	$data;
		}
	}
?>