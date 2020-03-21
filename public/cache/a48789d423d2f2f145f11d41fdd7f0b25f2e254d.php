<?php $__env->startSection('title', 'Staff Team'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('headerTitle', 'Staff Team'); ?>
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
        <div class="container text-xs-center" id="team">
            <div class="nk-gap-4"></div>
            
        </div>
        <div class="nk-gap-2"></div>
        <div class="nk-gap-4"></div>
        <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/community/staffteam.blade.php ENDPATH**/ ?>