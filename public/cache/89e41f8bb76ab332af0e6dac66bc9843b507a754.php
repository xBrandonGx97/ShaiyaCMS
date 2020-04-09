<?php $__env->startSection('index', 'playersOnline'); ?>
<?php $__env->startSection('title', 'Players Online'); ?>
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
                          <h5>Possible Stat Padders</h5>
                        </div>
                        <div class="card-body">
                          <?php if(count($data['stat']->getStatPadders()) > 0): ?>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Killer's Toon</th>
                                    <th>Killer's IP</th>
                                    <th>Killer's ID</th>
                                    <th>Times Killed</th>
                                    <th>Dead Toon</th>
                                    <th>Dead Toon's IP</th>
                                    <th>Dead Toon's ID</th>
                                    <th>Date</th>
                                    <th>Map</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $data['stat']->getStatPadders(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td><?php echo e($res->KillerToon); ?></td>
                                      <td><?php echo e($res->KillerIP); ?></td>
                                      <td><?php echo e($res->KillerID); ?></td>
                                      <td><?php echo e($res->TimesKilled); ?></td>
                                      <td><?php echo e($res->DeadToon); ?></td>
                                      <td><?php echo e($res->DeadIP); ?></td>
                                      <td><?php echo e($res->DeadID); ?></td>
                                      <td><?php echo e(date("M d, Y H:i:s A", strtotime($res->Date))); ?></td>
                                      <td><?php echo e($data['user']->getMap($res->Map)); ?></td>
                                    </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                              </table>
                            </div>
                          <?php else: ?>
                            No possible stat padders have been found.
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/statPadders.blade.php ENDPATH**/ ?>