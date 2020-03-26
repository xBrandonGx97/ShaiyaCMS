<!doctype html>
<html lang="<?php echo e(APP['lang']); ?>">
    <head>
        <?php echo $__env->make('layouts.ap.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <?php echo $__env->make('layouts.ap.body', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.ap.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/layouts/ap/app.blade.php ENDPATH**/ ?>