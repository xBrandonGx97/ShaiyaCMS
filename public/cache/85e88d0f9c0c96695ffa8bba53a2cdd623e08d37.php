<?php $__env->startSection('index', 'bannedUsers'); ?>
<?php $__env->startSection('title', 'Banned Users'); ?>
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
              <?php echo e($data['logSys']->createLog('Visited Banned Users Page')); ?>

              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Banned Accounts</h5>
                        </div>
                        <div class="card-body">
                          <?php if(count($data['banned']->getBannedUsers()) > 0): ?>
                            <table class="table table-dark">
                              <thead>
                                <tr>
                                  <th>CharName</th>
                                  <th>Reason</th>
                                  <th>Duration</th>
                                  <th>Banned By</th>
                                  <th>Date</th>
                                  <th>Unban Date</th>
                                  <th>Ban Status</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php $__currentLoopData = $data['banned']->getBannedUsers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td><?php echo e($data['data']->purify($res->CharName)); ?></td>
                                  <td><?php echo e($data['data']->purify($res->Reason)); ?></td>
                                  <td><?php echo e($res->Duration); ?></td>
                                  <td><?php echo e($res->BannedBy); ?></td>
                                  <td><?php echo e(date("d/m/Y g:i:s A", strtotime($res->BanDate))); ?></td>

                                  <?php if($res->Duration === 'permanent'): ?>
                                    <td>&infin;</td>
                                    <td>&#10006;</td>
                                  <?php elseif(time() >= strtotime('+'.str_replace('s', '', $res->Duration), strtotime($res->BanDate))): ?>
                                    <td><?php echo e(date("d/m/Y g:i:s A", strtotime('+'.str_replace('s', '', $res->Duration), strtotime($res->BanDate)))); ?></td>
                                    <td>&#10003;</td>
                                  <?php else: ?>
                                    <td><?php echo e(date("d/m/Y g:i:s A", strtotime('+'.str_replace('s', '', $res->Duration), strtotime($res->BanDate)))); ?></td>
                                    <td>&#10006;</td>
                                  <?php endif; ?>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                There are currently no banned users.
                              </tbody>
                            </table>
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/account/bannedUsers.blade.php ENDPATH**/ ?>