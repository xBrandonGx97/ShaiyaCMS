<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('home.inc.page_bg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('home.inc.page_border', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <header class="nk-header nk-header-opaque">
        <?php echo $__env->make('inc.cms.topNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('inc.cms.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>
    <?php echo $__env->make('inc.cms.rightNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('inc.cms.mobileNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="nk-main">
        <div class="container text-xs-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <div class="container">
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
        </div>
        <?php  Separator(120);  ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>