<div class="nk-gap-6"></div>
<div class="nk-gap-2"></div>
<div class="nk-carousel-2" data-autoplay="12000" data-dots="true">
    <div class="nk-carousel-inner">
        <!-- SQL Query -->
        <?php if(count($data['news']) > 1): ?>
            <?php $__currentLoopData = $data['news']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <div>
                        <blockquote class="nk-testimonial-2">
                            <div class="nk-testimonial-body">
                                <h2><?php echo e($news->Title); ?></h2>
                                <em><?php echo e($news->Detail); ?></em>
                            </div>
                            <div class="nk-testimonial-name h4"><?php echo e($news->UserID); ?></div>
                            <div class="nk-testimonial-source"><?php echo e(date('F d, Y', strtotime($news->Date))); ?></div>
                        </blockquote>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>No News found. Please check back later.</p>
        <?php endif; ?>
    </div>
<div class="nk-gap-2"></div>
<div class="nk-gap-6"></div>