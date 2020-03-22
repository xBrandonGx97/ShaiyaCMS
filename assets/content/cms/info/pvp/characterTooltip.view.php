<?php
	echo '<pre>';
		var_dump($_POST);
	echo '</pre>';
	die();	
	echo '<table class="CharStatTable">';
		echo '<tbody>';
			echo '<tr>';
				echo '<td colspan="4" align="center">';
					echo 'Level '.$characterData['Stats']['Level'].'. '.$characterData['Stats']['CharClass'];
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="4" align="center">';
					echo '<span class="'.$characterData['Stats']['Faction'].'">';
						echo '<span class="ClassIcon '.htmlspecialchars($characterData['Stats']['CharClass']).'">&nbsp;</span>';
					echo '</span>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">Attack</td>';
				echo '<td colspan="2" align="right">'.$characterData['Stats']['AttackMin'].' - '.$characterData['Stats']['AttackMax'].'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Defense</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['Defense'];
				echo '</td>';
				echo '<td>Resist</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['MagicResist'];
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="4">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Str</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['BaseStr'].' + <span class="GearStat">'.$characterData['Stats']['Str'].'</span>';
				echo '</td>';
				echo '<td>Wis</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['BaseWis'].' + <span class="GearStat">'.$characterData['Stats']['Wis'].'</span>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Rec</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['BaseRec'].' + <span class="GearStat">'.$characterData['Stats']['Rec'].'</span>';
				echo '</td>';
				echo '<td>Dex</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['BaseDex'].' + <span class="GearStat">'.$characterData['Stats']['Dex'].'</span>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>Int</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['BaseInt'].' + <span class="GearStat">'.$characterData['Stats']['Int'].'</span>';
				echo '</td>';
				echo '<td>Luc</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['BaseLuc'].' + <span class="GearStat">'.$characterData['Stats']['Luc'].'</span>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2" class="Bold">Base Stats</td>';
				echo '<td colspan="2" align="right">';
					echo $characterData['Stats']['BaseStat'];
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2" class="Bold">Total Stats</td>';
				echo '<td colspan="2" align="right">'.$characterData['Stats']['TotalStat'].'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="4">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>HP</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['HP'];
				echo '</td>';
				echo '<td>Attack</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['AttackMin'].' - '.$characterData['Stats']['AttackMax'];
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>MP</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['MP'];
				echo '</td>';
				echo '<td>Defense</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['Defense'];
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>SP</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['SP'];
				echo '</td>';
				echo '<td>Resist</td>';
				echo '<td align="right">';
					echo $characterData['Stats']['MagicResist'];
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="4">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">Last Killed</td>';
				echo '<td colspan="2" align="right">';
					isset($characterData['LastKilled']['LastKilled']) ? htmlspecialchars($characterData['LastKilled']['LastKilled']) : 'No Data';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">Last Killed By</td>';
				echo '<td colspan="2" align="right">';
					isset($characterData['LastKilledBy']['LastKilledBy']) ? htmlspecialchars($characterData['LastKilledBy']['LastKilledBy']) : 'No Data';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">Most Killed</td>';
				echo '<td colspan="2" align="right">';
					isset($characterData['MostKilled']['MostKilled']) ? htmlspecialchars($characterData['MostKilled']['MostKilled']) : 'No Data'.'('.isset($characterData['MostKilled']['MostKilledCount']) ? $characterData['MostKilled']['MostKilledCount'] : 'N/A');
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">Most Killed By</td>';
				echo '<td colspan="2" align="right">';
					isset($characterData['MostKilledBy']['MostKilledBy']) ? htmlspecialchars($characterData['MostKilledBy']['MostKilledBy']) : 'No Data'.'('.isset($characterData['MostKilledBy']['MostKilledByCount']) ? $characterData['MostKilledBy']['MostKilledByCount'] : 'N/A');
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="4">&nbsp;</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="2">Last Seen</td>';
				echo '<td  colspan="2" align="right">';
					isset($characterData['Stats']['LastSeen']) ? $characterData['Stats']['LastSeen'] : 'No Data';
				echo '</td>';
			echo '</tr>';
		echo '</tbody>';
	echo '</table>';
?>