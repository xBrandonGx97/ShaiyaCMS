<?php $__env->startSection('index', 'restore'); ?>
<?php $__env->startSection('title', 'Restore Character'); ?>
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
                          <h5>Resurrect A Character</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['restore']->userID)): ?>
                              <?php if(count($data['restore']->getDeadChars()) > 0): ?>
                                <form method="post">
                                  <span>Select Character To Resurrect :</span>
                                  <input type="hidden" name="username" value="<?php echo e($data['restore']->userID); ?>">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>Select</th>
                                        <th>CharName</th>
                                        <th>Class</th>
                                        <th>Level</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php $__currentLoopData = $data['restore']->getDeadChars(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($res->Country == 0): ?>
                                          <?php if($res->Family == 0 || $res->Family == 1): ?>
                                            <tr>
                                              <td>
                                                <input type="radio" name ="char" value="<?php echo e($res->CharName); ?>,<?php echo e($res->CharID); ?>">
                                              </td>
                                              <td><?php echo e($res->CharName); ?></td>
                                              <td><?php echo e($data['user']->getClass($res->Country,$res->Job)); ?></td>
                                              <td><?php echo e($res->Level); ?></td>
                                            </tr>
                                          <?php endif; ?>
                                        <?php elseif($res->Country == 1): ?>
                                          <?php if($res->Family == 2 || $res->Family == 3): ?>
                                            <tr>
                                              <td>
                                                <input type="radio" name ="char" value="<?php echo e($res->CharName); ?>,<?php echo e($res->CharID); ?>">
                                              </td>
                                              <td><?php echo e($res->CharName); ?></td>
                                              <td><?php echo e($data['user']->getClass($res->Country,$res->Job)); ?></td>
                                              <td><?php echo e($res->Level); ?></td>
                                            </tr>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                  </table>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                Account does not contain any dead chars.
                              <?php endif; ?>
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            <?php if($data['restore']->getSlot()[0]->OpenSlot > -1 && $data['restore']->getSlot()[0]->OpenSlot < 5): ?>
                              <?php echo e($data['restore']->updateRestore()); ?>

                            <?php else: ?>
                              No slots available.
                            <?php endif; ?>
                          <?php else: ?>
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Advanced search" name="userId">
                              </div>
                              <p class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                              </p>
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/player/restore.blade.php ENDPATH**/ ?>