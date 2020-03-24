<!-- START: Posts List -->
<div class="nk-blog-list-classic">
    <!-- START: Post -->
    <div id="newsData"></div>
    <?php if(count($data) > 0): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="nk-blog-post">
                <div class="nk-post-content bg-dark-2">
                    <h2 class="nk-post-title h3">
                    <a href="/News/Read/<?php echo e($news->RowID); ?>"><?php echo e($news->Title); ?> </a>
                    </h2>
                    <div class="nk-post-date">
                        <?php echo e(date('F d, Y', strtotime($news->Date))); ?>

                    </div>
                    <div class="nk-post-text">
                        <?php echo e($news->Detail); ?>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <p>No News found. Please check back later.</p>
    <?php endif; ?>
    <!-- END: Post -->
</div>
<!-- END: Posts List --><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/cms/news.blade.php ENDPATH**/ ?>