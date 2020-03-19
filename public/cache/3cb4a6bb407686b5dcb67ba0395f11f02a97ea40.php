<!doctype html>
<html lang="<?php echo e($_SESSION['Settings']['SITE_LANG']); ?>">
    <head>
        <?php if($data['pageData']['zone']=='CMS'): ?>
            <?php echo $__env->make('inc.cms.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('inc.ap.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </head>
    <body>
        <?php echo $__env->yieldContent('content'); ?>
        <?php if($data['pageData']['zone']=='CMS'): ?>
		    <?php echo $__env->make('inc.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('inc.ap.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </body>
</html><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/layouts/app.blade.php ENDPATH**/ ?>