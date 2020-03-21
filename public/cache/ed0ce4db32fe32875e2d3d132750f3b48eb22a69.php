<?php $__env->startSection('title', 'Downloads'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('headerTitle', 'Downloads'); ?>
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
            <p class="lead">By downloading ServerName You agree to Our <a href="">Terms of Service and Conditions</a>. If you Violate these terms you can be banned without any warnings and permenantly.</p>
                <div class="row vertical-gap align-items-center">
                    <div class="col-md-3"></div>
                    <div class="col-md-4" style="height: 707px;">
                        <div>
                            <div class="nk-pricing">
                                <h3 class="nk-pricing-title">Game Files</h3>
                                <div class="nk-pricing-price">
                                    <a href="https://mega.nz/#!JIsjVALI!Bo4rUTqhEOJuFlYPXWgwM6a0jQyDuRWgTYPeDQOE2gY" target="_blank" class="nk-btn nk-btn-lg nk-btn-rounded nk-btn-outline nk-btn-color-main-1">Mega</a>
                                    <a href="https://drive.google.com/file/d/1BLzRs-d4ILybCAVHfIX7Ehtj0AtIMHYd/edit" target="_blank" class="nk-btn nk-btn-lg nk-btn-rounded nk-btn-outline nk-btn-color-main-1" style="margin-left:5px">Google Drive</a>
                                </div>
                                <div class="nk-pricing-button">
                                    <span>Last Updated On: 3.14.19</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="height: 707px;">
                        <div>
                            <div class="nk-pricing">
                                <h3 class="nk-pricing-title">Patch Files</h3>
                                <div class="nk-pricing-price">
                                    <a href="#" class="nk-btn nk-btn-lg nk-btn-rounded nk-btn-outline nk-btn-color-main-1">Game.exe</a>
                                    <a href="#" class="nk-btn nk-btn-lg nk-btn-rounded nk-btn-outline nk-btn-color-main-1" style="margin-left:5px">Updater.exe</a>
                                </div>
                                <div class="nk-pricing-button">
                                    <span>Last Updated On: 1.27.19</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php Separator(40) ?>
            <?php Separator(80) ?>
        </div>
        <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/community/downloads.blade.php ENDPATH**/ ?>