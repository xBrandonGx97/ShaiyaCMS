<?php
	if(!isset($_POST) || !isset($_POST['CharID'])){
		return;
	}
	$charID = (int)$_POST['CharID'];
	if(!$charID){
		return;
	}

	$characterData['Stats'] = $rank_DAO->getCharacterStatData($charID);
	$characterData['LastKilled'] = $rank_DAO->getLastKilled($charID);
	$characterData['LastKilledBy'] = $rank_DAO->getLastKilledBy($charID);
	$characterData['MostKilled'] = $rank_DAO->getMostKilled($charID);
	$characterData['MostKilledBy'] = $rank_DAO->getMostKilledBy($charID);

	require_once('characterTooltip.view.php');
?>