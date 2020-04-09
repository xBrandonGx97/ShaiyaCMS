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
                          <h5>Disband Guild</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['guild']->guildName)): ?>
                              <?php if(count($data['guild']->checkGuild()) > 0): ?>
                                  <form method="post">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>GuildName</th>
                                          <th>Select</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php $__currentLoopData = $data['guild']->checkGuild(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td><?php echo e($res->GuildName); ?></td>
                                            <td><input type="radio" name="GuildID" value="<?php echo e($res->GuildID); ?>"></td>
                                          </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </tbody>
                                    </table>
                                    <p class="text-center">
                                      <button type="submit" class="btn btn-sm btn-primary" name="submit2">Submit</button>
                                    </p>
                                  </form>
                              <?php else: ?>
                                Could not find a guild matching your search query.
                                <br>
                                Make sure the guild is not already deleted.
                              <?php endif; ?>
                            <?php else: ?>
                              Guild name can not be empty.
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit2'])): ?>
                            <?php if(!empty($data['guild']->guildId)): ?>
                              <?php if(count($data['guild']->getGuildData()) > 0): ?>
                                <form method="post">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>GuildID</th>
                                        <th>GuildName</th>
                                        <th>MasterUserID</th>
                                        <th>MasterName</th>
                                        <th>Country</th>
                                        <th>Select</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php $__currentLoopData = $data['guild']->getGuildData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <td><?php echo e($res->GuildID); ?></td>
                                          <td><?php echo e($res->GuildName); ?></td>
                                          <td><?php echo e($res->MasterUserID); ?></td>
                                          <td><?php echo e($res->MasterName); ?></td>
                                          <td><?php echo e($res->Country); ?></td>
                                          <td><input type="radio" name="GuildID" value="<?php echo e($res->GuildID); ?>"></td>
                                        </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                  </table>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit3">Submit</button>
                                  </p>
                                </form>
                              <?php else: ?>
                                Search returned no results.
                              <?php endif; ?>
                            <?php else: ?>
                              You didn't select a guild!
                            <?php endif; ?>
                          <?php elseif(isset($_POST['submit3'])): ?>
                            <form method="post">
                              <div class="table-responsive">
                                <table class="table table-striped">
                                  <?php $__currentLoopData = $data['guild']->getGuildData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $data['guild']->getColumns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                        <th><?php echo e($value); ?></th>
                                        <th>
                                          <input type="text" class="form-control" name="<?php echo e($value); ?>" value="<?php echo e($res->$value); ?>" readonly/>
                                        </th>
                                      </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                              </div>
                              <p class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary" name="submit4">Disband Guild</button>
                              </p>
                            </form>
                          <?php elseif(isset($_POST['submit4'])): ?>
                            <?php echo e($data['guild']->disbandGuild()); ?>

                            <p class="text-center">
                              <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to disband guild</button>
                            </p>
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/disbandGuild.blade.php ENDPATH**/ ?>