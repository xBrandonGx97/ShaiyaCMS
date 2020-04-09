<div class="col-md-6 m_t_10">
  <div id="content_card" class="card custom-card">
    <div class="card-header cstm-card-head tac">
      <i class="fas fa-clock"></i>
      Admin Panel Action Logs
    </div>
    <div class="card-block content_bg content pContent">
      <?php if(count($data['panels']->actionLogs()) > 0): ?>
        <div class="table-responsive">
          <table class="table table-striped" id="actionLogs">
            <thead>
              <tr>
                <th>Action</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $data['panels']->actionLogs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($action->UserID); ?> - <?php echo e($action->Action); ?></td>
                  <td>
                    <span class="badge badge-pill badge-secondary">
                      <?php echo e($data['data']->getDateDiff($action->ActionTime)); ?>

                    </span>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="text-center">There are currently no access logs.</p>
      <?php endif; ?>
      <div class="text-center">
        <a class="btn btn-sm btn-outline-info b_i f14" href="/admin/accessLogs">View All Activity</a>
      </div>
    </div>
  </div>
</div>
<script>
setInterval(function(){
  $("#actionLogs").load(window.location.href + " #actionLogs" )
}, 60000);
</script>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/ap/panels/actionLogs.blade.php ENDPATH**/ ?>