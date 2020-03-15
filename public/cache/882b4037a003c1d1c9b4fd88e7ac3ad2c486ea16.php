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
        <?php echo $__env->make('inc.cms.signForms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="nk-gap-4"></div>
        <div class="container">'
            <h2 class="display-4 text-center">News</h2>
            <?php if(count($data['news']) > 0): ?>
                <?php $__currentLoopData = $data['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="nk-box-3 bg-dark-1">
                                <h2 class="nk-title h3 text-xs-center"><?php echo e($news->Title); ?></h2>
                                <span><?php echo e($news->Detail); ?></span>
                                <span class="float-right"><?php echo e(date('F d, Y', strtotime($news->Date))); ?></span>
                                <span class="float-right"><strong><?php echo e($news->UserID); ?></strong> &nbsp;</span>
                            </div>
                        </div>
                    </div>
                    <?php  Separator(40);  ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p>No News found. Please check back later.</p>
            <?php endif; ?>
        </div>
        <?php  Separator(120);  ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>