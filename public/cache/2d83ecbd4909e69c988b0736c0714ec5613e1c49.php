<?php
    list($Discord,$DisplayName) = explode("~",$_POST["id"]);
?>
<div class="discord_popup">
    <i class="fab fa-discord"></i> <?php echo e($DisplayName); ?>

    <p>Discord Handle: <span class="handle"><?php echo e($Discord); ?></span></p>
</div>