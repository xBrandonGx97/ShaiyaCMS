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
                          <h5>Delete Player Items</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['item']->userId)): ?>
                              <?php if(count($data['item']->getChar()) > 0): ?>
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>CharName</th>
                                          <th>Select</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $__currentLoopData = $data['item']->getChar(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td><?php echo e($res->CharName); ?></td>
                                            <td><input type="radio" name="CharID" value="<?php echo e($res->CharID); ?>"></td>
                                          </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <input type="hidden" name="userId" value="<?php echo e($data['item']->userId); ?>"/>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                Character doesn't exist. Please try again.
                              <?php endif; ?>
                            <?php else: ?>
                              Character name can not be empty.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            <?php if(!empty($data['item']->charId)): ?>
                              <?php if(count($data['item']->getItems()) > 0): ?>
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>ItemName</th>
                                          <th>Bag</th>
                                          <th>Slot</th>
                                          <th>Count</th>
                                          <th>Select</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $__currentLoopData = $data['item']->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td><?php echo e($res->ItemName); ?></td>
                                            <td><?php echo e($data['item']->getBag($res->Bag)); ?></td>
                                            <td><?php echo e($res->Slot); ?></td>
                                            <td><?php echo e($res->Count); ?></td>
                                            <td><input type="radio" name="ItemUID" value="<?php echo e($res->ItemUID); ?>"></td>
                                          </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <input type="hidden" name="userId" value="<?php echo e($data['item']->userId); ?>"/>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit3">Submit</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                Could not find any items matching your provided character information.
                              <?php endif; ?>
                            <?php else: ?>
                              You must select a character!
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit3'])): ?>
                            <input type="hidden" name="userId" value="<?php echo e($data['item']->userId); ?>"/>
                            <?php echo e($data['item']->deleteItem()); ?>

                          <?php else: ?>
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Character name" name="userId">
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/player/itemDelete.blade.php ENDPATH**/ ?>