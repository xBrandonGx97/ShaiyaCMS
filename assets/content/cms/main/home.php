<?php
	# Content
	$this->Tpl->_start_mainSection();
		echo '<h3 class="float-left u">News & Announcements</h3>';
		$this->Tpl->Separator(20);
		$this->SQL->LOAD_HP();
	$this->Tpl->_end_mainSection();
?>