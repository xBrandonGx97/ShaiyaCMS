<?php
	# Content
	$this->Tpl->_start_mainSection();
		$this->Tpl->Separator(20);
		$this->Tpl->_do_pageHead("About","Server Information");
			echo 'Server Information Here';
		$this->Tpl->_do_pageFooter();
		$this->Tpl->Separator(20);
	$this->Tpl->_end_mainSection();
?>