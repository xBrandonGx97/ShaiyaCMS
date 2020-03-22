<?php
	# Content
	$this->Tpl->_start_mainSection();
		$this->Tpl->Separator(20);
		$this->Tpl->_do_pageHead("Downloads","Thank you for downloading!");
			$this->Downloads->_get_Downloads();
			$this->Downloads->_get_Patch();
			$this->Downloads->_get_sysRequirements();
			$this->Downloads->_drivers();
		$this->Tpl->_do_pageFooter();
		$this->Tpl->Separator(20);
	$this->Tpl->_end_mainSection();
?>