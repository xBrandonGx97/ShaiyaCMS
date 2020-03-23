<div class="col-lg-4 nk-sidebar-sticky-parent" style="">
    <aside class="nk-sidebar nk-sidebar-left nk-sidebar-sticky">
        <div class="" style="">
            <div class="luneth-sidebar-item">
                <div class="nk-box-1 bg-dark-2">
                        <?php if(count($data['widget']) > 0): ?>
                            <?php $__currentLoopData = $data['widget']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <h4><?php echo e($widget->Title); ?></h4>
                                <div>
                                    
                                    <?php
                                        $coreController = new Framework\Core\CoreController;
                                        $coreController->widget($widget->Name);
                                    ?>
                                </div>
                                <div class="nk-gap-2"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/cms/widgets.blade.php ENDPATH**/ ?>