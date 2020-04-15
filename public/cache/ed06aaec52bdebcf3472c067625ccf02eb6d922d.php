<?php $__env->startSection('index', 'login'); ?>
<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('zone', 'AP'); ?>
<?php $__env->startSection('content'); ?>
  <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
    <form method="post">
      <div class="auth-wrapper aut-bg-img" style="background: #212224;">
        <div class="auth-content">
          <div class="text-white">
            <div class="card-body text-center">
              <div class="mb-4">
                <i class="feather icon-unlock auth-icon"></i>
              </div>
              <h3 class="mb-4 text-white">Login</h3>
              <?php if(isset($_POST['submit'])): ?>
                <?php if(empty($data['login']->getUser())): ?>
                  <?php echo e($data['login']->addMessage('error 1')); ?>

                <?php endif; ?>
                <?php if(empty($data['login']->getPassword())): ?>
                  <?php echo e($data['login']->addMessage('error 2')); ?>

                <?php elseif(strlen($data['login']->getPassword()) < 3 || strlen($data['login']->getPassword()) > 16): ?>
                  <?php echo e($data['login']->addMessage('error 3')); ?>

                <?php endif; ?>
                <?php if(count($data['login']->getMessages()) == 0): ?>
                  <?php if($data['login']->getUserData()): ?>
                    <?php $__currentLoopData = $data['login']->getUserData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(password_verify($data['login']->getPassword(), $userInfo->Pw)): ?>
                        <?php echo e($data['login']->login($userInfo)); ?>

                      <?php else: ?>
                        <?php echo e($data['login']->addMessage('error 4')); ?>

                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <?php echo e($data['login']->addMessage('error 5')); ?>

                  <?php endif; ?>
                <?php endif; ?>
                <?php if(count($data['login']->getMessages())): ?>
                  <ul>
                    <?php $__currentLoopData = $data['login']->getMessages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo $error; ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                <?php endif; ?>
              <?php endif; ?>
              <div class="input-group mb-3">
                <input type="text" class="form-control text-white" placeholder="Username or Email" name="user">
              </div>
              <div class="input-group mb-4">
                <input type="password" class="form-control text-white" placeholder="password" name="password">
              </div>
              <div class="form-group text-left">
                <div class="checkbox checkbox-fill d-inline">
                  <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
                  <label for="checkbox-fill-a1" class="cr"> Save credentials</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary shadow-2 mb-4" name="submit">Login</button>
              <p class="mb-2 text-muted" style="color: #9fabb3 !important;">Forgot password? <a class="text-white" href="#">Reset</a></p>
              <p class="mb-0 text-muted"  style="color: #9fabb3 !important;">Don’t have an account? <a class="text-white" href="/admin/auth/signup">Signup</a></p>
            </div>
          </div>
        </div>
      </div>
    </form>
  <?php else: ?>
    <?php echo e(redirect('/admin')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/auth/login.blade.php ENDPATH**/ ?>