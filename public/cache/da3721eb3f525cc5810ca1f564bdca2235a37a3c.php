<form class="send_gift_verify" id="send_gift_verify">
  <div class="alert alert-danger">
    <i class="fa fa-exclamation-triangle"></i>
    Are you sure you want to send <b><?php echo e($data['gift']->getItemNameFromId($data['postChecks']['itemId'])); ?></b> x<b><?php echo e($data['postChecks']['itemCount']); ?></b> to <?php echo e($data['postChecks']['char']); ?>?
  </div>
  <input name="CharName" type="hidden" value="<?php echo e($data['postChecks']['char']); ?>"/>
  <input name="ItemID" type="hidden" value="<?php echo e($data['postChecks']['itemId']); ?>"/>
  <input name="ItemCount" type="hidden" value="<?php echo e($data['postChecks']['itemCount']); ?>"/>
  <div class="text-center fs_20">
    <button type="button" class="btn btn-sm btn-primary submit_d" id="send_gift_verify_submit">
      <i class="fa fa-check-circle"></i>
      Send Gift
    </button>
  </div>
</form>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/fetchApi/player/verifySendGiftPlayer.blade.php ENDPATH**/ ?>