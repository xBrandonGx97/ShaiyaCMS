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
		<?php echo $__env->make('home.inc.mainHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.inc.revSlider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('inc.cms.signForms', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.inc.mainFeatures', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.inc.serverInfo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.inc.countDown', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('home.inc.updates', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>