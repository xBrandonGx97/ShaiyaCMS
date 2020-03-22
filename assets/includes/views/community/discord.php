<?php
	# Content
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("Community Discord");
			echo '<div class="discord">';
				echo '<h5 class="text-center">Content here</h5>';
			echo '</div>';
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>