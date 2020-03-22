<?php
	echo '<div id="plugin_card" class="card-s">';
		echo '<div class="card-header side-head card_border tac title pTitle show no_radius">Boss Records</div>';
		echo '<div class="card-block side-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
			echo $this->BossRecord->get_Record_Plugin();
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>