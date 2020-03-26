<!doctype html>
<html lang="<?php echo e(APP['lang']); ?>">
    <head>
        <?php echo $__env->make('layouts.cms.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <?php echo $__env->make('layouts.cms.body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/layouts/cms/app.blade.php ENDPATH**/ ?>