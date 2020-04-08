<?php $__env->startSection('index', 'commandLogs'); ?>
<?php $__env->startSection('title', 'GM Command Logs'); ?>
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
              <?php echo e($data['logSys']->createLog('Visited Command Logs Page')); ?>

              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>GM Commands Log</h5>
                        </div>
                        <div class="card-body table-responsive">
                          <table class="table table-striped" id="GmLogs">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>CharName</th>
                                <th>Map</th>
                                <th>PosX</th>
                                <th>PosY</th>
                                <th>Command</th>
                                <th>Player Affected</th>
                                <th>Command Result</th>
                                <th>Usage Date</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(count($data['commandLogs']->getCommandLogs()) > 0): ?>
                                <?php $__currentLoopData = $data['commandLogs']->getCommandLogs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($data['commandLogs']->count); ?></td>
                                    <td><?php echo e($logs->CharName); ?></td>
                                    <td><?php echo e($data['user']->getMap($logs->MapID)); ?></td>
                                    <td><?php echo e($logs->PosX); ?></td>
                                    <td><?php echo e($logs->PosY); ?></td>
                                    <td><?php echo e($logs->Command); ?></td>
                                    <td><?php echo e($logs->PlayerAffected); ?></td>
                                    <td><?php echo e($logs->CommandResult); ?></td>
                                    <td><?php echo e(date("m/d/y H:i A", strtotime($logs->ActionTime))); ?></td>
                                  </tr>
                                  <?php
                                    $data['commandLogs']->count++
                                  ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php else: ?>
                                There are currently no logs listed in the database.
                              <?php endif; ?>
                            </tbody>
                          </table>
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
      $('#GmLogs').dataTable({
        "searching": false,
        "info": false,
        "bLengthChange": false
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/admin/commandLogs.blade.php ENDPATH**/ ?>