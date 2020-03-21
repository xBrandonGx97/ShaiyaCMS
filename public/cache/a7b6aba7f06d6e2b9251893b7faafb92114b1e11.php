<!doctype html>
<html lang="<?php echo e($_SESSION['Settings']['SITE_LANG']); ?>">
    <head>
        <?php if($__env->yieldContent('zone')==='CMS'): ?>
            <?php echo $__env->make('layouts.cms.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            
        <?php endif; ?>
    </head>
    <body>
        <?php if($__env->yieldContent('zone')==='CMS'): ?>
            <?php echo $__env->make('layouts.cms.body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            
        <?php endif; ?>
    </body>
</html><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/layouts/cms/app.blade.php ENDPATH**/ ?>