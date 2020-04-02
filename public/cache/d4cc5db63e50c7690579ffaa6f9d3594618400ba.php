<div class="col-md-6 m_t_10">
  <div id="content_card" class="card custom-card">
    <div class="card-header cstm-card-head tac">
      <i class="fas fa-clock"></i>
      GM Command Logs
    </div>
    <div class="card-block content_bg content pContent">
      <div class="table-responsive">
        <table class="table table-striped" id="gmLogs">
          <thead>
            <tr>
              <th>CharName</th>
              <th>Command</th>
              <th>Command Result</th>
              <th>Player Affected</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $data['panels']['gmLogs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($log->CharName); ?></td>
                <td><?php echo e($log->Command); ?></td>
                <td><?php echo e($log->CommandResult); ?></td>
                <td><?php echo e($log->PlayerAffected); ?></td>
                <td>
                  <span class="badge badge-pill badge-secondary">
                    <?php echo e(date('F d, Y', strtotime($log->ActionTime))); ?>

                  </span>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a class="btn btn-sm btn-outline-info b_i f14" href="/admin/commandLogs">View All Activity</a>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#gmLogs").load(window.location.href + " #gmLogs" )
}, 60000);
</script>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/ap/panels/gmLogs.blade.php ENDPATH**/ ?>