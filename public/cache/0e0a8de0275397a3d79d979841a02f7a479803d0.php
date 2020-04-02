<div class="col-md-6 col-xl-3">
  <div class="card daily-sales">
    <div class="card-block">
      <h6 class="mb-4">Total Accounts</h6>
      <div class="row d-flex align-items-center">
        <div class="col-9">
          <h3 class="f-w-300 d-flex align-items-center m-b-0" id="totalAccounts">
            <i class="fas fa-fw fa-search-plus text-c-green f-30 m-r-10"></i>
            <?php echo e($data['panels']['totalAccounts']); ?>

          </h3>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#totalAccounts").load(window.location.href + " #totalAccounts" )
}, 60000);
</script>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/ap/panels/totalAccounts.blade.php ENDPATH**/ ?>