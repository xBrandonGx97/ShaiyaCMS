<div class="col-md-6 col-xl-3">
  <div class="card daily-sales">
    <div class="card-block">
      <h6 class="mb-4">Online (Live)</h6>
      <div class="row d-flex align-items-center">
        <div class="col-9">
          <h3 class="f-w-300 d-flex align-items-center m-b-0" id="onlineCurrent">
            <i class="fas fa-fw fa-globe text-c-green f-30 m-r-10"></i>
            <?php echo e($data['panels']->getOnlineCurrent()); ?>

          </h3>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#onlineCurrent").load(window.location.href + " #onlineCurrent" )
}, 60000);
</script>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/ap/panels/onlineCurrent.blade.php ENDPATH**/ ?>