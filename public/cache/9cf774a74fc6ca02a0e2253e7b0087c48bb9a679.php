<?php $__env->startSection('index', 'dashboard'); ?>
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('zone', 'AP'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.ap.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('partials.ap.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          
          <?php if($data['user']->isAuthorized()): ?>
            
            <?php if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA()): ?>
              <?php echo e($data['logSys']->createLog('Visited DP Handout Page')); ?>

              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>DP Handout</h5>
                        </div>
                        <div class="card-body">
                          <form method="post">
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="UserID" placeholder="Char Name" class="form-control tac b_i"/>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="DP" placeholder="DP Amount" class="form-control tac b_i" style="margin-left:5px !important"/>
                            </div>
                            <input type="submit" class="btn btn-sm btn-primary m_auto" style="margin-left:5px !important;" value="Submit" name="submit" />
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <?php echo e(redirect('/admin/auth/login')); ?>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(function(){
	  $('#AccessLogs').dataTable({
		  "searching": false,
			"info": false,
			"bLengthChange": false
    });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/account/dpHandout.blade.php ENDPATH**/ ?>