<div class="col-lg-8">
    <!-- START: Posts List -->
    <div class="nk-blog-list-classic">
        <!-- START: Post -->
        <?php if(count($data['news']) > 0): ?>
            <?php $__currentLoopData = $data['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="nk-blog-post">
                    <div class="nk-post-content bg-dark-2">
                        <h2 class="nk-post-title h3">
                            <a href="/News/Read/27"><?php echo e($news->Title); ?> </a>
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
        <?php endif; ?>
        <!-- END: Post -->
        <!-- START: Pagination -->
        <div class="nk-pagination nk-pagination-center">
            <nav>
                <a href="#" class="nk-pagination-current-white" style="pointer-events:none;">1</a>
                <a href="community/news?Page=2">2</a>
            </nav>
        </div>
        <!-- END: Pagination -->
    </div>
    <!-- END: Posts List -->
</div>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/cms/news.blade.php ENDPATH**/ ?>