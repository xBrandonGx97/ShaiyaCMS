<?php $__env->startSection('index', 'search'); ?>
<?php $__env->startSection('title', 'Account Search'); ?>
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
                          <h5>Account Search</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['edit']->userId)): ?>
                              <?php if(count($data['edit']->getUser()) > 0): ?>
                                Current Status of <?php echo e($data['edit']->userId); ?>:
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <?php $__currentLoopData = $data['edit']->getUser(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $data['edit']->getColumns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <th><?php echo e($value); ?></th>
                                          <?php if(in_array($value, $data['edit']->getGreyedColumns())): ?>
                                            <th>
                                              <input type="text" class="form-control" name="<?php echo e($value); ?>" value="<?php echo e($res->$value); ?>" readonly/>
                                            </th>
                                          <?php else: ?>
                                            <?php if($value == 'AdminLevel'): ?>
                                              <td>
                                                <select class="form-control" name="<?php echo e($value); ?>">
                                                  <?php for($lvl = 0; $lvl <= 255; $lvl++): ?>
                                                    <?php if($lvl == $res->$value): ?>
                                                      <option value="<?php echo e($lvl); ?>" selected><?php echo e($lvl); ?></option>
                                                    <?php else: ?>
                                                      <option value="<?php echo e($lvl); ?>"><?php echo e($lvl); ?></option>
                                                    <?php endif; ?>
                                                  <?php endfor; ?>
                                                </select>
                                              </td>
                                            <?php elseif($value == 'Status'): ?>
                                              <td>
                                                <select class="form-control" name="<?php echo e($value); ?>">
                                                  <?php $__currentLoopData = $data['edit']->getStatuses(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($s == $res->$value): ?>
                                                      <option value="<?php echo e($s); ?>" selected><?php echo e($s); ?></option>
                                                    <?php else: ?>
                                                      <option value="<?php echo e($s); ?>"><?php echo e($s); ?></option>
                                                    <?php endif; ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                              </td>
                                            <?php elseif($value == 'UserType'): ?>
                                              <td>
                                                <select class="form-control" name="<?php echo e($value); ?>">
                                                  <?php $__currentLoopData = $data['edit']->getUserTypes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($t == $res->$value): ?>
                                                      <option value="<?php echo e($t); ?>" selected><?php echo e($t); ?></option>
                                                    <?php else: ?>
                                                      <option value="<?php echo e($t); ?>"><?php echo e($t); ?></option>
                                                    <?php endif; ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                              </td>
                                            <?php else: ?>
                                              <td>
                                                <input type="text" class="form-control" name="<?php echo e($value); ?>" value="<?php echo e($res->$value); ?>"/>
                                              </td>
                                            <?php endif; ?>
                                          <?php endif; ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                  </div>
                                  <input type="hidden" name="userId" value="<?php echo e($data['edit']->userId); ?>">
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                Account not found.
                              <?php endif; ?>
                            <?php else: ?>
                              Account name can not be empty.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            <?php echo e($data['edit']->updateUser()); ?>

                            <br>
                            <?php $__currentLoopData = $data['edit']->getUser(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php $__currentLoopData = $data['edit']->getColumns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!in_array($value, $data['edit']->getGreyedColumns())): ?>
                                  <?php echo e($value); ?> => <?php echo e($data['edit']->getNewValue($value)); ?><br>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <p class="text-center">
                              <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to account edit</button>
                            </p>
                          <?php else: ?>
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <td><input type="text" class="form-control" name="userId" placeholder="Account Name"/></td>
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/account/edit.blade.php ENDPATH**/ ?>