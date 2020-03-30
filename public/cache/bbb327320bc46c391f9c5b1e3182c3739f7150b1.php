
<?php $__env->startSection('index', 'dashboard'); ?>
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('zone', 'AP'); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.ap.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.ap.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    
                    <?php if($data['user']->isAuthorized()): ?>
                        
                        <?php if($data['user']->isADM()): ?>
                            
                            <div class="row">
                                <?php echo $__env->make('partials.ap.panels.newlyRegistered', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('partials.ap.panels.totalAccounts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('partials.ap.panels.onlineLast24', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('partials.ap.panels.onlineCurrent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 m_t_10">
                                    <div id="content_card" class="card custom-card">
                                        <div class="card-header cstm-card-head tac">
                                            <i class="fas fa-clock"></i>
                                            Admin Panel Action Log
                                        </div>
                                        <div class="card-block content_bg content pContent">
                                            <div class="card-text">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-dark">
                                                        <thead>
                                                            <tr>
                                                                <th>Action</th>
                                                                <th>Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <?php $__currentLoopData = $data['panels']['actionLogs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <td><?php echo e($action->UserID); ?> - <?php echo e($action->Action); ?></td>
                                                                    <td>
                                                                        <span class="badge badge-pill badge-secondary"><?php echo e($data['data']->getDateDiff($action->ActionTime)); ?></span>
                                                                    </td>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <a class="badge badge-pill badge-primary b_i f14" href="/admin/accesslogs">View All Activity</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        You must be logged in to access the admin dashboard.
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/index.blade.php ENDPATH**/ ?>