<?php
	if(!isset($characterRanks['Data']) || !count($characterRanks['Data'])){
		echo 'No results to display.';
		return;
	}

	$pagingHelper->displayPageNumberOverview();

	echo '<table class="RankTable" width="100%">';
		echo '<thead style="cursor:pointer;">';
			echo '<th title="A gold number indicates the player is currently online.">';#</th>
			echo '<th title="The character\'s name.">Name</th>';
			echo '<th title="The character\'s class and faction. Faction is indicated by the color of the background.">Cls</th>';
			echo '<th title="The character\'s level.">Level</th>';
			echo '<th title="The guild the character is currently a member of.">Guild</th>';
			echo '<th><a href="#K1" title="The number of kills the character has since their data was last updated. Click here to sort by kills.">Kills</a></th>';
			echo '<th><a href="#K2" title="The number of deaths the character has since their data was last updated. Click here to sort by deaths.">Deaths</a></th>';
			echo '<th><a href="#KDR" title="The number of kills divided by deaths the character has since their data was last updated. Click here to sort by kill to death ratio.">KDR</a></th>';
			echo '<th>Rank</th>';
		echo '</thead>';
		echo '<tbody>';
		foreach($characterRanks['Data'] as $c){
			echo '<tr>';
				echo '<td class="'.$c['Leave'].'" title="'.$c['Leave'].'" style="cursor:pointer">'.$c['RowIndex'].'</td>';
				echo '<td class="tooltip CharName" id="Char_'.$c['CharID'].'">'.htmlspecialchars($c['CharName']).'</td>';
				echo '<td align="center" style="width:16px;">';
					echo '<span class="'.$c['Faction'].'">';
						echo '<span class="ClassIcon '.$c['CharClass'].'" title="'.htmlspecialchars($c['CharClass']).'">';
							echo '&nbsp;';
						echo '</span>';
					echo '</span>';
				echo '</td>';
				echo '<td align="right">'.$c['Level'].'</td>';
				echo '<td>'.htmlspecialchars($c['GuildName']).'</td>';
				echo '<td align="right">'.$c['K1'].'</td>';
				echo '<td align="right">'.$c['K2'].'</td>';
				echo '<td align="right">'.$c['KDR'].'</td>';
				echo '<td align="center">';
					echo '<span ';
					if(!empty($c['Rank'])){
						echo 'class="RankIcon Rank'.str_pad($c['Rank'],2,0,STR_PAD_LEFT).'" title="Rank'.$c['Rank'].'"';
					}
					echo '>&nbsp;';
					echo '</span>';
				echo '</td>';
			echo '</tr>';
		}
		echo '</tbody>';
	echo '</table>';

	$pagingHelper->displayPageNumberOverview();
?>
<script type="text/javascript" src="./js/rank.js"></script>