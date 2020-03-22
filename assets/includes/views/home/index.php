<?php
	Template::_start_mainSection();
		echo '<h3 class="text-center u">News & Announcements</h3>';
		Template::Separator(20);
		SQL::LOAD_HP();
	Template::_end_mainSection();
?>