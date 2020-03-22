<?php
	# Content
	Template::_start_mainSection();
	echo '<h3 class="float-left u">News</h3>';
		Template::Separator(20);
			SQL::LOAD_NEWS();
		Template::Separator(20);
	Template::_end_mainSection();
?>