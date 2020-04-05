<?php $__env->startSection('index', 'worldChat'); ?>
<?php $__env->startSection('title', 'World Chat'); ?>
<?php $__env->startSection('zone', 'AP'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.ap.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('partials.ap.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          
          <?php if($data['user']->isAuthorized()): ?>
            
            <?php if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA()): ?>
              
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Character Chat Search</h5>
                        </div>
                        <div class="card-body">
                          <?php if(isset($_POST['submit'])): ?>
                            <?php if(!empty($data['chat']->charName)): ?>
                              <?php if(count($data['chat']->getChatData())): ?>
                                <h4 class="text-center"><?php echo e(date('l jS \of F Y h:i:s A')); ?></h4>
                                <div class="fs_16 text-center" id="chat-legend">
                                  <span id="normal">Normal</span> |
                                  <span id="whisper">Whisper</span> |
                                  <span id="area">Area</span> |
                                  <span id="yelling">Yelling</span> |
                                  <span id="party">Party</span> |
                                  <span id="guild">Guild</span> |
                                  <span id="trade">Trade</span> |
                                </div>
                                <?php Separator(20) ?>
                                <table class="ChatData table table-striped" id="PlayerChat">
                                  <thead>
                                    <tr>
                                      <th class="column-map">Map</th>
                                      <th class="column-char">Character</th>
                                      <th class="column-chat">Chat</th>
                                      <th class="column-char">Target</th>
                                      <th class="column-date">Date</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__currentLoopData = $data['chat']->getChatData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php if($res->Family == 0 || $res->Family == 1): ?>
                                        <tr style="background-color:rgba(92,203,255,0.30)">
                                          <td><?php echo e($data['user']->getMap((int)$res->MapID)); ?></td>
                                          <td>
                                            <a href="#"><?php echo e($res->CharName); ?></a>
                                          </td>
                                          <td><?php echo e($data['data']->purify($res->ChatData)); ?></td>
                                          <td class="<?php echo e($data['data']->chatColor((int)$res->ChatType)); ?>">
                                            <?php if(!empty($res->TargetName)): ?>
                                              PM => <?php echo e($data['data']->purify($res->TargetName)); ?>

                                            <?php endif; ?>
                                          </td>
                                          <td class="ChatTime"><?php echo e(date("M d, y H:i:s A", strtotime($res->ChatTime))); ?></td>
                                        </tr>
                                        <?php elseif($res->Family == 2 || $res->Family == 3): ?>
                                          <tr style="background-color:rgba(255,92,139,0.30)">
                                            <td><?php echo e($data['user']->getMap((int)$res->MapID)); ?></td>
                                            <td>
                                              <a href="#"><?php echo e($res->CharName); ?></a>
                                            </td>
                                            <td><?php echo e($data['data']->purify($res->ChatData)); ?></td>
                                            <td class="<?php echo e($data['data']->chatColor((int)$res->ChatType)); ?>">
                                              <?php if(!empty($res->TargetName)): ?>
                                                PM => <?php echo e($data['data']->purify($res->TargetName)); ?>

                                              <?php endif; ?>
                                            </td>
                                            <td class="ChatTime"><?php echo e(date("M d, y H:i:s A", strtotime($res->ChatTime))); ?></td>
                                          </tr>
                                        <?php endif; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tbody>
                                </table>
                              <?php endif; ?>
                            <?php else: ?>
                              Character name can not be empty!
                            <?php endif; ?>
                          <?php endif; ?>
                          <form method="post">
                            <div class="form-group mx-sm-3 mb-2">
                              <input type="text" name="char" placeholder="Char Name" class="form-control"/>
                            </div>
                            <p class="text-center">
                              <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                            </p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <?php echo e(redirect('/admin/auth/login')); ?>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
	  $(document).ready(function(){
      $('#PlayerChat').dataTable( {
        "searching": false,
        "info": false,
        "bLengthChange": false
      });
	  });
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/player/chatSearch.blade.php ENDPATH**/ ?>