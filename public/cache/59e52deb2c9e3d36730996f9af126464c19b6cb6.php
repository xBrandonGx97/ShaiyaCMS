<?php $__env->startSection('title', 'Friends'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('headerTitle', 'Friends'); ?>
<?php $__env->startSection('content'); ?>
    
    <?php echo $__env->make('partials.cms.pageBorder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <header class="nk-header nk-header-opaque">
        <?php echo $__env->make('partials.cms.topNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <?php echo $__env->make('partials.cms.rightNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('partials.cms.mobileNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="nk-main">
        <?php echo $__env->make('partials.cms.pageHeader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('partials.cms.signForms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container text-xs-center">
            <?php Separator(80) ?>
            <h2 class="display-4">Friend Requests</h2>
            <?php
                $UserUID    =   $data['User']['UserUID'];
                $checkFriendRequests =   $data['Friends']->checkFriendRequests($UserUID);
                $checkFriends   =   $data['Friends']->checkFriends($UserUID);
            ?>
            <?php if(count($checkFriendRequests) > 0): ?>
                <?php $__currentLoopData = $checkFriendRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($requests->FromUser); ?>

                    <a href="#" class="nk-btn link-effect-4 accept_friend" data-id="<?php echo e($requests->FromUser); ?>~<?php echo e($requests->ToUser); ?>">Accept</a>
                    <a href="#" class="nk-btn link-effect-4 decline_friend" data-id="<?php echo e($requests->FromUser); ?>~<?php echo e($requests->ToUser); ?>">Decline</a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if(count($checkFriends) > 0): ?>
                <?php $__currentLoopData = $checkFriends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friends): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($friends->DisplayName); ?>

                    <a href="#" class="nk-btn link-effect-4 remove_friend" data-id="<?php echo e($friends->FromUser); ?>~<?php echo e($friends->ToUser); ?>">Remove Friend</a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <?php Separator(40) ?>
        <?php Separator(80) ?>
        <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/user/friends.blade.php ENDPATH**/ ?>