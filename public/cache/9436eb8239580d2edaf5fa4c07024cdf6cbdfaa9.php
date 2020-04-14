<?php $__env->startSection('index', 'actionLog'); ?>
<?php $__env->startSection('title', 'Action Log'); ?>
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
                      <div class="card">
                        <div class="card-header text-center m-auto">
                          <h5>Action Log</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if($data['action']->actionType !== 'n/a'): ?>
                              <?php if(count($data['action']->getActionData()) >0): ?>
                                <table class="table table-striped" id="Actions">
                                  <thead>
                                    <tr>
                                      <th>CharName</th>
                                      <th>Map</th>
                                      <th>Value1</th>
                                      <th>Value2</th>
                                      <th>Text1</th>
                                      <th>Text2</th>
                                      <th>Text3</th>
                                      <th>Text4</th>
                                      <th>Time</th>
                                      <th>Type</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__currentLoopData = $data['action']->getActionData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                        <td><?php echo e($res->CharName); ?></td>
                                        <td><?php echo e($res->MapID); ?></td>
                                        <td><?php echo e($res->Value1); ?></td>
                                        <td><?php echo e($res->Value2); ?></td>
                                        <td><?php echo e($res->Text1); ?></td>
                                        <td><?php echo e($res->Text2); ?></td>
                                        <td><?php echo e($res->Text3); ?></td>
                                        <td><?php echo e($res->Text4); ?></td>
                                        <td><?php echo e($res->ActionTime); ?></td>
                                        <td><?php echo e($res->ActionType); ?></td>
                                      </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                              <?php else: ?>
                                <p class="text-center">No actions found.</p>
                              <?php endif; ?>
                            <?php else: ?>
                              <p class="text-center">Please select an action.</p>
                            <?php endif; ?>
                          <?php else: ?>
                            <form class="form-inline" method="post">
                              <div class="col-md-3"></div>
                              <div class="col-md-6 m-auto">
                                <div class="form-group mx-sm-3 mb-2">
                                  <select name="actionType" class="form-control">
                                    <option value="n/a">Select an action..</option>
                                    <option value="all">All Actions</option>
                                    <option value="173">Boss attacks</option>
                                    <option value="104">Deaths</option>
                                    <option value="164">Gatekeeper used</option>
                                    <option value="180">GM Commands</option>
                                    <option value="161">Gold picked up from ground</option>
                                    <option value="113">Item bought from npc</option>
                                    <option value="115">Item bought from player</option>
                                    <option value="215">Item Created</option>
                                    <option value="212">Item Enchanted</option>
                                    <option value="213">Item Recreated</option>
                                    <option value="114">Item sold to npc</option>
                                    <option value="116">Item sold to player</option>
                                    <option value="121">Item stored in warehouse</option>
                                    <option value="122">Item taken out of warehouse</option>
                                    <option value="112">Item used or lost</option>
                                    <option value="103">Kills</option>
                                    <option value="120">Lapis Extracted</option>
                                    <option value="119">Lapis Linked</option>
                                    <option value="107">Login</option>
                                    <option value="108">Logout</option>
                                    <option value="174">Name change</option>
                                    <option value="141">New Skilled Learned/Skill Upgrade</option>
                                    <option value="111">Player acquired item</option>
                                    <option value="146">Player level up/down</option>
                                    <option value="131">Quest start</option>
                                    <option value="117">Trade between players</option>
                                  </select>
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                  <input type="text" class="form-control" placeholder="User ID" name="user"/>
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                  <input type="date" class="form-control" name="startDate" value="<?php echo e(date('Y-m-d')); ?>"/>
                                  <input type="date" class="form-control m_l_5" name="endDate" value="<?php echo e(date('Y-m-d', time()+86400)); ?>"/>
                                </div>
                                <p class="text-center">
                                  <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                                </p>
                              </div>
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
	  $('#Actions').dataTable({
		  "info": false,
			"bLengthChange": false,
			"pageLength": 15,
    });
	});
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/actionLog.blade.php ENDPATH**/ ?>