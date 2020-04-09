<?php $__env->startSection('index', 'itemList'); ?>
<?php $__env->startSection('title', 'Item List'); ?>
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
                          <h5>Item List</h5>
                        </div>
                        <div class="card-body">
                          <table class="table table-sm table-striped" id="ItemList">
                            <thead>
                              <tr>
                                <th>ItemID</th>
                                <th>ItemName</th>
                                <th>Type</th>
                                <th>TypeID</th>
                                <th>Requierd Level</th>
                                <th>Country</th>
                                <th>Fight/War</th>
                                <th>Def/Guard</th>
                                <th>Ranger/Sin</th>
                                <th>Archer/Hunter</th>
                                <th>Mage/Pag</th>
                                <th>Priest/Orc</th>
                                <th>Max O.J.Stats</th>
                                <th>Count Per Stack</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(count($data['items']->getItems()) > 0): ?>
                                <?php $__currentLoopData = $data['items']->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($res->ItemID); ?></td>
                                    <td><?php echo e($res->ItemName); ?></td>
                                    <td><?php echo e($res->Type); ?></td>
                                    <td><?php echo e($res->TypeID); ?></td>
                                    <td><?php echo e($res->Reqlevel); ?></td>
                                    <td><?php echo e($res->Country); ?></td>
                                    <td><?php echo e($res->Attackfighter); ?></td>
                                    <td><?php echo e($res->Defensefighter); ?></td>
                                    <td><?php echo e($res->Patrolrogue); ?></td>
                                    <td><?php echo e($res->Shootrogue); ?></td>
                                    <td><?php echo e($res->Attackmage); ?></td>
                                    <td><?php echo e($res->Defensemage); ?></td>
                                    <td><?php echo e($res->ReqWis); ?></td>
                                    <td><?php echo e($res->Count); ?></td>
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
	  $('#ItemList').dataTable({
		  "info": false,
			"bLengthChange": false,
			"pageLength": 15,
    });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/itemList.blade.php ENDPATH**/ ?>