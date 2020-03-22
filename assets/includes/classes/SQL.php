<?php
	class SQL{

		public $output;
		public static function ActionLogs(){
			$display	=	false;

			$sql = ('
							SELECT TOP 8 *
							FROM '.Database::getTable("LOG_ACCESS").'
							ORDER BY ActionTime DESC
			');
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			while($data=$stmt->fetch()){
				$display='<a href="javascript:;"><td>'.$data["UserID"].' '.$data["Action"].'</td><td><span class="badge badge-pill badge-secondary">'.Data::getDateDiff($data['ActionTime']).'</span></td>';
				if($display){
				echo '<tr>';
					echo $display;
				echo '</tr>';
				}
				else{
					echo $err_msg;
				}
			}
		}
		public static function GMLogs(){
			$display	=	false;

			$sql = ('
							SELECT TOP 7 *
							FROM '.Database::getTable("LOG_GM_COMMANDS").'
							ORDER BY ActionTime DESC
			');
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			while($data=$stmt->fetch()){
				$display='<a href="javascript:;"><td>'.$data["CharName"].'</td> <td>'.$data["Command"].'</td> <td>'.$data["CommandResult"].'</td> <td>'.$data["PlayerAffected"].'</td><td><span class="badge badge-pill badge-secondary">'.date('F d, Y', strtotime($data['ActionTime'])).'</span></td>';
				if($display){
				echo ' <tr>';
					echo $display;
				echo '</tr>';
				}
				else{
					echo $err_msg;
				}
			}
		}
		public static function NewUsers(){
			$display	=	false;

			$sql = ('
							SELECT TOP 200 [UM].[UserUID],[UM].[UserID],[UM].[Email],[C].[CharName],[C].[Faction],[UM].[Point],[UM].[JoinDate],[ULS].[LogOutTime],[UM].[Status],[C].[CharID],[C].[Level],[ULS].[LogoutTime]
							FROM '.Database::getTable("SH_CHARDATA").' AS [C]
							INNER JOIN '.Database::getTable("SH_USERDATA").' AS [UM] ON [C].[UserUID] = [UM].[UserUID]
							INNER JOIN '.Database::getTable("SH_USERLOGIN").' AS [ULS] ON [C].[UserUID] = [ULS].[UserUID]
							ORDER BY [UM].[JoinDate] DESC
			');
			$stmt = Database::connect()->prepare($sql);
			$stmt->execute();

			while($data=$stmt->fetch()){
				$newdate = date('F d, Y', strtotime($data['JoinDate']));
				$newondate = date('F d, Y', strtotime($data['LogOutTime']));
				$display='<td>'.User::get_Faction($data['Faction']).'</td><td>'.$data['UserID'].'</td><td>'.$newdate.'</td><td>'.$newondate.'</td><td>'.User::get_Status($data['Status']).'</td><td>'.$data['Point'].'</td>';

				if($display){
					echo '<tr>';
						echo $display;
					echo '</tr>';
				}
				else{
					echo $err_msg;
				}
			}
		}
		# REGISTRATION FUNCTIONS
		public static function REGISTER_USER_GAME($UserID,$Password,$UserIP){
			$ret	=	false;

			$sql	=	('
							INSERT INTO '.Database::getTable('SH_USERDATA').'
								(UserID,Pw,JoinDate,Admin,AdminLevel,UseQueue,Status,Leave,LeaveDate,UserType,Point,UserIp)
							VALUES
								(?,?,GETDATE(),0,0,0,0,0,GETDATE(),\'N\',0,?)
			');
			$stmt = Database::connect()->prepare($sql);
			$params = array($UserID,$Password,$UserIP);
			$stmt->execute($params);

			if($stmt){
				echo 'Your account, <font class="b_i">'.$_POST["UserID"].',</font> has been successfully created!<br>';
			}else{
				echo 'Game account creation has failed. Please contact an admin for assistance.<br>';
			}

			return $ret;
		}
		public static function REGISTER_USER_WEB($UserID,$Password,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP,$ImageName){
			$ret	=	false;

			$sql	=	('
							INSERT INTO '.Database::getTable('WEB_PRESENCE').'
								(UserID,Pw,DisplayName,DOB,Gender,Referer,SecQuestion,SecAnswer,ActivationKey,Email,UserIP,Avatar)
							VALUES
								(?,?,?,?,?,?,?,?,?,?,?,?)
			');
			$stmt = Database::connect()->prepare($sql);
			$params = array($UserID,$Password,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP,$ImageName);
			$stmt->execute($params);

			if($stmt){
				echo 'Your web account, <font class="b_i">'.$_POST["DisplayName"].' for '.$_POST["UserID"].',</font> has been successfully created!<br>';
			}else{
				echo 'Web account creation has failed. Please contact an administrator for assistance.<br>';
			}

			return $ret;
		}
		# HOMEPAGE FUNCTIONS
		public static function LOAD_HP(){
			$sql = ('
						SELECT TOP 25 *
						FROM '.Database::getTable("HOMEPAGE").'
						ORDER BY RowID ASC
			');
			$query=Database::connect()->prepare($sql);
			$query->execute();

			try {
				while($row=$query->fetch()){
					echo Template::PAGE_CARD($row['Title'],'',html_entity_decode($row['Detail']),'');
				}
			} catch (PDOException $e) {
				echo Template::PAGE_CARD('Site Information','tac','There is currently nothing to see here. Please check back later and see what has been added.','');
			}
		}
		# NEWS FUNCTIONS
		public static function LOAD_NEWS(){
			$sql = ('
						SELECT *
						FROM '.Database::getTable("NEWS").'
						ORDER BY date DESC
			');
			$query=Database::connect()->prepare($sql);
			$query->execute();
			$row = $query->FETCH();

			try {
				echo Template::PAGE_CARD_NEWS($row['Title'],html_entity_decode($row['Detail']),($row['Bywho']),date("m/d/y h:i A", strtotime($row['Date'])));
			} catch (PDOException $e) {
				echo Template::PAGE_CARD('Site Information','tac','There is currently nothing to see here. Please check back later and see what has been added.','');
			}
		}
		# PATCH FUNCTIONS
		public static function LOAD_PATCH(){
			$sql = ('
						SELECT *
						FROM '.Database::getTable("PATCHNOTES").'
						ORDER BY date DESC
			');
			$query=Database::connect()->prepare($sql);
			$query->execute();
			$row = $query->FETCH();

			try {
				echo Template::PAGE_CARD_NEWS($row['Title'],html_entity_decode($row['Detail']),'',date("m/d/y h:i A", strtotime($row['Date'])));
			} catch (PDOException $e) {
				echo Template::PAGE_CARD('Site Information','tac','There is currently nothing to see here. Please check back later and see what has been added.','');
			}
		}
		public static function serverStatus(){
			$hostIp = '127.0.0.1';
			$portNumbers = array(30800, 30810, 80);
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
		public static function playersOnline($variant='',$usecolors='',$customTh='',$customTd=''){
			$return='';
			if($customTh!==''&&$customTd==''){
				$customTd='defaultTd';
			}
			if($variant==''){
			$sql="SELECT COUNT(*) AS 'Currently Online',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_USERDATA")." WHERE [Status]=0)AS 'Active Accounts',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE Del=0 AND CharName NOT LIKE '%]%')AS 'Living Characters',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_USERDATA")." WHERE [Status]='-5')AS 'Banned Accounts',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)) AS 'Alliance of Light',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)) AS 'Union of Fury',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=0) AS Fighter,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=1) AS Defender,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=2) AS Ranger,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=3) AS Archer,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=4) AS Mage,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=5) AS Priest,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=0) AS Warrior,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=1) AS Guardian,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=2) AS Assassin,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=3) AS Hunter,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=4) AS Pagan,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=5) AS Oracle
				FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1";
			}else if($variant=='1'){
			$sql="SELECT COUNT(*) AS 'Alliance of Light',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=0) AS Fighter,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=1) AS Defender,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=2) AS Ranger,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=3) AS Archer,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=4) AS Mage,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=5) AS Priest
				FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)";
			}else if($variant=='2'){
			$sql="SELECT COUNT(*) AS 'Union of Fury',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=0) AS Warrior,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=1) AS Guardian,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=2) AS Assassin,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=3) AS Hunter,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=4) AS Pagan,
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=5) AS Oracle
				FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)";
			}else if($variant=='3'){
			$sql="SELECT COUNT(*) AS 'Currently Online',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_USERDATA")." WHERE [Status]=0)AS 'Active Accounts',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE Del=0)AS 'Living Characters',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_USERDATA")." WHERE [Status]='-5')AS 'Banned Accounts',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Faction = '0') AS 'Alliance of Light',
				(SELECT COUNT(*) FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1 AND Faction = '1') AS 'Union of Fury'
				FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1";
			}else if($variant=='4'){
			$sql="SELECT COUNT(*) AS 'Currently Online'
				FROM ".Database::getTable("SH_CHARDATA")." WHERE LoginStatus=1";
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
		public static function _get_serverStatus($IP,$LoginPort,$GamePort){
			$ServerIP	=	$IP;
			$ServerPorts = array($LoginPort, $GamePort);+
			$LoginConn = @fsockopen($ServerIP, $ServerPorts[0], $errno, $errstr, 0.01);
			$GameConn = @fsockopen($ServerIP, $ServerPorts[1], $errno, $errstr, 0.01);
			if ($LoginConn){
				echo '<span class="label">Login Server:<b><font color="green">Online</font></b></span>';
			}
			else{
				echo '<span class="label">Login Server:<b><font color="red">Offline</font></b></span>';
			}
			if ($GameConn){
				echo '<span class="label">Game Server:<b><font color="green">Online</font></b></span>';
			}
			else{
				echo '<span class="label">Game Server:<b><font color="red">Offline</font></b></span>';
			}
		}
	}
?>