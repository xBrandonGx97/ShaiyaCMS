<?php
	$this->Tpl->_do_pageHead("Boss Records","Boss Record Respawn Times");
		echo $this->BossRecord->get_Record();
	$this->Tpl->_do_pageFooter();
?>