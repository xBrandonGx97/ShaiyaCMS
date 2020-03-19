<div class="nk-header-title nk-header-title-lg nk-header-title-parallax-opacity">
    <div class="bg-image">
        <div style="background-image: url('/resources/themes/core/images/headers/background.jpg'"></div>
    </div>
    <div class="nk-header-table">
        <div class="nk-header-table-cell">
            <div class="container">
                <div class="nk-header-text">
                    <h1 class="nk-title display-3"><?php echo e($_SESSION['Settings']['SITE_TITLE']); ?></h1>
                    <div class="nk-gap-2"></div>
                    <a href="/community/downloads" class="nk-btn nk-btn-lg nk-btn-color-main-1 link-effect-4">
                        <span>Download</span>
                    </a>
                    <?php if(!isset($_SESSION['UserUID'])): ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="nk-btn nk-btn-lg link-effect-4 open_register">
                            <span>Register</span>
                        </a>
                    <?php endif; ?>
                    <div class="nk-gap-4"></div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\Brandon\Documents\GitHub\Shaiya-Project-v3\resources\views/pages/cms/home/inc/mainHeader.blade.php ENDPATH**/ ?>