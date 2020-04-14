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
            
            <?php if (\Illuminate\Support\Facades\Blade::check('auth')): ?>
              <?php if($data['user']->isStaff()): ?>
                
                <?php if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA()): ?>
                  
                  <div class="main-body">
                    <div class="page-wrapper">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card align-items-center">
                            <div class="card-header">
                              <h5>Item Search By Name</h5>
                            </div>
                            <div class="card-body">
                              <?php if(isset($_POST['submit'])): ?>
                                <?php if(!empty($data['items']->name)): ?>
                                  <table class="table table-striped table-responsive" id="ItmSrch">
                                    <thead>
                                      <tr>
                                        <th>ItemName</th>
                                        <th>ItemID</th>
                                        <th>Type</th>
                                        <th>TypeID</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php $__currentLoopData = $data['items']->getItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                          <td><?php echo e($res->ItemName); ?></td>
                                          <td><?php echo e($res->ItemID); ?></td>
                                          <td><?php echo e($res->Type); ?></td>
                                          <td><?php echo e($res->TypeID); ?></td>
                                        </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                  </table>
                                  <p class="text-center">
                                    <button type="button" onclick="window.location.href='<?php echo e($_SERVER['REQUEST_URI']); ?>'" class="btn btn-sm btn-primary" name="return">Return back to item Search</button>
                                  </p>
                                <?php else: ?>
                                  Could not find any results matching the criteria.
                                <?php endif; ?>
                              <?php else: ?>
                                <form method="post">
                                  <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" name="search" class="form-control" placeholder="Search for an Item"/>
                                  </div>
                                  <p class="text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                                  </p>
                                </form>
                                <p class="text-center">
                                  <button type="submit" class="btn btn-sm btn-primary submit_b" data-toggle="modal" data-target="#getItemModal" name="submit_b">bihh</button>
                                </p>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                <?php else: ?>
                  <?php echo e(abort(404)); ?>

              <?php endif; ?>
            <?php else: ?>
                <?php echo e(redirect('/admin/auth/login')); ?>

            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php echo e(display('getItemModal','<i class="fa fa-send"></i>', null, null, 'Item Search')); ?>

    <script>
    $(document).ready(function(){
      $('#ItmSrch').dataTable( {
        "info": false,
        "bLengthChange": false,
        "pageLength": 10
      });
    });
    document.body.addEventListener("click", e => {
      if(e.target.closest(".submit_b")) {
        e.preventDefault();
        const curTrgt = document.querySelector(".submit_b");
        const modal = document.getElementById("getItemModal");
        const modalContent = modal.querySelector("#dynamic-content");

        fetch('/admin/misc/testFetch', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            id: curTrgt.dataset.id,
          })
        })
        .then(r => r.text())
        .then(data => {
          modalContent.innerHTML = data;
        })
        .catch(err => {
            console.log(err);
        })
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/misc/itemSearchName.blade.php ENDPATH**/ ?>