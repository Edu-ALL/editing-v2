

<div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
    <a class="navbar-brand mb-3" href="/">
        <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
    </a>
    <hr class="smallLine mx-auto mt-4">
    
    <div
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
        <div class="row w-100 pointer" onclick="location.href='/editor/dashboard'">
            <div class="col-md-3">
                <img class=" <?php echo e(request()->is('editor/dashboard') ? 'active' : 'non-active'); ?>"
                    src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu <?php echo e(request()->is('editor/dashboard') ? 'active' : ''); ?>">
                    Dashboard</h6>
            </div>
        </div>
        <div class="row w-100 pointer" onclick="location.href='/editor/list'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="<?php echo e(request()->is('editor/list') || request()->is('editor/list/detail') ? '/assets/editor-blue.png' : '/assets/editor.png'); ?>"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu <?php echo e(request()->is('editor/list') || request()->is('editor/list/detail') ? 'active' : ''); ?>">
                    Editor List</h6>
            </div>
        </div>
        <div class="row w-100 pointer" onclick="location.href='/editor/all-essays'">
            <div class="col-md-3 ps-lg-1">
                <img class="active user-icon"
                    src="<?php echo e(request()->is('editor/all-essays') ||
                    request()->is('editor/all-essays/not-assign-essay-list') ||
                    request()->is('editor/all-essays/assign-essay-list') ||
                    request()->is('editor/all-essays/ongoing-essay-list') ||
                    request()->is('editor/all-essays/completed-essay-list') ||
                    request()->is('editor/all-essays/essay-list-due-tommorow') ||
                    request()->is('editor/all-essays/essay-list-due-within-three') ||
                    request()->is('editor/all-essays/essay-list-due-within-five')
                        ? '/assets/all-essays-blue.png'
                        : '/assets/all-essays.png'); ?>"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu <?php echo e(request()->is('editor/all-essays') || request()->is('mentor/user/student/detail') ? 'active' : ''); ?> ">
                    All Essays</h6>
            </div>
        </div>
        <div class="row w-100 align-items-center pointer" onclick="location.href='/editor/essay-list'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="<?php echo e(request()->is('editor/essay-list') || request()->is('editor/essay-list-detail') || request()->is('editor/essay-list-due-tommorow') || request()->is('editor/essay-list-due-within-three') || request()->is('editor/essay-list-due-within-five') ? '/assets/essay-list-blue.png' : '/assets/essay-list.png'); ?>"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu <?php echo e(request()->is('editor/essay-list') || request()->is('editor/essay-list-detail') || request()->is('editor/essay-list-due-tommorow') || request()->is('editor/essay-list-due-within-three') || request()->is('editor/essay-list-due-within-five') ? 'active' : ''); ?>">
                    Essay List</h6>
            </div>
        </div>
        <div class="row w-100 align-items-center pointer" onclick="location.href='/mentor/new-request'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="<?php echo e(request()->is('mentor/new-request') ? '/assets/report-list-blue.png' : '/assets/report-list.png'); ?>"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu <?php echo e(request()->is('mentor/new-request') ? 'active' : ''); ?>">Report List</h6>
            </div>
        </div>
        <div class="row w-100 align-items-center pointer" onclick="location.href='/mentor/new-request'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="<?php echo e(request()->is('mentor/new-request') ? '/assets/setting-blue.png' : '/assets/setting.png'); ?>"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu <?php echo e(request()->is('mentor/new-request') ? 'active' : ''); ?>">Settings</h6>
            </div>
        </div>
        
    </div>
    <hr class="smallLine mx-auto mt-4">
    <div
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-4 pointer">
        <div class="row w-100">
            <div class="col-md-3 ps-lg-1">
                <img class="active" src="/assets/logout.png" alt="">
            </div>
            <div class="col-8 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu">Logout</h6>
            </div>
        </div>
    </div>
</div>


<?php /**PATH E:\ALL-in\PLATFORM\editing-v2\resources\views/user/editor/utama/menu.blade.php ENDPATH**/ ?>