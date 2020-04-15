<?php $__env->startSection('index', 'sendGiftPlayer'); ?>
<?php $__env->startSection('title', 'Send Gift Player'); ?>
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
                              <h5>Send Gift to Player</h5>
                            </div>
                            <div class="card-body">
                              <div id="fetch"></div>
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
      const curTrgt = document.querySelector(".card-body");
      const content = document.getElementById("fetch");
      console.log(content);

        fetch('/admin/player/sendGiftPlayer', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            id: 1
          })
        })
        .then(r => r.text())
        .then(data => {
          content.innerHTML = data;
        })
        .catch(err => {
            console.log(err);
        })
    document.body.addEventListener("click", e => {
      if(e.target.closest(".submit_c")) {
        e.preventDefault();
        const curTrgt = document.querySelector(".submit_c");
        const content = document.getElementById("fetch");

        const char = document.querySelector("input[name='CharName']").value;

        const form = document.getElementById("send_gift");
        const formData = new FormData(form);
        formData.append('submit', 1);

        fetch('/admin/player/sendGiftPlayer', {
          method: 'post',
          body: formData
        })
        .then(r => r.text())
        .then(data => {
          content.innerHTML = data;
        })
        .catch(err => {
            console.log(err);
        })
      }
      if(e.target.closest(".submit_d")) {
        e.preventDefault();
        const curTrgt = document.querySelector(".submit_d");
        const content = document.getElementById("fetch");

        const char = document.querySelector("input[name='CharName']").value;

        const form = document.getElementById("send_gift_verify");
        const formData = new FormData(form);
        /* formData.append('userId', 123) */

        fetch('/admin/player/submitSendGiftPlayer', {
          method: 'post',
          body: formData
        })
        .then(r => r.text())
        .then(data => {
          content.innerHTML = data;
        })
        .catch(err => {
            console.log(err);
        })
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/ap/player/sendGifts/sendGiftPlayer.blade.php ENDPATH**/ ?>