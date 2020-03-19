<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('home.inc.page_bg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('home.inc.page_border', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <header class="nk-header nk-header-opaque">
        <?php echo $__env->make('inc.cms.topNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('inc.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <?php echo $__env->make('inc.cms.rightNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('inc.cms.mobileNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="nk-main">
		<?php echo $__env->make('inc.cms.signForms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="nk-box bg-dark-1">
            <div class="container text-xs-center">
                <div class="nk-gap-6"></div>
                <div class="nk-gap-2"></div>
                <h2 class="nk-title h1 text-center">PvP Rankings</h2>
                <div class="container">
                    <div class="table-responsive" id="pagination_data">
                        <div class="container">
                            <div class="row paginationData">
                                <div class="col-md-3 order-md-2 text-right">
                                    <input type="search" class="form-control form-control-sm" name="search" id="searchBox" placeholder="Search..">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php Separator(120); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\app\views/community/pvprankings.blade.php ENDPATH**/ ?>