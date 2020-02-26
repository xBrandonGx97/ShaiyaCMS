<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('home.inc.page_bg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('home.inc.page_border', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <header class="nk-header nk-header-opaque">
        <?php echo $__env->make('inc.cms.topNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('inc.cms.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>
    <?php echo $__env->make('inc.cms.rightNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('inc.cms.mobileNav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="nk-main">
        <div class="container text-xs-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <div class="container">
                <h2 class="display-4">PvP Rewards</h2>
                <?php if(!$data['User']['LoginStatus']==true): ?>
                    <p>Please login to continue.</p>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-dark2 table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Prize ID</th>
                                    <th>Kills Required</th>
                                    <th>Icon</th>
                                    <th>Reward</th>
                                    <th>Redeem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $index=1;
                                 ?>
                                <?php $__currentLoopData = $data['rewards']->Rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index); ?></td>
                                        <td><?php echo e($data['rewards']->Kills['K'.$index]); ?></td>
                                        <td align="center"><div class="RankIcon RankIcon<?php echo e($index); ?>"></div></td>
                                        <td><?php echo e($Reward); ?></td>
                                        <?php if($data['rewards']->k1 >=$data['rewards']->Kills['K'.$index]): ?>
                                            <?php 
                                                $data['rewards']->validateKills($index);
                                             ?>
                                            <?php if($data['rewards']->rowCount==0): ?>
                                                <td class="text-center"><button class="nk-btn nk-btn-color-main-1 open_send_prize_modal" data-toggle="modal" data-id="<?php echo e($index); ?>~<?php echo e($Reward); ?>~<?php echo e($data['User']['UserUID']); ?>" data-target="#get_prize_modal">Redeem Prize</button></td>
                                                <?php else: ?>
                                                    <td class="tac">You already redeemed this Prize!</td>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <td>You need more kills to redeem this Prize!</td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php  $index++;  ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php  Separator(120);  ?>
        <?php 
            Display('get_prize_modal','<i class="fa fa-send"></i>','0','2','Redeem Prize');
         ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>