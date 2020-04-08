<?php $__env->startSection('index', 'guildLeaderChange'); ?>
<?php $__env->startSection('title', 'Guild Leader Change'); ?>
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
                          <h5>Guild Leader Change</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['guild']->guildName)): ?>
                              <?php if(count($data['guild']->getGuildData()) > 0): ?>
                                <form method="post">
                                  Select New Leader:
                                  <input type="hidden" name="guild" value="<?php echo e($data['guild']->guildName); ?>">
                                  <div class="form-group mx-sm-3 mb-2">
                                    <select name="newlead" class="form-control" width="100" style="width:100%">
                                      <?php $__currentLoopData = $data['guild']->getGuildData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($res->UserUID. ',' . $res->UserID. ',' . $res->CharName. ',' . $res->CharID); ?>"><?php echo e($res->CharName); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <input type="hidden" name="guild-id" value="<?php echo e($res->GuildID); ?>">
                                      <input type="hidden" name="oldlead" value="<?php echo e($res->MasterName); ?>">
                                    </select>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                No guild matching your criteria was found or there are no officers in your guild.
                              <?php endif; ?>
                            <?php else: ?>
                              Guild name can not be empty.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            Guild = <?php echo e($data['guild']->guildName); ?><br>
                            Old Leader = <?php echo e($data['guild']->oldGuildLeader); ?><br>
                            New Leader = <?php echo e($data['guild']->newGuildLeader[2]); ?>

                            <?php echo e($data['guild']->runGuildLeaderChange()); ?>

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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/guildLeaderChange.blade.php ENDPATH**/ ?>