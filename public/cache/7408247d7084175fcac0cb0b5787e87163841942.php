<?php $__env->startSection('title', 'About'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('headerTitle', 'About'); ?>
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
            <div class="nk-gap-4"></div>
            <h2 class="display-4">About | Server Info</h2>
            <ul>
                <li>Episode 6.4</li>
                <li>Max Level 80</li>
                <li>Custom Commands</li>
                <li>PvE/PvP</li>
                <li>EP8 Data/Custom Costumes/Wings/Pets</li>
                <li>x2 Killrate (Double on weekends)</li>
                <li>x20 ExpRate (Double on weekends)</li>
            </ul>
        </div>
        <div class="nk-gap-2"></div>
        <div class="nk-gap-4"></div>
        <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/serverinfo/about.blade.php ENDPATH**/ ?>