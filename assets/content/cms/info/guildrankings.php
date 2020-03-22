<?php
	# Content
	$this->Tpl->_do_pageHead("Guild Rankings");
		echo $this->GuildRanking->_get_Guild_Rankings();
	$this->Tpl->_do_pageFooter();
?>