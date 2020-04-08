<?php $__env->startSection('index', 'guildNameChange'); ?>
<?php $__env->startSection('title', 'Guild Name Change'); ?>
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
                          <h5>Guild Name Change</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['guild']->guildName)): ?>
                              <?php if(count($data['guild']->getGuildData()) > 0): ?>
                                <form method="post">
                                  <input type="hidden" name="guild" value="<?php echo e($data['guild']->guildName); ?>">
                                  <?php $__currentLoopData = $data['guild']->getGuildData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="hidden" name="guild-id" value="<?php echo e($res->GuildID); ?>">
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" name="newname" placeholder="New Guild Name" class="form-control"/>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                No guild matching your criteria was found.
                              <?php endif; ?>
                            <?php else: ?>
                              Guild name can not be empty.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            <?php if(!empty($data['guild']->newGuildName) || $data['guild']->newGuildName !== ''): ?>
                              Guild = <?php echo e($data['guild']->guildName); ?><br />
                              New Guild Name = <?php echo e($data['guild']->newGuildName); ?>

                              <?php echo e($data['guild']->updateGuildName()); ?>

                            <?php else: ?>
                              New guild name can not be empty.
                            <?php endif; ?>
                          <?php else: ?>
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Guild Name" name="guild"/>
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/guildNameChange.blade.php ENDPATH**/ ?>