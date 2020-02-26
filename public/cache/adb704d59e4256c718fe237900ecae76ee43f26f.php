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
        <div class="nk-gap-4"></div>
        <div class="container">'
            <h2 class="display-4 text-center">Patch Notes</h2>
            <?php if(count($data['patchnotes']) > 0): ?>
                <?php $__currentLoopData = $data['patchnotes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patchnotes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="nk-box-3 bg-dark-1">
                                <h2 class="nk-title h3 text-xs-center"><?php echo e($patchnotes->Title); ?></h2>
                                <?php  echo $patchnotes->Detail;  ?>
                                <span class="float-right"><?php echo e(date('F d, Y', strtotime($patchnotes->Date))); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php  Separator(40);  ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p>No Patch Notes found. Please check back later.</p>
            <?php endif; ?>
        </div>
        <?php  Separator(120);  ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>