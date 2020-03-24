<?php
/**
 * Data access object for querying player ranking information from the database.
 */
namespace Classes\Shaiya;
class Rank_DAO{
    public function __construct($Data,$db,$pagingHelper){
        $this->Data = $Data;
        $this->db   = $db;
        $this->pagingHelper = $pagingHelper;
    }
	/**
	 * Get a paginated array of characters and their ranks based on the input criteria.
	 * @param array $criteria
	 * @return array
	 */
	public function getCharacterRanks($criteria = array()){
		// Map level filter to valid level ranges for PVP zones.
		$validLevels = array(
			0=>array(1,999),
			1=>array(1,15),
			2=>array(16,30),
			3=>array(31,999),
		);
		$minLevel = 0;
		$maxLevel = 999;
		if(isset($criteria['level']) && isset($validLevels[$criteria['level']])){
			$minLevel = $validLevels[$criteria['level']][0];
			$maxLevel = $validLevels[$criteria['level']][1];
		}

		// Map classes to valid class expressions.
		$classSQL = '';
		$validClasses = array(
			'fighter'=>'AND c.Family = 0 AND c.Job = 0',
			'defender'=>'AND c.Family = 0 AND c.Job = 1',
			'archer'=>'AND c.Family = 1 AND c.Job = 3',
			'ranger'=>'AND c.Family = 1 AND c.Job = 2',
			'mage'=>'AND c.Family = 1 AND c.Job = 4',
			'priest'=>'AND c.Family = 0 AND c.Job = 5',
			'warrior'=>'AND c.Family = 3 AND c.Job = 0',
			'guardian'=>'AND c.Family = 3 AND c.Job = 1',
			'assassin'=>'AND c.Family = 2 AND c.Job = 2',
			'hunter'=>'AND c.Family = 3 AND c.Job = 3',
			'pagan'=>'AND c.Family = 2 AND c.Job = 4',
			'oracle'=>'AND c.Family = 2 AND c.Job = 5',
		);
		if(isset($criteria['class']) && !empty($criteria['class']) && isset($validClasses[$criteria['class']])){
			$classSQL = $validClasses[$criteria['class']];
		}

		// Map factions to valid faction expressions.
		$factionSQL = '';
		$validFactions = array(
			1=>'AND umg.Country = 0',
			2=>'AND umg.Country = 1'
		);
		if(isset($criteria['faction']) && !empty($criteria['faction']) && isset($validFactions[$criteria['faction']])){
			$factionSQL = $validFactions[$criteria['faction']];
		}

		// Create SQL for page ordering.
		if(isset($criteria['pageOrder']) && !empty($criteria['pageOrder']) && isset($criteria['pageDirection']) && !empty($criteria['pageDirection'])){
			if($criteria['pageOrder'] == 'KDR'){
				$criteria['pageOrder'] = 'CASE WHEN (c.K1 = 0 OR c.K2 = 0) THEN 0 ELSE CAST(c.K1/CAST(c.K2 AS decimal(18,2)) AS decimal(18,2)) END';
			}
			$pageOrderSQL = "ORDER BY {$criteria['pageOrder']} {$criteria['pageDirection']}";
		}else{
			$pageOrderSQL = "ORDER BY K1 DESC";
		}

		$startIndex = ($criteria['pageSize'] * $criteria['pageIndex']) + 1;
		$endIndex = $startIndex + $criteria['pageSize'];

		$query=$this->db->connect()->prepare("
			SELECT
			RowIndex,CharClass,Rank,Faction,CharID,CharName,Level,GuildName,K1,K2,KDR,Leave,LastSeen,TotalCount
		FROM(
			SELECT
			COUNT(*) OVER() AS TotalCount,
			Row_Number() OVER({$pageOrderSQL}) AS RowIndex,
			CASE
				WHEN c.Family = 0 AND c.Job = 0 THEN 'Fighter'
				WHEN c.Family = 0 AND c.Job = 1 THEN 'Defender'
				WHEN c.Family = 1 AND c.Job = 2 THEN 'Ranger'
				WHEN c.Family = 1 AND c.Job = 3 THEN 'Archer'
				WHEN c.Family = 1 AND c.Job = 4 THEN 'Mage'
				WHEN c.Family = 0 AND c.Job = 5 THEN 'Priest'
				WHEN c.Family = 3 AND c.Job = 0 THEN 'Warrior'
				WHEN c.Family = 3 AND c.Job = 1 THEN 'Guardian'
				WHEN c.Family = 2 AND c.Job = 2 THEN 'Assassin'
				WHEN c.Family = 3 AND c.Job = 3 THEN 'Hunter'
				WHEN c.Family = 2 AND c.Job = 4 THEN 'Pagan'
				WHEN c.Family = 2 AND c.Job = 5 THEN 'Oracle'
			END AS CharClass,
			CASE
				WHEN K1 <= 0 THEN 0
				WHEN K1 < 50 THEN 1
				WHEN K1 < 300 THEN 2
				WHEN K1 < 1000 THEN 3
				WHEN K1 < 5000 THEN 4
				WHEN K1 < 10000 THEN 5
				WHEN K1 < 20000 THEN 6
				WHEN K1 < 30000 THEN 7
				WHEN K1 < 40000 THEN 8
				WHEN K1 < 50000 THEN 9
				WHEN K1 < 70000 THEN 10
				WHEN K1 < 90000 THEN 11
				WHEN K1 < 110000 THEN 12
				WHEN K1 < 130000 THEN 13
				WHEN K1 < 150000 THEN 14
				WHEN K1 < 200000 THEN 15
				WHEN K1 < 250000 THEN 16
				WHEN K1 < 300000 THEN 17
				WHEN K1 < 350000 THEN 18
				WHEN K1 < 400000 THEN 19
				WHEN K1 < 450000 THEN 20
				WHEN K1 < 500000 THEN 21
				WHEN K1 < 550000 THEN 22
				WHEN K1 < 600000 THEN 23
				WHEN K1 < 650000 THEN 24
				WHEN K1 < 700000 THEN 25
				WHEN K1 < 750000 THEN 26
				WHEN K1 < 800000 THEN 27
				WHEN K1 < 850000 THEN 28
				WHEN K1 < 900000 THEN 29
				WHEN K1 < 1000000 THEN 30
				ELSE 31
			END AS Rank,
			CASE
				WHEN umg.Country = 0 THEN 'AoL'
				WHEN umg.Country = 1 THEN 'UoF'
				ELSE ''
			END AS Faction,
			c.CharID,c.CharName,c.Level,g.GuildName,c.K1,c.K2,
			CASE
				WHEN (c.K1 = 0 OR c.K2 = 0) THEN 0
				ELSE CAST(c.K1/CAST(c.K2 AS decimal(18,2)) AS decimal(18,2))
				END AS KDR,
			CASE
				WHEN um.Leave = 1 THEN 'Online' ELSE 'Offline'
				END AS Leave,
			CASE
				WHEN um.JoinDate > um.LeaveDate THEN um.JoinDate
				ELSE um.LeaveDate
				END AS LastSeen
			FROM PS_GameData.dbo.Chars c
			INNER JOIN PS_UserData.dbo.Users_Master um ON um.UserUID = c.UserUID
			INNER JOIN PS_GameData.dbo.UserMaxGrow umg ON umg.UserUID = um.UserUID AND umg.ServerID = 1
			LEFT JOIN PS_GameData.dbo.GuildChars gc ON gc.CharID = c.CharID AND gc.Del = 0
			LEFT JOIN PS_GameData.dbo.Guilds g ON g.GuildID = gc.GuildID
			WHERE um.Status >= 0 AND um.AdminLevel = 0 AND c.Level BETWEEN {$minLevel} AND {$maxLevel}
			{$classSQL}
			{$factionSQL}
			AND c.Del = 0
		) AS t1
		WHERE t1.RowIndex >= :startIndex AND  t1.RowIndex < :endIndex
		");
			$query->execute(array(':startIndex'=>$startIndex,':endIndex'=>$endIndex));

		$characterRanks = array();
		$characterRanks[13] = 0;
		while($row=$query->fetch(\PDO::FETCH_NUM)){
			$characterRanks['Data'][] = $row;
		}
		if(isset($characterRanks['Data'])){
			$characterRanks[13] = isset($characterRanks['Data'][0]) ? $characterRanks['Data'][0][13] : 0;
		}

		return $characterRanks;
	}


	/**
	 * Get character statistics for a single character.
	 * @param $charID
	 * @return array
	 */
	public function getCharacterStatData($charID){
		$query=$this->db->connect()->prepare("
			SELECT
			c.CharID AS [CharID],
			c.CharName AS [CharName],
			CASE WHEN c.HP < 0 THEN CONVERT(int,(32767 - (c.HP*-1)) + 32767) ELSE CONVERT(int,c.HP) end AS [HP],
			CASE WHEN c.MP < 0 THEN CONVERT(int,(32767 - (c.MP*-1)) + 32767) ELSE CONVERT(int,c.MP) end AS [MP],
			CASE WHEN c.SP < 0 THEN CONVERT(int,(32767 - (c.SP*-1)) + 32767) ELSE CONVERT(int,c.SP) end AS [SP],
			c.Str AS BaseStr,
			c.Dex AS BaseDex,
			c.Rec AS BaseRec,
			c.Int AS BaseInt,
			c.Wis AS BaseWis,
			c.Luc AS BaseLuc,
			c.Level,
			CASE
				WHEN c.Family = 0 AND c.Job = 0 THEN 'Fighter'
				WHEN c.Family = 0 AND c.Job = 1 THEN 'Defender'
				WHEN c.Family = 1 AND c.Job = 2 THEN 'Ranger'
				WHEN c.Family = 1 AND c.Job = 3 THEN 'Archer'
				WHEN c.Family = 1 AND c.Job = 4 THEN 'Mage'
				WHEN c.Family = 0 AND c.Job = 5 THEN 'Priest'
				WHEN c.Family = 3 AND c.Job = 0 THEN 'Warrior'
				WHEN c.Family = 3 AND c.Job = 1 THEN 'Guardian'
				WHEN c.Family = 2 AND c.Job = 2 THEN 'Assassin'
				WHEN c.Family = 3 AND c.Job = 3 THEN 'Hunter'
				WHEN c.Family = 2 AND c.Job = 4 THEN 'Pagan'
				WHEN c.Family = 2 AND c.Job = 5 THEN 'Oracle'
			END AS CharClass,
			CASE WHEN umg.Country = 0 THEN 'AoL' WHEN umg.Country = 1 THEN 'UoF' ELSE '' END AS Faction,
			CASE WHEN c.JoinDate > c.LeaveDate THEN CAST(c.JoinDate AS DateTime) ELSE CAST(c.LeaveDate AS DateTime) END AS LastSeen,
			ISNULL(characterItems.ConstStr,0) + ISNULL(lapisSum.ConstStr,0) AS [Str],
			ISNULL(characterItems.ConstDex,0) + ISNULL(lapisSum.ConstDex,0) AS [Dex],
			ISNULL(characterItems.ConstRec,0) + ISNULL(lapisSum.ConstRec,0) AS [Rec],
			ISNULL(characterItems.ConstInt,0) + ISNULL(lapisSum.ConstInt,0) AS [Int],
			ISNULL(characterItems.ConstWis,0) + ISNULL(lapisSum.ConstWis,0) AS [Wis],
			ISNULL(characterItems.ConstLuc,0) + ISNULL(lapisSum.ConstLuc,0) AS [Luc],
			CONVERT(int,c.Str) + CONVERT(int,c.Dex) + CONVERT(int,c.Rec) + CONVERT(int,c.Int) + CONVERT(int,c.Wis) + CONVERT(int,c.Luc) AS BaseStat,
			CONVERT(int,c.Str + ISNULL(characterItems.ConstStr,0) + ISNULL(lapisSum.ConstStr,0) + c.Dex + ISNULL(characterItems.ConstDex,0) + ISNULL(lapisSum.ConstDex,0) + c.Rec + ISNULL(characterItems.ConstRec,0) + ISNULL(lapisSum.ConstRec,0) + c.Int + ISNULL(characterItems.ConstInt,0) + ISNULL(lapisSum.ConstInt,0) + c.Wis + ISNULL(characterItems.ConstWis,0) + ISNULL(lapisSum.ConstWis,0) + c.Luc + ISNULL(characterItems.ConstLuc,0) + ISNULL(lapisSum.ConstLuc,0)) AS [TotalStat],
			CONVERT(int,c.Rec + ISNULL(characterItems.ConstRec,0) + ISNULL(lapisSum.ConstRec,0) + ISNULL(characterItems.Defense,0) + ISNULL(lapisSum.Defense,0)) AS [Defense],
			CONVERT(int,c.Wis + ISNULL(characterItems.ConstWis,0) + ISNULL(lapisSum.ConstWis,0) + ISNULL(characterItems.MagicResist,0) + ISNULL(lapisSum.MagicResist,0)) AS [MagicResist],
			CONVERT(int,ISNULL(characterItems.Absorb,0) + ISNULL(lapisSum.Absorb,0)) AS [Absorb],
			CONVERT(int,CASE
				WHEN c.Job < 3 THEN
					(c.Str + ISNULL(characterItems.ConstStr,0) + ISNULL(lapisSum.ConstStr,0)) * 1.3 + (c.Dex + ISNULL(characterItems.ConstDex,0) + ISNULL(lapisSum.ConstDex,0)) * .2 + ISNULL(characterItems.Attack,0) + ISNULL(lapisSum.Attack,0)
				WHEN c.Job = 3 THEN
					(c.Str + ISNULL(characterItems.ConstStr,0) + ISNULL(lapisSum.ConstStr,0)) + (c.Dex + ISNULL(characterItems.ConstDex,0) + ISNULL(lapisSum.ConstDex,0)) * .2 + (c.Luc + ISNULL(characterItems.ConstLuc,0) + ISNULL(lapisSum.ConstLuc,0)) * .3 + ISNULL(characterItems.Attack,0) + ISNULL(lapisSum.Attack,0)
				ELSE
					(c.Int + ISNULL(characterItems.ConstInt,0) + ISNULL(lapisSum.ConstInt,0)) + (c.Wis + ISNULL(characterItems.ConstWis,0) + ISNULL(lapisSum.ConstWis,0)) * .2 + ISNULL(characterItems.Attack,0) + ISNULL(lapisSum.Attack,0)
				END) AS AttackMin,
			CONVERT(int,CASE
				WHEN c.Job < 3 THEN
					(c.Str + ISNULL(characterItems.ConstStr,0) + ISNULL(lapisSum.ConstStr,0)) * 1.3 + (c.Dex + ISNULL(characterItems.ConstDex,0) + ISNULL(lapisSum.ConstDex,0)) * .2 + ISNULL(characterItems.Attack,0) + ISNULL(lapisSum.Attack,0) + ISNULL(characterItems.AttackModifier,0) + ISNULL(lapisSum.AttackModifier,0)
				WHEN c.Job = 3 THEN
					(c.Str + ISNULL(characterItems.ConstStr,0) + ISNULL(lapisSum.ConstStr,0)) + (c.Dex + ISNULL(characterItems.ConstDex,0) + ISNULL(lapisSum.ConstDex,0)) * .2 + (c.Luc + ISNULL(characterItems.ConstLuc,0) + ISNULL(lapisSum.ConstLuc,0)) * .3 + ISNULL(characterItems.Attack,0) + ISNULL(lapisSum.Attack,0) + ISNULL(characterItems.AttackModifier,0) + ISNULL(lapisSum.AttackModifier,0)
				ELSE
					(c.Int + ISNULL(characterItems.ConstInt,0) + ISNULL(lapisSum.ConstInt,0)) + (c.Wis + ISNULL(characterItems.ConstWis,0) + ISNULL(lapisSum.ConstWis,0)) * .2 + ISNULL(characterItems.Attack,0) + ISNULL(lapisSum.Attack,0) + ISNULL(characterItems.AttackModifier,0) + ISNULL(lapisSum.AttackModifier,0)
				END) AS AttackMax
		FROM PS_GameData.dbo.Chars c
		INNER JOIN PS_UserData.dbo.Users_Master AS um ON c.UserUID = um.UserUID
		INNER JOIN PS_GameData.dbo.UserMaxGrow umg ON umg.UserUID = um.UserUID AND umg.ServerID = 1
		LEFT JOIN (
			SELECT
				DISTINCT ci.CharID AS CharID,
				SUM(i.ConstStr + CASE WHEN i.ReqWis > 0 THEN CONVERT(int,SUBSTRING(ci.CraftName,1,2)) ELSE 0 END) AS ConstStr,
				SUM(i.ConstDex + CASE WHEN i.ReqWis > 0 THEN CONVERT(int,SUBSTRING(ci.CraftName,3,2)) ELSE 0 END) AS ConstDex,
				SUM(i.ConstRec + CASE WHEN i.ReqWis > 0 THEN CONVERT(int,SUBSTRING(ci.CraftName,5,2)) ELSE 0 END) AS ConstRec,
				SUM(i.ConstInt + CASE WHEN i.ReqWis > 0 THEN CONVERT(int,SUBSTRING(ci.CraftName,7,2)) ELSE 0 END) AS ConstInt,
				SUM(i.ConstWis + CASE WHEN i.ReqWis > 0 THEN CONVERT(int,SUBSTRING(ci.CraftName,9,2)) ELSE 0 END) AS ConstWis,
				SUM(i.ConstLuc + CASE WHEN i.ReqWis > 0 THEN CONVERT(int,SUBSTRING(ci.CraftName,11,2)) ELSE 0 END) AS ConstLuc,
				SUM(i.Effect1 + CASE WHEN i.ReqWis > 0 AND (CONVERT(int,SUBSTRING(ci.CraftName,19,2)) BETWEEN 1 AND 20) THEN
					CASE
						WHEN SUBSTRING(ci.CraftName,19,2) = '01' THEN 7 WHEN SUBSTRING(ci.CraftName,19,2) = '02' THEN 14 WHEN SUBSTRING(ci.CraftName,19,2) = '03' THEN 21
						WHEN SUBSTRING(ci.CraftName,19,2) = '04' THEN 31 WHEN SUBSTRING(ci.CraftName,19,2) = '05' THEN 41 WHEN SUBSTRING(ci.CraftName,19,2) = '06' THEN 51
						WHEN SUBSTRING(ci.CraftName,19,2) = '07' THEN 64 WHEN SUBSTRING(ci.CraftName,19,2) = '08' THEN 77 WHEN SUBSTRING(ci.CraftName,19,2) = '09' THEN 90
						WHEN SUBSTRING(ci.CraftName,19,2) = '10' THEN 106 WHEN SUBSTRING(ci.CraftName,19,2) = '11' THEN 122 WHEN SUBSTRING(ci.CraftName,19,2) = '12' THEN 138
						WHEN SUBSTRING(ci.CraftName,19,2) = '13' THEN 157 WHEN SUBSTRING(ci.CraftName,19,2) = '14' THEN 176 WHEN SUBSTRING(ci.CraftName,19,2) = '15' THEN 195
						WHEN SUBSTRING(ci.CraftName,19,2) = '16' THEN 217 WHEN SUBSTRING(ci.CraftName,19,2) = '17' THEN 239 WHEN SUBSTRING(ci.CraftName,19,2) = '18' THEN 261
						WHEN SUBSTRING(ci.CraftName,19,2) = '19' THEN 286 WHEN SUBSTRING(ci.CraftName,19,2) = '20' THEN 311
					END
				ELSE 0 END) AS Attack,
				SUM(i.Effect2) AS AttackModifier,
				SUM(i.Effect3) AS Defense,
				SUM(i.Effect4) AS MagicResist,
				SUM(CASE WHEN i.ReqWis > 0 AND (CONVERT(int,SUBSTRING(ci.CraftName,19,2)) BETWEEN 51 AND 70) THEN ((CONVERT(int,SUBSTRING(ci.CraftName,19,2)) - 50) * 5) ELSE 0 END) AS Absorb
			FROM PS_GameData.dbo.CharItems ci
				LEFT JOIN PS_GameDefs.dbo.Items i ON i.ItemID = ci.ItemID
			WHERE ci.Bag = 0
				AND ci.Slot >= 0
				AND ci.Slot != 13
			GROUP BY ci.CharID
		) AS characterItems ON c.CharID = characterItems.CharID
		LEFT JOIN (
			SELECT
				DISTINCT ci.CharID AS CharID,
				SUM(ISNULL(lapis.ConstStr,0)) AS ConstStr,
				SUM(ISNULL(lapis.ConstDex,0)) AS ConstDex,
				SUM(ISNULL(lapis.ConstRec,0)) AS ConstRec,
				SUM(ISNULL(lapis.ConstInt,0)) AS ConstInt,
				SUM(ISNULL(lapis.ConstWis,0)) AS ConstWis,
				SUM(ISNULL(lapis.ConstLuc,0)) AS ConstLuc,
				SUM(ISNULL(lapis.Effect1,0)) AS Attack,
				SUM(ISNULL(lapis.Effect2,0)) AS AttackModifier,
				SUM(ISNULL(lapis.Effect3,0)) AS Defense,
				SUM(ISNULL(lapis.Effect4,0)) AS MagicResist,
				SUM(ISNULL(lapis.Exp,0)) AS Absorb
			FROM PS_GameData.dbo.CharItems ci
				INNER JOIN PS_GameDefs.dbo.Items i ON ci.ItemID = i.ItemID
				LEFT JOIN PS_GameDefs.dbo.Items lapis ON lapis.Type = 30 AND lapis.TypeID IN(ci.Gem1,ci.Gem2,ci.Gem3,ci.Gem4,ci.Gem5,ci.Gem6)
			WHERE ci.Bag = 0
				AND ci.Slot >= 0
				AND ci.Slot != 13
			GROUP BY ci.CharID
		) AS lapisSum ON c.CharID = lapisSum.CharID
		WHERE
			c.CharID = ?
			AND c.Del = 0
			AND um.AdminLevel = 0
		");
		$query->execute(array(':charID'=>$charID));

		$characterData = array();
		if($row=$query->fetch(\PDO::FETCH_NUM)){
			$characterData = $row;
		}
		return $characterData;
	}
	/**
	 * Get the character that was last killed by $charID
	 * @param int $charID
	 * @return array
	 */
	public function getLastKilled($charID){
		$query=$this->db->connect()->prepare("
			SELECT Top 1
			al.Text1 AS LastKilled
			FROM PS_GameLog.dbo.ActionLog al
			WHERE al.ActionType = 103
			AND al.CharID = :charID
			ORDER BY al.ActionTime DESC
		");
		$query->execute(array(':charID'=>$charID));

		$lastKilled = array();
		while($row=$query->fetch(\PDO::FETCH_NUM)){
			$lastKilled = $row;
		}
		return $lastKilled;
	}
	/**
	 * Get the character that last killed $charID
	 * @param int $charID
	 * @return array
	 */
	public function getLastKilledBy($charID){
		$query=$this->db->connect()->prepare("
			SELECT Top 1
			al.Text1 AS LastKilledBy
			FROM PS_GameLog.dbo.ActionLog al
			WHERE al.ActionType = 103
			AND al.Value1 = :charID
			ORDER BY al.ActionTime DESC
		");
		$query->execute(array(':charID'=>$charID));

		$lastKilledBy = array();
		while($row=$query->fetch(\PDO::FETCH_NUM)){
			$lastKilledBy = $row;
		}
		return $lastKilledBy;
	}
	/**
	 * Get the character that $charID has killed the most
	 * @param int $charID
	 * @param string $startDate
	 * @return array
	 */
	public function getMostKilled($charID,$startDate = null){
		if(!$startDate){
			$startDate = '1970-01-01 00:00:00';
		}
		$query=$this->db->connect()->prepare("
			SELECT Top 1
			al.Text1 AS MostKilled,
			COUNT(al.Text1) AS MostKilledCount,
			Row_Number() OVER(ORDER BY COUNT(al.Text1) DESC) AS MostKilledOrder
			FROM PS_GameLog.dbo.ActionLog al
			WHERE al.ActionType = 103
			AND al.CharID = :charID
			AND al.ActionTime >= :startDate
			GROUP BY al.Text1
		");
		$query->execute(array(':charID'=>$charID,':startDate'=>$startDate));

		$mostKilled = array();
		while($row=$query->fetch(\PDO::FETCH_NUM)){
			$mostKilled = $row;
		}
		return $mostKilled;
	}
	/**
	 * Get the character that has killed $charID the most
	 * @param int $charID
	 * @param string $startDate
	 * @return array
	 */
	public function getMostKilledBy($charID,$startDate = null){
		if(!$startDate){
			$startDate = '1970-01-01 00:00:00';
		}
		$query=$this->db->connect()->prepare("
			SELECT Top 1
			al.Text1 AS MostKilledBy,
			COUNT(al.Text1) AS MostKilledByCount,
			Row_Number() OVER(ORDER BY COUNT(al.Text1) DESC) AS MostKilledByOrder
			FROM PS_GameLog.dbo.ActionLog al
			WHERE al.ActionType = 103
			AND al.Value1 = :charID
			AND al.ActionTime >= :startDate
			GROUP BY al.Text1
		");
		$query->execute(array(':charID'=>$charID,':startDate'=>$startDate));

		$mostKilledBy = array();
		while($row=$query->fetch(\PDO::FETCH_NUM)){
			$mostKilledBy = $row;
		}
		return $mostKilledBy;
	}
	public function _get_rank_view($characterRanks){
		if(!isset($characterRanks['Data']) || !count($characterRanks['Data'])){
			echo 'No results to display.';
			return;
		}

		#$this->pagingHelper->displayPageNumberOverview();

		echo '<table class="RankTable text-white table table-striped table-bordered acp_table">';
			echo '<thead style="cursor:pointer;">';
				echo '<tr class="tac">';
					echo '<th title="A gold number indicates the player is currently online.">#</th>';
					echo '<th title="The character\'s name.">Name</th>';
					echo '<th title="The character\'s name.">Faction</th>';
					echo '<th title="The character\'s class and faction. Faction is indicated by the color of the background.">Class</th>';
					echo '<th title="The character\'s level.">Level</th>';
					echo '<th title="The guild the character is currently a member of.">Guild</th>';
					echo '<th><a href="#K1" title="The number of kills the character has since their data was last updated. Click here to sort by kills.">Kills</a></th>';
					echo '<th><a href="#K2" title="The number of deaths the character has since their data was last updated. Click here to sort by deaths.">Deaths</a></th>';
					echo '<th><a href="#KDR" title="The number of kills divided by deaths the character has since their data was last updated. Click here to sort by kill to death ratio.">KDR</a></th>';
					echo '<th>Rank</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach($characterRanks['Data'] as $c){
#				echo '<pre>';
#					var_dump($c);
#				echo '</pre>';
#				exit();
				echo '<tr>';
					echo '<td class="tac '.$this->Data->_do('online_status_2_text',$c[11]).'" title="'.$c[11].'" style="cursor:pointer">'.$c[0].'</td>';
					echo '<td class="CharName" id="Char_'.$c[4].'">'.htmlspecialchars($c[5]).'</td>';
					echo '<td class="tac">'.$c[3].'</td>';
					echo '<td class="IconHolder">';
#						echo '<span class="'.$c['Faction'].'">';
#							echo '<span class="ClassIcon '.$c['CharClass'].'" title="'.htmlspecialchars($c['CharClass']).'"></span>';
#						echo '</span>';
						echo '<span class="'.$c[3].'">';
							echo '<span class="ClassIcon '.$c[1].'" title="'.htmlspecialchars($c[1]).'"></span>';
						echo '</span>';
					echo '</td>';
					echo '<td class="tac">'.$c[6].'</td>';
					echo '<td class="tac">'.htmlspecialchars($c[7]).'</td>';
					echo '<td class="tac">'.$c[8].'</td>';
					echo '<td class="tac">'.$c[9].'</td>';
					echo '<td class="tac">'.$c[10].'</td>';
					echo '<td class="tac align-middle">';
						echo '<span class="RankIcon Rank'.str_pad($c['2'],2,0,STR_PAD_LEFT).'" title="Rank '.$c['2'].'"></span>';
					echo '</td>';
				echo '</tr>';
			}
			echo '</tbody>';
			echo '<tfoot>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
			echo '</tfoot>';
		echo '</table>';

		#$this->pagingHelper->displayPageNumberOverview();
	}
}
?>
