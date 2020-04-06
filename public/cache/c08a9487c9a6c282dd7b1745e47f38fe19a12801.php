<?php $__env->startSection('index', 'jail'); ?>
<?php $__env->startSection('title', 'Jail Player'); ?>
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
                          <h5>Edit Player</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['edit']->userId)): ?>
                              <?php if(count($data['edit']->getUser()) > 0): ?>
                                <?php if($data['edit']->getLoginStatus() === 1): ?>
                                  Current Status of <?php echo e($data['edit']->userId); ?>: <span style="color: lime;">Online</span>
                                <?php else: ?>
                                  Current Status of <?php echo e($data['edit']->userId); ?>: <span style="color: red;">Offline</span>
                                <?php endif; ?>
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Value</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $__currentLoopData = $data['edit']->getUser(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php $__currentLoopData = $data['edit']->getColumns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                              <td><?php echo e($data['edit']->getCount()); ?></td>
                                              <td><?php echo e($value); ?></td>
                                              <?php if(in_array($value, $data['edit']->getGreyedColumns())): ?>
                                                <td>
                                                  <input type="text" class="form-control" name="<?php echo e($value); ?>" value="<?php echo e($res->$value); ?>" readonly/>
                                                </td>
                                              <?php else: ?>
                                                <td>
                                                  <input type="text" class="form-control" name="<?php echo e($value); ?>" value="<?php echo e($res->$value); ?>"/>
                                                </td>
                                              <?php endif; ?>
                                            </tr>
                                            <?php echo e($data['edit']->updateCount()); ?>

                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                  <input type="hidden" name="userId" value="<?php echo e($data['edit']->userId); ?>"/>
                                </form>
                              <?php else: ?>
                                Character doesn't exist. Please try again.
                              <?php endif; ?>
                            <?php else: ?>
                              Character name can not be empty.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            <?php $__currentLoopData = $data['edit']->getUser(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php $__currentLoopData = $data['edit']->getColumns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!in_array($value, $data['edit']->getGreyedColumns())): ?>
                                  <?php echo e($data['edit']->updateColumns($value, $data['edit']->getNewValue($value))); ?>

                                  <?php echo e($value); ?> => <?php echo e($data['edit']->getNewValue($value)); ?><br>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <p class="text-center">
                              <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to Edit Player</button>
                            </p>
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/player/edit.blade.php ENDPATH**/ ?>