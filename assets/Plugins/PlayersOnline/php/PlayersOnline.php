<?php
	echo '<div id="plugin_card" class="card-s">';
		echo '<div class="card-header side-head card_border tac title pTitle show no_radius">Players Online</div>';
		echo '<div class="card-block side-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
				echo '<div class="m_tb_10 p_lr_15" id="plContainer">';
					echo '<table id="plContent" class="playerOnlineTable" style="display:block; padding-left: 20px;">';
						echo $this->SQL->playersOnline('3','1','redGlassBoxShadow redTextShadow');
					echo '</table>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>