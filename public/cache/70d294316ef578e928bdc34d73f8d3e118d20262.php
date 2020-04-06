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
                          <h5>View Gear Links of Character</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['player']->userId)): ?>
                              <?php if(count($data['player']->getItems()) > 0): ?>
                                <span>Current Links In Equipped Gear Of: <?php echo e($data['player']->userId); ?></span>
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>ItemName</th>
                                      <th>ItemUID</th>
                                      <th>Lapis Slot 1</th>
                                      <th>Lapis Slot 2</th>
                                      <th>Lapis Slot 3</th>
                                      <th>Lapis Slot 4</th>
                                      <th>Lapis Slot 5</th>
                                      <th>Lapis Slot 6</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__currentLoopData = $data['player']->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                        <td><?php echo e($res->ItemName); ?></td>
                                        <td><?php echo e($res->ItemUID); ?></td>
                                        <td>
                                          <?php echo e((int)$res->Gem1 !== 0 ? $data['player']->lapisIdToName($res->Gem1) : 'Empty Slot'); ?>

                                        </td>
                                        <td>
                                          <?php echo e((int)$res->Gem2 !== 0 ? $data['player']->lapisIdToName($res->Gem2) : 'Empty Slot'); ?>

                                        </td>
                                        <td>
                                          <?php echo e((int)$res->Gem3 !== 0 ? $data['player']->lapisIdToName($res->Gem3) : 'Empty Slot'); ?>

                                        </td>
                                        <td>
                                          <?php echo e((int)$res->Gem4 !== 0 ? $data['player']->lapisIdToName($res->Gem4) : 'Empty Slot'); ?>

                                        </td>
                                        <td>
                                          <?php echo e((int)$res->Gem5 !== 0 ? $data['player']->lapisIdToName($res->Gem5) : 'Empty Slot'); ?>

                                        </td>
                                        <td>
                                          <?php echo e((int)$res->Gem6 !== 0 ? $data['player']->lapisIdToName($res->Gem6) : 'Empty Slot'); ?>

                                        </td>
                                      </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                                <p class="text-center">
                                  <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to Linked Gear</button>
                                </p>
                              <?php else: ?>
                                Character doesn't exist. Please try again.
                              <?php endif; ?>
                            <?php else: ?>
                              Character name can not be empty.
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/player/linkedGear.blade.php ENDPATH**/ ?>