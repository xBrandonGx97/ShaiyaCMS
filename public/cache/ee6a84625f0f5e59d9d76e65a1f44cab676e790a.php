<?php
    $pagination = new Classes\Utils\Pagination;
    $records_per_page = 5;

    $content = trim(file_get_contents('php://input'));
    $decoded = json_decode($content, true);

    if (is_array($decoded)) {
        if (isset($decoded['page'])) {
            $page = $decoded['page'];
        } else {
            $page = 1;
        }
        $prevPage = $page - 1;
        $nextPage = $page + 1;
        $start_from = ($page - 1) * $records_per_page;
    }
    $pagination->sp($records_per_page,$prevPage,$nextPage,$page);
?>
<!-- START: Posts List -->
<div class="nk-blog-list-classic">
    <!-- START: Post -->
    <div id="newsData"></div>
    <?php if(count($data) > 0): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
    <?php

    $pagination->sp($records_per_page,$prevPage,$nextPage,$page);
    #Pagination::showPages_Rankings($records_per_page,$prevPage,$nextPage,$page)
    ?>
    
    <!-- END: Pagination -->
</div>
<!-- END: Posts List --><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/cms/news.blade.php ENDPATH**/ ?>