<!doctype html>
<html lang="<?php echo e($_SESSION['Settings']['SITE_LANG']); ?>">
    <head>
        <?php if($data['pageData']['zone']=='CMS'): ?>
            <?php echo $__env->make('inc.cms.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('inc.ap.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </head>
    <body>
        <?php echo $__env->yieldContent('content'); ?>
        <?php if($data['pageData']['zone']=='CMS'): ?>
		    <?php echo $__env->make('inc.cms.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('inc.ap.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </body>
</html>