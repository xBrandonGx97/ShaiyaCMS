<?php $__env->startSection('index', 'mobList'); ?>
<?php $__env->startSection('title', 'Mob List'); ?>
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
                          <h5>Mob List</h5>
                        </div>
                        <div class="card-body">
                          <table class="table table-sm table-striped" id="MobList">
                            <thead>
                              <tr>
                                <th>MobID</th>
                                <th>Mob Name</th>
                                <th>Mob Ele</th>
                                <th>Mob Lvl</th>
                                <th>Mob HP</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(count($data['mobs']->getMobs()) > 0): ?>
                                <?php $__currentLoopData = $data['mobs']->getMobs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($res->MobID); ?></td>
                                    <td><?php echo e($res->MobName); ?></td>
                                    <td><img src="/resources/themes/core/images/dropfinder/ele_<?php echo e($res->Attrib); ?>.png"></td>
                                    <td><?php echo e($res->Level); ?></td>
                                    <td><?php echo e($res->HP); ?></td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                            </tbody>
                          </table>
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
	  $('#MobList').dataTable({
		  "info": false,
			"bLengthChange": false,
			"pageLength": 10,
    });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/mobList.blade.php ENDPATH**/ ?>