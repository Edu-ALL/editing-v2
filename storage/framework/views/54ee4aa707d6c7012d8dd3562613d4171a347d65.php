

<div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
    <a class="navbar-brand mb-3" href="/">
        <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
    </a>
    <hr class="smallLine mx-auto mt-4">
    
    <div
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
        <div class="row w-100 pointer" onclick="location.href='/mentor/dashboard'">
            <div class="col-md-3">
                <img class=" <?php echo e(request()->is('mentor/dashboard') ? 'active' : 'non-active'); ?>"
                    src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu <?php echo e(request()->is('mentor/dashboard') ? 'active' : ''); ?>">
                    Dashboard</h6>
            </div>
        </div>
        <div class="row w-100 pointer" onclick="location.href='/mentor/essay/list'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="<?php echo e(request()->is('mentor/essay/list') || request()->is('mentor/essay/list/detail') ? '/assets/essay-list-blue.png' : '/assets/essay-list.png'); ?>"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu <?php echo e(request()->is('mentor/essay/list') ? 'active' : ''); ?>">Essay List</h6>
            </div>
        </div>
        <div class="row w-100 pointer" onclick="location.href='/mentor/user/student'">
            <div class="col-md-3 ps-lg-1">
                <img class="active user-icon"
                    src="<?php echo e(request()->is('mentor/user/student') || request()->is('mentor/user/student/detail') ? '/assets/student-blue.png' : '/assets/student.png'); ?>"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu <?php echo e(request()->is('mentor/user/student') || request()->is('mentor/user/student/detail') ? 'active' : ''); ?> ">
                    Students</h6>
            </div>
        </div>
        <div class="row w-100 align-items-center pointer" onclick="location.href='/mentor/new-request'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="<?php echo e(request()->is('mentor/new-request') ? '/assets/new-request-blue.png' : '/assets/new-request.png'); ?>"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu <?php echo e(request()->is('mentor/new-request') ? 'active' : ''); ?>">New Request</h6>
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


<?php /**PATH E:\ALL-in\PLATFORM\editing-v2\resources\views/user/mentor/utama/menu.blade.php ENDPATH**/ ?>