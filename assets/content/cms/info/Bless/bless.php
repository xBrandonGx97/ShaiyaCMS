<?php
include("config/config.php");
include("config/functions.php");
$sql	=	('
				SELECT GodBless_Light, GodBless_Dark FROM PS_GameData.dbo.WorldInfo
');
$stmt = $this->db->conn->prepare($sql);
$stmt->execute();
$row = $stmt->FETCH();

//for design width-------
$row['GodBless_Light'] = $row['GodBless_Light']/35; //100 or 1000 or others value
$row['GodBless_Dark'] = $row['GodBless_Dark']/35; //100 or 1000 or others value
//-------------------

echo "
<center><table class='bless-table'>
<tr>";
echo "<td style=\"width:340px;height:6px;padding-top:40px;\"><img src=\"assets/Themes/Standard/images/bless/light.png\" style=\"width:".$row['GodBless_Light']."px; height:8px;\" /></td><div class='spacer'></div><td align='right' style=\"width:340px;height:6px;padding-top:40px;\"><img src=\"assets/Themes/Standard/images/bless/dark.png\" style=\"width:".$row['GodBless_Dark']."px;height:9px;\" />
</td></tr>
</table></center>";
?>