<?php $__env->startSection('title', 'Vote for Us'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
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
            <h2 class="display-4">Vote for DP</h2>
            <p>You will <?php echo e($data['vote']->Point); ?>  DP per vote.</p>
            <p>You can vote every 12 hours.</p>
            <?php Separator(20); ?>
            <form name="Vote" method="post" id="Vote" target="_new">
                <input type="radio" name="site" value="nr1" checked> XtremeTop100<br>
                <input type="radio" name="site" value="nr2"> OxigenTop100<br>
                <input type="radio" name="site" value="nr3"> GamingTop100<br>
                <input type="radio" name="site" value="nr4"> Top of Games<br/>
                <?php Separator(20); ?>
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/votenew.jpg" border="0" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/button_1.gif.png" border="0" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/vote.gif" border="0" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/47879_original.gif" border="0" alt="Shaiya Servers">
                <?php Separator(20) ?>
                <?php Separator(20) ?>
                <div class="col-md-3"></div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm" id="Button1" name="Vote">Vote</button>
                </div>
            </form>
        </div>
        <?php Separator(40) ?>
        <?php Separator(80) ?>
        <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/user/vote.blade.php ENDPATH**/ ?>