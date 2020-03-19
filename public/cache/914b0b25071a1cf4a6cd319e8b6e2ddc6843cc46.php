
<div class="nk-box bg-dark-1">
	<div class="container text-xs-center">
		<div class="nk-gap-6"></div>
		<div class="nk-gap-2"></div>
		<h2 class="nk-title h1">Server Status</h2>
		<div class="nk-gap-3"></div>


		 <?php
			$data['serverinfo']->ServerStatus();
			$data['serverinfo']->PlayersOnline();
		?>


		<div class="nk-gap-2"></div>
		<h2 class="nk-title h1">Players Online</h2>
		<div class="row equal-height no-gap multi-columns-row">
			<div class="col-md-4" style="height: 294px;">
				<div class="nk-box-2 nk-box-line">
					<div class="nk-counter-3">
						<div class="nk-count"><?php echo e($data['serverinfo']->pOnline); ?></div>
						<h3 class="nk-counter-title h4">Players Online</h3>
						<div class="nk-gap-1"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4" style="height: 294px;">
				<div class="nk-box-2 nk-box-line">
					<div class="nk-counter-3">
						<div class="nk-count"><?php echo e($data['serverinfo']->AoL); ?></div>
						<h3 class="nk-counter-title h4">Alliance of Light</h3>
						<div class="nk-gap-1"></div>
					</div>
				</div>
			</div>
			<div class="col-md-4" style="height: 294px;">
				<div class="nk-box-2 nk-box-line nk-box-last">
					<div class="nk-counter-3">
						<div class="nk-count"><?php echo e($data['serverinfo']->UoF); ?></div>
						<h3 class="nk-counter-title h4">Union of Fury</h3>
						<div class="nk-gap-1"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="nk-gap-2"></div>
		<div class="nk-gap-6"></div>
	</div>
</div><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\app\views/home/inc/serverInfo.blade.php ENDPATH**/ ?>