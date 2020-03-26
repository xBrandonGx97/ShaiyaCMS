<div id="rankingsData"></div>
    <?php if(count($data) > 0): ?>
      <div class="table-responsive">
        <table class="table table-sm table-dark table-striped tac">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Faction</th>
              <th>Class</th>
              <th>Level</th>
              <th>Guild</th>
              <th>Kills</th>
              <th>Deaths</th>
              <th>Rank</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $data['rankings']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rankings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $data['rankNum']++;
              ?>
              <tr>
                <td><?php echo e($data['rankNum']); ?></td>
                <td><?php echo e($rankings->CharName); ?></td>
                <td></td>
                <td class="IconHolder" width="10"></td>
                <td><?php echo e($rankings->Level); ?></td>
                <td>test</td>
                <td><?php echo e($rankings->K1); ?></td>
                <td><?php echo e($rankings->K2); ?></td>
                <td>
                  <span class="RankIcon Rank<?php echo e($getRank); ?>" title="Rank<?php echo e($getRank); ?>"></span>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
        <p>No News found. Please check back later.</p>
    <?php endif; ?>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/fetch/rankings/rankings.blade.php ENDPATH**/ ?>