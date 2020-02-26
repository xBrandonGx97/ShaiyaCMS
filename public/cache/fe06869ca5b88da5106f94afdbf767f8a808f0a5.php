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
                <h2 class="display-4">Promotions</h2>
                <?php if(!$data['User']['LoginStatus']==true): ?>
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
                        <?php if(empty($data['promotions']->fet)): ?>
                            Code not found.
                        <?php else: ?>
                            <?php if($data['promotions']->NumOfUses==$data['promotions']->MaxUses || $data['promotions']->NumOfUses>$data['promotions']->MaxUses): ?>
                                Code has reached maximum number of uses.
                            <?php else: ?>
                                <?php  $data['promotions']->validations();  ?>
                                Successfully redeemed code: <?php echo e($data['promotions']->Code); ?>

                                for <?php echo e($data['promotions']->Points); ?> Donation Points.
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php  Separator(120);  ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>