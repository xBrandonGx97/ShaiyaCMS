<?php $__env->startSection('title', 'Drop Finder'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('pages.cms.home.inc.page_bg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('pages.cms.home.inc.page_border', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <header class="nk-header nk-header-opaque">
        <?php echo $__env->make('inc.cms.topNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('inc.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <?php echo $__env->make('inc.cms.rightNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('inc.cms.mobileNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="nk-main">
		<?php echo $__env->make('inc.cms.signForms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	<div class="container text-xs-center">
    		<div class="nk-gap-6"></div>
    		<div class="nk-gap-2"></div>
    		<div class="container">
    			<?php if(isset($_POST['SC'])): ?>
    				<?php if(count($data['dropfinder']->fet) > 0): ?>
    					<form method="POST">
    						<div class="table-responsive">
    							<table class="table table-sm table-dark2">
    								<thead>
										<tr>
											<th align="middle">Item Name</th>
											<th align="middle">Select</th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $data['dropfinder']->fet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($fet[0]); ?></td>
												<td><input align="middle" type="radio" name="ItemID" value="<?php echo e($fet['ItemID']); ?>"></td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
							<button type="submit" class="nk-btn nk-btn-color-main-1" name="SCI" style="margin-left:10px;">Submit</button>
						</form>
						<?php else: ?>
							<h1 class="display-7">No Item's Found!!</h1>
    				<?php endif; ?>
    				<?php elseif(isset($_POST['SCI'])): ?>
    					<?php if(!isset($_POST['ItemID'])): ?>
    						<?php die('You didn\'t select an item!'); ?>
    					<?php endif; ?>
    					<?php if(count($data['dropfinder']->fet) > 0): ?>
    						<form method="POST">
    							<div class="table-responsive">
    								<table class="table table-sm table-dark2">
    									<thead>
											<tr>
												<th>MobName</th>
												<th>Mob Ele</th>
												<th>Mob Level</th>
												<th>Map Name</th>
												<th>Drop Rate</th>
											</tr>
										</thead>
										<tbody>
											<?php $__currentLoopData = $data['dropfinder']->fet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><?php echo e($fet['MobName']); ?></td>
													<td><img src="/resources/themes/core/images/dropfinder/ele_<?php echo e($fet['Attrib']); ?>.png"></td>
													<td><?php echo e($fet['Level']); ?></td>
													<td><?php echo e($data['dropfinder']->getMaps($fet['MapID'])); ?></td>
													<td>
														<?php
															$DropRate=$fet['DropRate'];
															if ($fet['ItemOrder']>5){
																$DropRate=($DropRate/100);
															}if ($DropRate>100){
																$DropRate=100;
															}
															echo (($DropRate)." %");
														?>
													</td>
												</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
								</div>
							</form>
							<?php else: ?>
								<h1 class="display-7">No Drops Found!!</h1>
    					<?php endif; ?>
    				<?php else: ?>
    					<form method="POST">
    						<div class="form-group row">
    							<div class="col-md-4 hidden-sm-down"></div>
    							<div class="input-group col-md-4 col-sm-12">
    								<input type="text" placeholder="Item Name" class="form-control tac b_i" name="item" />
    								<div class="input-group-append">
    									<button type="submit" class="nk-btn nk-btn-color-main-1" name="SC" style="margin-left:10px;">Submit</button>
									</div>
								</div>
							</div>
						</form>
						<?php Separator(10); ?>
    			<?php endif; ?>
			</div>
		</div>
		<?php Separator(120); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/serverinfo/dropfinder.blade.php ENDPATH**/ ?>