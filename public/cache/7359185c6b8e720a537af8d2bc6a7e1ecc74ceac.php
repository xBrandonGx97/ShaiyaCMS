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
              <?php echo e($data['logSys']->createLog('Visited Ban User Page')); ?>

              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Account Ban</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(count($data['ban']->getUserUID()) > 0): ?>
                              <?php if(count($data['ban']->checkIfBanned()) < 1): ?>
                                <?php if(!empty($data['ban']->checkErrors())): ?>
                                  Errors found. Please make sure you filled out all form inputs.
                                <?php else: ?>
                                  <?php echo e($data['ban']->setUserToBanned()); ?>

                                <?php endif; ?>
                              <?php else: ?>
                                Character is already banned.
                              <?php endif; ?>
                            <?php else: ?>
                              Character not found.
                            <?php endif; ?>
                          <?php endif; ?>
                          <form method="post">
                            <div class="form-group mx-sm-3 mb-2">
                              Character:
                              <input type="text" class="form-control" name="CharName" placeholder="Character Name"/>
                              <?php Separator(20) ?>
                              <textarea class="form-control" name="Reason" cols="50" rows="10" placeholder="Reason/Infraction"></textarea>
                              <?php Separator(10) ?>
                              Ban Length:
                              <select name="Length" class="form-control" style="width:auto;">
                                <option value="12 hours">12 Hours</option>
                                <option value="5 days">5 Days</option>
                                <option value="2 weeks">2 Weeks</option>
                                <option value="permanent">Permanent</option>
                              </select>
                            </div>
                            <p class="text-center">
                              <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                            </p>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/account/ban.blade.php ENDPATH**/ ?>