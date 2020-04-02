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
              <?php echo e($data['logSys']->createLog('Visited Online Players Log')); ?>

              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Online Players</h5>
                        </div>
                        <div class="card-body">
                          <?php if(count($data['players']->getPlayersOnline()) > 0): ?>
                            <?php if(count($data['players']->getPlayersCount()) > 0): ?>
                              <?php $__currentLoopData = $data['players']->getPlayersCount(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $online): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="text-center"><?php echo e($online->Light); ?> Light Players Online || <?php echo e($online->Fury); ?> Fury Players Online</p>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Count</th>
                                  <th>Character</th>
                                  <th>Level</th>
                                  <th>Location</th>
                                  <th>PosX</th>
                                  <th>PosY</th>
                                  <th>Faction</th>
                                  <th>User IP</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $data['players']->getPlayersOnline(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($data['players']->count); ?></td>
                                    <td><?php echo e($res->CharName); ?></td>
                                    <td><?php echo e($res->Level); ?></td>
                                    <td><?php echo e($data['user']->getMap($res->Map)); ?></td>
                                    <td><?php echo e($res->PosX); ?></td>
                                    <td><?php echo e($res->PosY); ?></td>
                                    <td><?php echo e($data['user']->getFaction($res->Faction)); ?></td>
                                    <td><?php echo e($res->UserIp); ?></td>
                                  </tr>
                                  <?php
                                    $data['players']->count++
                                  ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            There are currently no players online.
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/playersOnline.blade.php ENDPATH**/ ?>