<?php
#	$CharName	=	'[Dev]Velocity';
#	$this->Gift->_get_UserUID($CharName);
#	$this->Gift->_get_MaxSlot($this->Gift->UserUID);

	# Authorization
	$this->User->Auth();
	$this->User->AuthADM();
	
	echo '<pre>';
		echo $this->FileStore->_get_files($this->Style->shop_icons_dir(),'png','table');
		$data = $this->FileStore->output;
#		var_dump($data);
		$this->Arrays->_build($data);
#		echo $this->Data->array_depth($this->FileStore->FileInfo);
#		var_dump($this->FileStore->FileInfo);
		#var_dump($_SESSION);
	#	$this->Readable->get_readable_dir($this->Style->shop_icons_dir());
	#	echo '<div class="f_20">UserUID: '.$this->Gift->UserUID.'</div>';
	#	echo '<div class="f_20">Slot Count: '.$this->Gift->Slot.'</div>';
	#	echo '<div class="f_20">Max Slot Count: '.$this->Gift->MaxSlot.'</div>';

	#	$this->Gift->_do_Gift_All('120001','1');
	echo '</pre>';
?>