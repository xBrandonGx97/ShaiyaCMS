<?php
	if(!$data['subpage']){
		/* Media Page Here */
	}elseif($data['subpage']=='gallery'){
		require_once('gallery.php');
	}
?>