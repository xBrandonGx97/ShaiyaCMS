<?php if(isset($_POST['submit'])): ?>
  <?php if(empty($data['postChecks']['char'])): ?>
    <?php echo e($data['gift']->setError('You must enter a character name to send the gift to.')); ?>

  <?php elseif(empty($data['postChecks']['itemId'])): ?>
    <?php echo e($data['gift']->setError('ItemID empty')); ?>

  <?php elseif(empty($data['postChecks']['itemCount'])): ?>
    <?php echo e($data['gift']->setError('ItemCount empty.')); ?>

  <?php elseif(!is_numeric($data['postChecks']['itemId'])): ?>
    <?php echo e($data['gift']->setError('ItemID must be a number.')); ?>

  <?php elseif(strlen($data['postChecks']['itemId']) > 6): ?>
    <?php echo e($data['gift']->setError('ItemID length is too long.')); ?>

  <?php elseif(!is_numeric($data['postChecks']['itemCount'])): ?>
    <?php echo e($data['gift']->setError('ItemCount must be a number.')); ?>

  <?php elseif($data['postChecks']['itemCount'] > 255): ?>
    <?php echo e($data['gift']->setError('ItemCount cannot be greater than 255.')); ?>

  <?php elseif(count($data['gift']->verifyChar()) < 1): ?>
    <?php echo e($data['gift']->setError('Character doesn\'t exist.')); ?>

  <?php endif; ?>
  <?php if(count($data['gift']->getErrors())==0): ?>

    <?php echo e($data['gift']->setFormComplete()); ?>

    <?php echo $__env->make('pages.ap.fetchApi.player.verifySendGiftPlayer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php endif; ?>
<?php if(count($data['gift']->getErrors())): ?>
  <ul>
    <?php $__currentLoopData = $data['gift']->getErrors(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
<?php endif; ?>
<?php if($data['gift']->getFormComplete() === 0): ?>
<form class="send_gift" id="send_gift">
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" name="CharName" placeholder="Character Name" class="form-control"/>
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" name="ItemID" placeholder="ItemID" class="form-control"/>
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" name="ItemCount" placeholder="Amount" class="form-control"/>
  </div>
  <p class="text-center">
    <button type="button" class="btn btn-sm btn-primary submit_c" id="sendGiftModal">
      Verify Gift
      <i class="fas fa-paper-plane"></i>
    </button>
  </p>
</form>
<?php endif; ?>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/fetchApi/player/sendGiftPlayer.blade.php ENDPATH**/ ?>