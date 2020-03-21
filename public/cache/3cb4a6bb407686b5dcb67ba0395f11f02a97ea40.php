<!doctype html>
<html lang="<?php echo e($_SESSION['Settings']['SITE_LANG']); ?>">
    <head>
        <?php echo $__env->make('inc.cms.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <?php echo $__env->yieldContent('content'); ?>
    </body>
</html><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/layouts/app.blade.php ENDPATH**/ ?>