<?php
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("Boss Records","Boss Record Respawn Times");
			echo BossRecord::get_Record();
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>