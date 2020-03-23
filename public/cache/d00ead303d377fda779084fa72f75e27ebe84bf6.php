<?php $__env->startSection('title', 'Support'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('headerTitle', 'Support'); ?>
<?php $__env->startSection('content'); ?>
    
    <?php echo $__env->make('partials.cms.pageBorder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <header class="nk-header nk-header-opaque">
        <?php echo $__env->make('partials.cms.topNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </header>
    <?php echo $__env->make('partials.cms.rightNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('partials.cms.mobileNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="nk-main">
        <?php echo $__env->make('partials.cms.pageHeader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('partials.cms.signForms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container text-xs-center">
            <?php Separator(80) ?>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
                        <p>Please login to continue.</p>
                    <?php else: ?>
                        <div class="nk-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tabs-3-1" role="tab" data-toggle="tab">My Tickets</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link open_send_ticket_modal" data-id="<?php echo e($data['User']->UserUID); ?>" data-toggle="modal" data-target="#get_ticket_modal" href="#">New Ticket</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="tabs-3-1">
                                    <div class="nk-gap-2"></div>
                                    <div class="table-responsive" id="TableLoader">
                                        <table class="table table-dark2" id="TabularData">
                                            <thead>
                                                <tr class="tac">
                                                    <td>Ticket ID</td>
                                                    <td>Subject</td>
                                                    <td>Status</td>
                                                    <td>Last Updated</td>
                                                    <td>Edit</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $data['support']->getTickets(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td class="tac"><?php echo e($fet['TicketID']); ?></td>
                                                        <td class="tac"><?php echo e($fet['Subject']); ?></td>
                                                        <td class="tac"><?php echo e($data['support']->getStatus($fet['Status'])); ?></td>
                                                        <td class="tac"><?php echo e(date("M d, Y h:i A", strtotime($fet['Date']))); ?></td>
                                                        <td class="tac"><button class="nk-btn nk-btn-color-main-1 open_edit_ticket_modal" data-toggle="modal" data-id="<?php echo e($fet['UserUID']); ?>~<?php echo e($fet['TicketID']); ?>~<?php echo e($fet['Category']); ?>~<?php echo e($fet['Subject']); ?>~<?php echo e($fet['Message']); ?>~<?php echo e($fet['Status']); ?>~<?php echo e($fet['Date']); ?>" data-target="#get_e_ticket_modal">Edit</button></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="nk-gap-2"></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php Separator(40) ?>
        <?php Separator(80) ?>
        <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
            Display('get_ticket_modal','<i class="fa fa-send"></i>','0','2','Send Ticket');
            Display('get_e_ticket_modal','<i class="fa fa-send"></i>','1','2','Edit Ticket');
        ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/user/support.blade.php ENDPATH**/ ?>