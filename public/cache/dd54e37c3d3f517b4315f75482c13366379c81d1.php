<?php $__env->startSection('index', 'promotions'); ?>
<?php $__env->startSection('title', 'Promotions'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('headerTitle', 'Promotions'); ?>
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
            <h2 class="display-4">Promotions</h2>
            <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
                <p>Please login to continue.</p>
            <?php else: ?>
                <form method="post">
                    <div class="form-group row">
                        <div class="col-md-4 hidden-sm-down"></div>
                        <div class="input-group col-md-4 col-sm-12">
                            <input type="text" placeholder="Promotion Code" class="form-control" name="code"/>
                        </div>
                    </div>
                    <button type="submit" class="nk-btn nk-btn-color-main-1" name="Promo" style="margin-left:10px;">
                            Submit
                    </button>
                </form>
                <?php if(isset($_POST['Promo'])): ?>
                    <?php if(count($data['promotions']->getPromotions()) === 0): ?>
                        Code not found.
                    <?php else: ?>
                        <?php $__currentLoopData = $data['promotions']->getPromotions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($promotions->NumOfUses==$promotions->MaxUses || $promotions->NumOfUses>$promotions->MaxUses): ?>
                                Code has reached maximum number of uses.
                            <?php else: ?>
                                <?php $data['promotions']->validations($promotions->NumOfUses,$_POST['code']); ?>
                                Successfully redeemed code: <?php echo e($promotions->Code); ?>

                                for <?php echo e($promotions->Points); ?> Donation Points.
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php Separator(40) ?>
        <?php Separator(80) ?>
        <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/user/promotions.blade.php ENDPATH**/ ?>