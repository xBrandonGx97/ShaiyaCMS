<?php $__env->startSection('index', 'dashboard'); ?>
<?php $__env->startSection('title', 'Dashboard'); ?>
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
              <?php echo e($data['logSys']->createLog('Visited World Chat Log')); ?>

              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Find Players Within A Guild</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['guild']->guildName)): ?>
                              <?php if(count($data['guild']->getGuildData()) > 0): ?>
                                Characters Found in Guild <?php echo e($data['guild']->guildName); ?>:
                                <table class="table table-striped" id="guildSearch">
                                  <thead>
                                    <tr>
                                      <th>Guild Name</th>
                                      <th>Rank</th>
                                      <th>Character Name</th>
                                      <th>Join Date</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php $__currentLoopData = $data['guild']->getGuildData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td><?php echo e($res->GuildName); ?></td>
                                      <td><?php echo e($res->GuildLevel); ?></td>
                                      <td><?php echo e($res->CharName); ?></td>
                                      <td><?php echo e(date('m/d/Y g:i:s A', strtotime($res->JoinDate))); ?></td>
                                    </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                                <p class="text-center">
                                  <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to guild Search</button>
                                </p>
                              <?php else: ?>
                                No guild matching your criteria was found.
                              <?php endif; ?>
                            <?php else: ?>
                              Guild name can not be empty.
                            <?php endif; ?>
                          <?php else: ?>
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <input type="text" name="Guild" class="form-control" placeholder="Guild Name"/>
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
  <script>
	$(document).ready(function(){
	  $('#guildSearch').dataTable({
      "searching": false,
		  "info": false,
			"bLengthChange": false,
			"pageLength": 10,
    });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/guildSearch.blade.php ENDPATH**/ ?>