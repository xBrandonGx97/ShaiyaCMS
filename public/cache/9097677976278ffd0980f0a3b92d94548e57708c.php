<?php $__env->startSection('index', 'editWhItems'); ?>
<?php $__env->startSection('title', 'Edit Warehouse Items'); ?>
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
                          <h5>Warehouse Item Edit</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['item']->charName)): ?>
                              <?php if(count($data['item']->getChar()) > 0): ?>
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-dark">
                                      <thead>
                                        <tr>
                                          <th>CharName</th>
                                          <th>UserID</th>
                                          <th>UserUID</th>
                                          <th>Select</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $__currentLoopData = $data['item']->getChar(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td><?php echo e($res->CharName); ?></td>
                                            <td><?php echo e($res->UserID); ?></td>
                                            <td><?php echo e($res->UserUID); ?></td>
                                            <td><input type="radio" name="UserUID" value="<?php echo e($res->UserUID); ?>"></td>
                                          </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                  <input type="hidden" name="userId" value="<?php echo e($res->UserID); ?>"/>
                                </form>
                              <?php else: ?>
                                Character doesn't exist. Please try again.
                              <?php endif; ?>
                            <?php else: ?>
                              Character name can not be empty.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            <?php if(!empty($data['item']->userUid)): ?>
                              <?php if(count($data['item']->getItems()) > 0): ?>
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>ItemName</th>
                                          <th>Slot</th>
                                          <th>Count</th>
                                          <th>Select</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $__currentLoopData = $data['item']->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td><?php echo e($res->ItemName); ?></td>
                                            <td><?php echo e($res->Slot); ?></td>
                                            <td><?php echo e($res->Count); ?></td>
                                            <td><input type="radio" name="ItemUID" value="<?php echo e($res->ItemUID); ?>"></td>
                                          </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <input type="hidden" name="userId" value="<?php echo e($data['item']->userId); ?>"/>
                                  <input type="hidden" name="UserUID" value="<?php echo e($data['item']->userUid); ?>">
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit3">Submit</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                Could not find any items matching your provided account information.
                              <?php endif; ?>
                            <?php else: ?>
                              You must select an account!
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit3'])): ?>
                            <?php if(count($data['item']->getItemInfo()) > 0): ?>
                              <form method="post">
                                <div class="table-responsive">
                                  <table class="table table-striped">
                                    <?php $__currentLoopData = $data['item']->getItemInfo(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $__currentLoopData = $data['item']->getColumns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <th><?php echo e($value); ?></th>
                                          <?php if(in_array($value, $data['item']->getGreyedColumns())): ?>
                                            <th>
                                              <input type="text" class="form-control" name="<?php echo e($value); ?>" value="<?php echo e($res->$value); ?>" readonly/>
                                            </th>
                                          <?php else: ?>
                                            <?php if($value == 'Enchant'): ?>
                                              <td>
                                                <select class="form-control" name="<?php echo e($value); ?>">
                                                  <option value="00">00</option>
                                                  <?php if(in_array($res->Type, $data['item']->getGearTypes())): ?>
                                                    <?php for($e = 50; $e <= 70; $e++): ?>
                                                      <?php if($e == $res->$value): ?>
                                                        <option value="<?php echo e($e); ?>" selected><?php echo e($e); ?></option>
                                                      <?php else: ?>
                                                        <option value="<?php echo e($e); ?>"><?php echo e($e); ?></option>
                                                      <?php endif; ?>
                                                    <?php endfor; ?>
                                                  <?php else: ?>
                                                    <?php for($a=1;$a <= 20; $a++): ?>
                                                      <?php if($a == $res->$value): ?>
                                                        <option value="<?php echo e($a); ?>" selected><?php echo e($a); ?></option>
                                                      <?php else: ?>
                                                        <option value="<?php echo e($a); ?>"><?php echo e($a); ?></option>
                                                      <?php endif; ?>
                                                    <?php endfor; ?>
                                                  <?php endif; ?>
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
                                <input type="hidden" name="userId" value="<?php echo e($data['item']->userId); ?>"/>
                                <input type="hidden" name="UserUID" value="<?php echo e($data['item']->userUid); ?>">
                                <p class="text-center">
                                  <button type="submit" class="btn btn-sm btn-primary" name="submit4">Submit</button>
                                </p>
                              </form>
                            <?php else: ?>
                              Failed to fetch item data.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit4'])): ?>
                            <?php echo e($data['item']->updateItem()); ?>

                            <br>
                            <?php $__currentLoopData = $data['item']->getItemInfo(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php $__currentLoopData = $data['item']->getColumns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!in_array($value, $data['item']->getGreyedColumns())): ?>
                                  <?php echo e($value); ?> => <?php echo e($data['item']->getNewValue($value)); ?><br>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <p class="text-center">
                              <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to warehouse item edit</button>
                            </p>
                          <?php else: ?>
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Character name" name="charName">
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/player/editWhItems.blade.php ENDPATH**/ ?>