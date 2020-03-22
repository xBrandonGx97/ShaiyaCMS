<html>
	<head>
	<link rel="stylesheet" type="text/css" href="assets/Themes/Standard/css/pvp.css">
	</head>
</html>
<?php
	# initialize variables
	$page		=	1;
	$persite	=	15;
	$cssicon	=	0;
	$cssjob		=	0;
	$where		=	"";
	$addlink	=	"";
	$maxlevel	=	80;
	$scripturl	=	$_SERVER['PHP_SELF'];
	$pvp		=	"";

	# check level area
	if(isset($_GET['pvp']) && !empty($_GET['pvp']) && preg_match('#^[0-9]*$#',$_GET['pvp'])){
		$pvp	=	$_GET['pvp'];
		if($pvp==1){$where='AND [C].[Level] BETWEEN 1 AND 15';}
		elseif($pvp==2){$where='AND [C].[Level] BETWEEN 16 AND 30';}
		elseif($pvp==3){$where='AND [C].[Level] BETWEEN 31 AND 45';}
		elseif($pvp==4){$where='AND [C].[Level] > 46';}
	}
	# check current page
	if(isset($_GET['page']) && !empty($_GET['page']) && preg_match('#^[0-9]*$#',$_GET['page'])){
		$page		= $_GET['page'];
		$addlink	= '&amp;page='.$page;
	}
	# calculate begin and end
	$begin	=	($page - 1) * $persite;
	$max	=	$page * $persite;

	echo '<div class="container">';
	echo '<div class="row">';
	echo '<div class="col-md-3"></div>';
	echo '<div class="col-12 text-center">';
	echo '<div class="card card-cms">';
	echo '<div class="card-header tac title pTitle show">PvP Rankings</div>';
	echo '<div class="card-body">';
			echo '<a href="?'.$this->Setting->PAGE_PREFIX.'='.$this->PAGE_INDEX.'&pvp=1'.$addlink.'">1-15</a>';
			echo '<div style="padding-left: 30px; display: inline;"></div>';
			echo '<a href="?'.$this->Setting->PAGE_PREFIX.'='.$this->PAGE_INDEX.'&pvp=2'.$addlink.'">16-30</a>';
			echo '<div style="padding-left: 30px; display: inline;"></div>';
			echo '<a href="?'.$this->Setting->PAGE_PREFIX.'='.$this->PAGE_INDEX.'&pvp=3'.$addlink.'">31-45</a>';
			echo '<div style="padding-left: 30px; display: inline;"></div>';
			echo '<a href="?'.$this->Setting->PAGE_PREFIX.'='.$this->PAGE_INDEX.'&pvp=4'.$addlink.'">46-'.$maxlevel.'</a>';
			echo '<div style="padding-left: 30px; display: inline;"></div>';
			echo '<a href="?'.$this->Setting->PAGE_PREFIX.'='.$this->PAGE_INDEX.'&pvp=5'.$addlink.'">All</a>';
				echo '<div class="table-responsive">';
					echo '<table class="table table-dark m_t_5">';
						echo '<thead>';
							echo '<tr>';
								echo '<th class="tac">Rank</th>';
								echo '<th class="tac">Name</th>';
								echo '<th class="tac">Job</th>';
								echo '<th class="tac">Level</th>';
								echo '<th class="tac">Faction</th>';
								echo '<th class="tac">Guild</th>';
								echo '<th class="tac">Status</th>';
								echo '<th class="tac">Map</th>';
								echo '<th class="tac">Kills</th>';
								echo '<th class="tac">Death</th>';
								echo '<th class="tac">KDR</th>';
								echo '<th class="tac">Icon</th>';
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
						$sql	=	("
										SELECT top $max [C].*,[M].*
										FROM ".$this->db->get_TABLE("SH_CHARDATA")." AS [C]
										INNER JOIN ".$this->db->get_TABLE("SH_USERDATA")." AS [U] ON [U].[UserUID]=[C].[UserUID]
										INNER JOIN ".$this->db->get_TABLE("SH_MAPS")." AS [M] ON [M].[MapID]=[C].[Map]
										WHERE [C].[Del] = 0 $where
										ORDER BY [C].[K1] DESC,[C].[K2] ASC,[C].[CharName] ASC
						");
						$res	=	odbc_exec($this->db->conn,$sql);

						for($i=1;$char=odbc_fetch_array($res);$i++){
							if($i >= $begin){
								$cssjob = $char['Job'] + 17;

								# light or dark
								if($char['Family'] < 2 ){
									$faction = '<font color="#0094ff">Light</font>';
								}
								else{
									$faction = '<font color="#FF0000">Dark</font>';
								}

								# guild
/*
								$gsql	=	("
												SELECT [GuildID]
												FROM ".$this->db->get_TABLE("SH_GUILD_CHARS")."
												WHERE [CharID] = '".$char['CharID']."' AND [Del] = 0
								");
								$stmt	=	odbc_prepare($this->db->conn,$gsql);
								$args	=	array($char['CharID'],0)
								$prep	=	odbc_execute($stmt,$args);
								if($prep){}
								$gres	=	odbc_exec($this->db->conn,$gsql);

								if(odbc_num_rows($gres) == 1){
									$gsql	=	("SELECT [GuildID]
												FROM ".$this->db->get_TABLE("SH_GUILD_CHARS")."
												WHERE [CharID] = '".$char['CharID']."' AND [Del] = 0"
									);
									$gres	=	odbc_exec($this->db->conn, $gsql);
									$gfet	=	odbc_fetch_array($gres);
									$guild	=	new guild($gfet['GuildID'],$this->db->conn);
								}
								else{
									$guild	=	false;
								}
*/

								# Online Status
								if(isset($char['LoginStatus'])){
									if($char['LoginStatus']==0){
										$online = '<font color="#FF0000">Offline</font>';
									}
									else{
										$online = '<font color="#0000FF">Online</font>';
									}
								}
								else{
									$online = '<font color="#014b9d">Unknown</font>';
								}

								# KDR Ratio
								if($char['K2'] == 0){
									$kdr = $char['K1'];
								}
								else{
									$kdr = number_format($char['K1']/$char['K2'],2,'.','');
								}

								if($char['K1'] >= 200000){$cssicon = 16;}
								elseif($char['K1'] >= 150000){$cssicon = 15;}
								elseif($char['K1'] >= 130000){$cssicon = 14;}
								elseif($char['K1'] >= 110000){$cssicon = 13;}
								elseif($char['K1'] >= 90000){$cssicon = 12;}
								elseif($char['K1'] >= 70000){$cssicon = 11;}
								elseif($char['K1'] >= 50000){$cssicon = 10;}
								elseif($char['K1'] >= 40000){$cssicon = 9;}
								elseif($char['K1'] >= 30000){$cssicon = 8;}
								elseif($char['K1'] >= 20000){$cssicon = 7;}
								elseif($char['K1'] >= 10000){$cssicon = 6;}
								elseif($char['K1'] >= 5000){$cssicon = 5;}
								elseif($char['K1'] >= 1000){$cssicon = 4;}
								elseif($char['K1'] >= 300){$cssicon = 3;}
								elseif($char['K1'] >= 50){$cssicon = 2;}
								elseif($char['K1'] >= 1){$cssicon = 1;}
								else{$cssicon = 0;}

								echo '<tr>';
									echo '<td class="tac">'.$i.'</td>';
									echo '<td class="tac">'.$char['CharName'].'</td>';
									echo '<td class="i'.$cssjob.'" align="middle"></td>';
									echo '<td class="tac">'.$char['Level'].'</td>';
									echo '<td class="tac">'.$faction.'</td>';
/*
								if($guild != false){echo '<td>'.$guild->getName().'</td>';}
								else{
*/
									echo '<td></td>';
/*
								}
*/
									echo '<td class="tac">'.$online.'</td>';
									echo '<td class="tac">'.$char['MapName'].'</td>';
									echo '<td class="tac">'.$char['K1'].'</td>';
									echo '<td class="tac">'.$char['K2'].'</td>';
									echo '<td class="tac">'.$kdr.'</td>';
									echo '<td class="i'.$cssicon.'" align="middle"></td>';
								echo '</tr>';
							}
						}
						echo '</tbody>';
					echo '</table>';
				echo '</div>';

		# show next pages
		$csql	=	("
						SELECT Count([c].[CharID]) AS [Count]
						FROM ".$this->db->get_TABLE("SH_CHARDATA")." AS [c]
						INNER JOIN ".$this->db->get_TABLE("SH_USERDATA")." AS [u] ON [u].[UserUID] = [c].[UserUID]
						WHERE [c].[Del] = 0 AND [u].[Status] = 0 $where
		");
		$cres	=	odbc_exec($this->db->conn,$csql);
		$cfet	=	odbc_fetch_array($cres);
		$ccount	=	$cfet['Count'];
		$cpages	=	$ccount/$persite;

		echo '<div class="card-footer card_border content_bg footer no_radius pContent">';
			echo '<div class="tac b_i">';
				echo '<nav aria-label="Page navigation example">';
					echo '<ul class="pagination justify-content-center">';
	#					echo $this->PvP->pages($page,ceil($cpages),$url='?'.$this->Setting->PAGE_PREFIX.'='.$this->PAGE_INDEX.'&pvp='.$pvp);
					echo '</ul>';
				echo '</nav>';
			echo '</div>';
		echo '</div>';
		echo '</div>'; #tpl
		echo '</div>'; #tpl
		echo '</div>'; #tpl
		echo '</div>'; #tpl
		echo '</div>'; #tpl
		echo '</div>'; #tpl
?>