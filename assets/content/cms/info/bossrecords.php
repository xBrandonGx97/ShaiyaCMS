<?php
	$this->Tpl->_start_mainSection();
		$this->Tpl->Separator(20);
		$this->Tpl->_do_pageHead("Boss Records","Boss Record Respawn Times");
			echo $this->BossRecord->get_Record();
		$this->Tpl->_do_pageFooter();
		$this->Tpl->Separator(20);
	$this->Tpl->_end_mainSection();
?>