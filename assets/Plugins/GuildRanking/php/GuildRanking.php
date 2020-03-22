<?php
	echo '<div id="plugin_card" class="card-s">';
		echo '<div class="card-header side-head card_border tac title pTitle show no_radius">Guild Rankings</div>';
		echo '<div class="card-block side-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
			echo $this->GuildRanking->_get_Guild_Rankings_Plugin();
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>