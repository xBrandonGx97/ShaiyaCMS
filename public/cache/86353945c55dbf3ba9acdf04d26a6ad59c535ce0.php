<div class="row">
  <div class="col-md-12 m_t_10">
    <div id="content_card" class="card custom-card">
      <div class="card-header cstm-card-head tac">New Users</div>
      <table class="table table-striped" id="NewPlayers">
        <thead>
          <tr>
            <th>Faction</th>
            <th>Username</th>
            <th>Join Date</th>
            <th>Last Online Date</th>
            <th>Account Status</th>

            <th>Donation Points</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $data['panels']['newUsers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($data['user']->getFaction($user->Faction)); ?></td>
              <td><?php echo e($user->UserID); ?></td>
              <td><?php echo e(date('F d, Y', strtotime($user->JoinDate))); ?></td>
              <td><?php echo e(date('F d, Y', strtotime($user->LogOutTime))); ?></td>
              <td><?php echo e($data['user']->getStatus($user->Status)); ?></td>
              <td><?php echo e($user->Point); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
	  $('#NewPlayers').dataTable( {
		  "searching": false,
			"info": false,
			"bLengthChange": false
    });
	});
</script>
<?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/partials/ap/panels/newUsers.blade.php ENDPATH**/ ?>