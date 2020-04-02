<?php $__env->startSection('index', 'ipSearch'); ?>
<?php $__env->startSection('title', 'IP Search'); ?>
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
              <?php echo e($data['logSys']->createLog('Visited Account IP Search Page')); ?>

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
                            <?php if(!empty($data['search']->charName)): ?>
                              <?php if(count($data['search']->getCharIp()) > 0): ?>
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-dark" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th>Account Name</th>
                                          <th>UserUID</th>
                                          <th>Select</th>
                                          <th>IP</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php if(count($data['search']->getUsersByIp()) > 0): ?>
                                          <?php $__currentLoopData = $data['search']->getUsersByIp(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                              <td><?php echo e($fet->UserID); ?></td>
                                              <td><?php echo e($fet->UserUID); ?></td>
                                              <td>
                                                <input type="radio" name="CharID" value="<?php echo e($fet->UserUID); ?>">
                                              </td>
                                              <td><?php echo e($fet->UserIp); ?></td>
                                            </tr>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                    <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to account IP Search</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                No accounts found.
                              <?php endif; ?>
                            <?php else: ?>
                              Character name can not be empty.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            <?php if(!empty($data['search']->charID)): ?>
                              <?php if(count($data['search']->getCharFromIpSearch()) > 0): ?>
                                <form method="post">
                                  <div class="table-responsive">
                                    <table class="table table-dark">
                                      <thead>
                                        <tr>
                                          <th>CharName</th>
                                          <th>Slot</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php $__currentLoopData = $data['search']->getCharFromIpSearch(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <td><?php echo e($data->CharName); ?></td>
                                          <td><?php echo e($data->Slot); ?></td>
                                        </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </form>
                                <p class="text-center">
                                  <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to account IP Search</button>
                                </p>
                              <?php else: ?>
                                No characters found.
                              <?php endif; ?>
                            <?php else: ?>
                              Character id can not be empty.
                            <?php endif; ?>
                          <?php else: ?>
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="CharName" placeholder="Character Name" class="form-control">
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/account/ipSearch.blade.php ENDPATH**/ ?>