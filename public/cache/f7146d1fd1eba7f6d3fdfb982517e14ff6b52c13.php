<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('inc.ap.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div id="wrapper">
        <?php echo $__env->make('inc.ap.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <?php echo $__env->make('inc.ap.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>