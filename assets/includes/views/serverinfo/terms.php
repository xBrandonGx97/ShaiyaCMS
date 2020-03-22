<?php
	# Content
	Template::_start_mainSection();
		Template::Separator(20);
		Template::_do_pageHead("Terms of Service","Last Updated: December 23rd, 2018.");
			echo '<div class="tos">';
				echo '<h5 class="text-center">Official Rules here..</h5>';
			echo '</div>';
		Template::_do_pageFooter();
		Template::Separator(20);
	Template::_end_mainSection();
?>