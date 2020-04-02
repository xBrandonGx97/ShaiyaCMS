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
                          <h5>Item Search By Category</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(count($data['items']->getItems()) > 0): ?>
                              <table class="table table-dark" id="ItmSrch">
                                <thead>
                                  <tr>
                                    <th>ItemName</th>
                                    <th>ItemID</th>
                                    <th>Type</th>
                                    <th>TypeID</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data['items']->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($res->ItemName); ?></td>
                                    <td><?php echo e($res->ItemID); ?></td>
                                    <td><?php echo e($res->Type); ?></td>
                                    <td><?php echo e($res->TypeID); ?></td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                              </table>
                              <p class="text-center">
                                <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to item Search</button>
                              </p>
                            <?php else: ?>
                              Could not find any results matching the criteria.
                            <?php endif; ?>
                          <?php else: ?>
                            <form method="post">
                              <div class="form-group mx-sm-3 mb-2">
                                <table class="table table-striped">
                                  Item Category:
                                  <select name="ItemID" class="form-control">
                                    <option value="1">1 Handed Sword</option>
                                    <option value="2">2 Handed Sword</option>
                                    <option value="3">1 Handed Axe</option>
                                    <option value="4">2 Handed Sword</option>
                                    <option value="5">Duel Swords/Axes</option>
                                    <option value="6">Spears</option>
                                    <option value="7">1 Handed Blunts</option>
                                    <option value="8">2 Handed Blunts</option>
                                    <option value="9">1 Handed Dagger</option>
                                    <option value="10">Dagger</option>
                                    <option value="11">Javelings</option>
                                    <option value="12">Staffs</option>
                                    <option value="13">Bow</option>
                                    <option value="14">Crossbows</option>
                                    <option value="15">Claws</option>
                                    <option value="16">AOL Helms</option>
                                    <option value="17">AOL Tops</option>
                                    <option value="18">AOL Pants</option>
                                    <option value="19">AOL Shields</option>
                                    <option value="20">AOL Gaunts</option>
                                    <option value="21">Aol Boots</option>
                                    <option value="22">Rings</option>
                                    <option value="23">Amulets</option>
                                    <option value="24">AOL Caps/Dashing Extream</option>
                                    <option value="25">Potions / Enchant Items</option>
                                    <option value="27">Quest Items</option>
                                    <option value="28">More Quest Items</option>
                                    <option value="29">More Quest Items</option>
                                    <option value="30">Lapis</option>
                                    <option value="31">UOF Helms</option>
                                    <option value="32">UOF Tops</option>
                                    <option value="33">UOF Pants</option>
                                    <option value="34">UOF Shields</option>
                                    <option value="35">UOF Gaunts</option>
                                    <option value="36">UOF Boots</option>
                                    <option value="38">EP5 Enchant Items</option>
                                    <option value="39">Fury Caps</option>
                                    <option value="40">Loops</option>
                                    <option value="42">Mounts</option>
                                    <option value="43">Etin</option>
                                    <option value="44">Few Enchants/Quest Items</option>
                                    <option value="94">Gold Bars</option>
                                    <option value="95">Lapisia</option>
                                    <option value="100">DP Items</option>
                                  </select>
                                </table>
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
	  $('#ItmSrch').dataTable( {
			"info": false,
			"bLengthChange": false,
      "pageLength": 10
    });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/itemSearch.blade.php ENDPATH**/ ?>