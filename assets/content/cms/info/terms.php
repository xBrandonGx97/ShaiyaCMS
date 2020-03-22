<?php
	# Content
	$this->Tpl->_start_mainSection();
		$this->Tpl->Separator(20);
		$this->Tpl->_do_pageHead("Terms of Service","Last Updated: December 23rd, 2018.");
			echo '<div class="tos">';
				echo '<h5 class="text-center">Official Rules here..</h5>';
			echo '</div>';
		$this->Tpl->_do_pageFooter();
		$this->Tpl->Separator(20);
	$this->Tpl->_end_mainSection();
?>