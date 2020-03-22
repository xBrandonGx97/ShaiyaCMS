<?php
	# Content
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("Guild Rankings");
			echo GuildRanking::_get_Guild_Rankings();
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>