<?php
	# Content
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("Downloads","Thank you for downloading!");
			Downloads::_get_Downloads();
			Downloads::_get_Patch();
			Downloads::_get_sysRequirements();
			Downloads::_drivers();
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>