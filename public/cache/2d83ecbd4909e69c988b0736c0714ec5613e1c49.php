<?php
    $content = trim(file_get_contents("php://input"));
	$decoded = json_decode($content, true);
	if(is_array($decoded)) {
	    if(isset($decoded['id'])){
		    list($Discord,$DisplayName) = explode("~",$decoded["id"]);
		}
	}
?>
<div class="discord_popup">
    <i class="fab fa-discord"></i> <?php echo e($DisplayName); ?>

    <p>Discord Handle: <span class="handle"><?php echo e($Discord); ?></span></p>
</div>
