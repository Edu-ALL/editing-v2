{{-- @section('menu') --}}
{{-- Sidenav --}}
<div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
    <a class="navbar-brand mb-3" href="/">
        <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
    </a>
    <hr class="smallLine mx-auto mt-4">
    {{-- Menu --}}
    <div
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
        <div class="row w-100" onclick="location.href='/mentor/dashboard'">
            <div class="col-md-3">
                <img class="active" src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('/mentor/dashboard') ? 'active' : '' }} ">
                    Dashboard</h6>
            </div>
        </div>
        <div class="row w-100 pointer" onclick="location.href='/mentor/user/student'">
            <div class="col-md-3 ps-lg-1">
                <img class="active user-icon" src="/assets/users.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('/mentor/user/student') ? 'active' : '' }}">Users</h6>
            </div>
        </div>
        <div class="row w-100">
            <div class="col-md-3 ps-lg-1">
                <img class="active" src="/assets/essay-list.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu">Essay List</h6>
            </div>
        </div>
        <div class="row w-100 align-items-center">
            <div class="col-md-3 ps-lg-1">
                <img class="active" src="/assets/excel.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu">Export to Excel</h6>
            </div>
        </div>
        <div class="row w-100">
            <div class="col-md-3 ps-lg-1">
                <img class="active" src="/assets/setting.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu">Settings</h6>
            </div>
        </div>
    </div>
    <hr class="smallLine mx-auto mt-4">
    <div
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-4">
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
{{-- End Sidenav --}}
{{-- @endsection --}}
