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
                <h2 class="display-4">Vote for DP</h2>
                <p>You will <?php echo e($data['vote']->Point); ?>  DP per vote.</p>
                <p>You can vote every 12 hours.</p>
                <?php  Separator(20);  ?>
                <form name="Vote" method="post" id="Vote" target="_new">
                    <input type="radio" name="site" value="nr1" checked> XtremeTop100<br>
                    <input type="radio" name="site" value="nr2"> OxigenTop100<br>
                    <input type="radio" name="site" value="nr3"> GamingTop100<br>
                    <input type="radio" name="site" value="nr4"> Top of Games<br/>
                    <?php  Separator(20);  ?>
                    <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/votenew.jpg" border="0" alt="Shaiya Servers">
                    <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/button_1.gif.png" border="0" alt="Shaiya Servers">
                    <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/vote.gif" border="0" alt="Shaiya Servers">
                    <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/47879_original.gif" border="0" alt="Shaiya Servers">
                    <?php  Separator(20);  ?>
                    <?php  Separator(20);  ?>
                    <div class="col-md-3"></div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm" id="Button1" name="Vote">Vote</button>
                    </div>
                </form>
            </div>
        </div>
        <?php  Separator(120);  ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>