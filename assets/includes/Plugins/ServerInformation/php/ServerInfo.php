<?php
$ServerIP	=	'127.0.0.1';
$ServerPorts = array(30800, 30810);
$LoginConn = @fsockopen($ServerIP, $ServerPorts[0], $errno, $errstr, 0.01);
$GameConn = @fsockopen($ServerIP, $ServerPorts[1], $errno, $errstr, 0.01);
$sql = ("
			SELECT COUNT(*) AS 'Players Online',
			(SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=1 AND Faction = '0') AS 'AoL',
			(SELECT COUNT(*) FROM PS_GameData.dbo.Chars WHERE LoginStatus=1 AND Faction = '1') AS 'UoF'
			FROM PS_GameData.dbo.Chars WHERE LoginStatus=?
");
$stmt=Database::connect()->prepare($sql);
$args = array(1);
$stmt->execute($args);
$fet 	= $stmt->FETCH();
$pOnline	=	$fet["Players Online"];
$AoL	=	$fet["AoL"];
$UoF	=	$fet["UoF"];
	echo '<div id="plugin_card" class="card-s bg-dark">';
		echo '<div class="card-header side-head card_border text-center title pTitle show no_radius">Server Information</div>';
		echo '<div class="card-block side-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
			echo '<div class="server-info text-center">';
				echo '<h6 class="mb-2">EP5.4 Server</h6>';
				echo '<h6 class="mb-2">Game Server: ';
				if ($GameConn){
					echo '<span style="color:lime;text-shadow:2px 2px #000" class="b">Online</span>';
				}
				else{
					echo '<span style="color:red;text-shadow:2px 2px #000" class="b">Offline</span></h6>';
				}
				@fclose($GameConn);
				echo '<h6 class="mb-2">Login Server: ';
				if ($LoginConn){
					echo '<span class="s-Online">Online</span>';
				}
				else{
					echo '<span class="s-Offline">Offline</span></h6>';
				}
				@fclose($LoginConn);
				echo '<h6 class="mb-2">KillRate x1</h6>';
				echo '<h6 class="mb-2">ExpRate x20</h6>';
				echo '<h6 class="mb-2">Players Online: <span class="s-pOnline">'.$pOnline.'</span></h6>';
				echo 'AoL: <span class="s-AoL">'.$AoL.'</span></h6> UoF: <span class="s-UoF">'.$UoF.'</span>';
			echo '</div>';
#				echo '<div class="m_tb_10 p_lr_15" id="plContainer">';
#					echo '<table id="plContent" class="playerOnlineTable" style="display:block; padding-left: 20px;">';
#						echo $this->SQL->playersOnline('3','1','redGlassBoxShadow redTextShadow');
#					echo '</table>';
#				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>