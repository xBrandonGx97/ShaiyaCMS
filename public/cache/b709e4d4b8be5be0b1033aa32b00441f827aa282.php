<?php $__env->startSection('index', 'sendPlayerNotice'); ?>
<?php $__env->startSection('title', 'Send Player Notice'); ?>
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
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Send Player Notice</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if($data['sE']->sendPlayerNotice($data['sE']->noticeChar, $data['sE']->notice)): ?>
                              <?php echo e($data['logSys']->createLog('Sent a player notice: '.$data['sE']->noticeChar . ' - ' . $data['sE']->notice)); ?>

                              <p class="fs_18">
                                Player notice sent to: <?php echo e($data['sE']->noticeChar . ' - ' . $data['sE']->notice); ?>

                              </p>
                            <?php else: ?>
                              Could not send notice to player: Character doesn't exist.
                            <?php endif; ?>
                          <?php else: ?>
                            <form class="form-inline" method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="noticeChar" placeholder="Character Name" class="form-control text-center">
                                <input type="text" name="notice" placeholder="Notice Message" class="form-control text-center m_l_5">
                              </div>
                              <button type="submit" class="btn btn-sm btn-primary text-center" name="submit">Submit</button>
                            </form>
                          <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/SExtended/sendPlayerNotice.blade.php ENDPATH**/ ?>