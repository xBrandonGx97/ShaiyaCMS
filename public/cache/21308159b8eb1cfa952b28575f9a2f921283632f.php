<?php $__env->startSection('title', 'Guild Rankings'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('headerTitle', 'Guild Rankings'); ?>
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
            <h2 class="nk-title h1 text-center">Guild Rankings</h2>
            <div class="container">
                <?php if(count($data['guildrankings']) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-dark table-striped tac">
                            <thead>
                                <tr class="boss-record">
                                    <th class="boss-record">Rank</th>
                                    <th class="boss-record">Guild Name</th>
                                    <th class="boss-record">Guild Leader</th>
                                    <th class="boss-record">Members</th>
                                    <th class="boss-record">Points</th>
                                    <th class="boss-record">Faction</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $data['guildrankings']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guildrankings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($guildrankings->Rank); ?></td>
                                    <td><?php echo e($guildrankings->GuildName); ?></td>
                                    <td><?php echo e($guildrankings->MasterName); ?></td>
                                    <td><?php echo e($guildrankings->TotalCount); ?></td>
                                    <td><?php echo e($guildrankings->GuildPoint); ?></td>
                                    <?php if($guildrankings->Country == 0): ?>
                                        <td><img src="/resources/themes/core/images/icons/guildranking/aol.png" height="35" width="35"></td>
                                    <?php endif; ?>
                                    <?php if($guildrankings->Country == 1): ?>
                                        <td><img src="/resources/themes/core/images/icons/guildranking/uof.png" height="35" width="35"></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <h3 class="mb40">Sorry, there are currently no guilds to display.</h3>
                    <h5 class="mb40">Guilds must have at least 1 guild point and active to be displayed here.</h5>
                <?php endif; ?>
            </div>
        </div>
        <?php Separator(40) ?>
        <?php Separator(80) ?>
        <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/community/guildrankings.blade.php ENDPATH**/ ?>