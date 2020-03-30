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
              <?php $__currentLoopData = $data['panels']['actionLogs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
      </div>
      <div class="text-center">
        <a class="btn btn-sm btn-outline-info b_i f14" href="/admin/accesslogs">View All Activity</a>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/ap/panels/actionLogs.blade.php ENDPATH**/ ?>