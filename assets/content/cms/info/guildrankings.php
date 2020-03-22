<?php
	# Content
	$this->Tpl->_start_mainSection();
		$this->Tpl->Separator(20);
		$this->Tpl->_do_pageHead("Guild Rankings");
			echo $this->GuildRanking->_get_Guild_Rankings();
		$this->Tpl->_do_pageFooter();
		$this->Tpl->Separator(20);
	$this->Tpl->_end_mainSection();
?>