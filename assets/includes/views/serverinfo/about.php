<?php
	# Content
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("About","Server Information");
			echo 'Server Information Here';
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>