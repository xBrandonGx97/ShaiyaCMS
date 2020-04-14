<?php echo e($data['gift']->sendMassGift()); ?>

<?php if($data['gift']->getGiftState() === true): ?>
  <div class="alert alert-success">
    <i class="fas fa-check-circle"></i>
    Gift (<b><?php echo e($data['gift']->getItemNameFromId($data['gift']->itemId)); ?></b> x<b><?php echo e($data['gift']->itemCount); ?></b>) sucessfully delivered to all players<br>
  </div>
<?php else: ?>
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-triangle"></i>
    Gift failed to send.
  </div>
<?php endif; ?>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/fetchApi/player/submitSendGiftAll.blade.php ENDPATH**/ ?>