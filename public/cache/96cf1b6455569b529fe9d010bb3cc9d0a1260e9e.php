<?php $__env->startSection('index', 'manageGuilds'); ?>
<?php $__env->startSection('title', 'Manage Guilds'); ?>
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
                          <h5>Manage Guilds</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php echo $data['guild']->updateGuild(); ?>

                          <?php endif; ?>
                          <?php if(count($data['guild']->getGuildData()) > 0): ?>
                            <table class="table table-striped" id="guilds">
                              <thead>
                                <tr>
                                  <th>Rank</th>
                                  <th>GuildName</th>
                                  <th>Master</th>
                                  <th>Faction</th>
                                  <th>GuildPoint</th>
                                  <th>GuildHouse</th>
                                  <th>Etin</th>
                                  <th>Remark</th>
                                  <th>CreateDate</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $data['guild']->getGuildData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <form method="post">
                                    <tr>
                                      <td><?php echo e($res->Rank); ?></td>
                                      <td>
                                        <input type="text" class="form-control" name="guildName" value="<?php echo e($res->GuildName); ?>"/>
                                      </td>
                                      <td>
                                        <select name="guildMaster" class="form-control">
                                          <?php $__currentLoopData = $data['guild']->getGuildCharsByGuild($res->GuildID); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chars): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($chars->UserID); ?>,<?php echo e($chars->CharID); ?>,<?php echo e($chars->CharName); ?>">[<?php echo e($chars->GuildLevel); ?>]<?php echo e($chars->CharName); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                      </td>
                                      <td><?php echo e($data['user']->getFaction($res->Country)); ?></td>
                                      <td><?php echo e($res->GuildPoint); ?></td>
                                      <td>
                                        <input type="text" class="form-control" name="guildHouse" value="<?php echo e($res->BuyHouse); ?>"/>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="guildEtin" value="<?php echo e($res->Etin); ?>"/>
                                      </td>
                                      <td><textarea class="form-control" name="remark"><?php echo e($res->Remark); ?></textarea></td>
                                      <td><?php echo e(date("M d, Y", strtotime($res->CreateDate))); ?></td>
                                      <td>
                                        <button type="submit" class="btn btn-sm btn-primary" name="submit" value="<?php echo e($res->GuildID); ?>">
                                          Update
                                        </button>
                                      </td>
                                    </tr>
                                  </form>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            There are no guilds to display.
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
  <script>
	$(document).ready(function(){
	  $('#guilds').dataTable({
      "searching": false,
		  "info": false,
			"bLengthChange": false,
			"pageLength": 10,
    });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/manageGuilds.blade.php ENDPATH**/ ?>