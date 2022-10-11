{{-- @section('menu') --}}
{{-- Sidenav --}}
<div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
    <a class="navbar-brand mb-3" href="/">
        <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
    </a>
    <hr class="smallLine mx-auto mt-4">
    {{-- Menu --}}
    <div style="cursor: pointer"
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
        <div class="row w-100 pointer" onclick="location.href='/mentor/dashboard'">
            <div class="col-md-3">
                <img class=" {{ request()->is('mentor/dashboard') ? 'active' : 'non-active' }}"
                    src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('mentor/dashboard') ? 'active' : '' }}">
                    Dashboard</h6>
            </div>
        </div>


        {{-- <div class="row w-100 pointer" onclick="location.href='/mentor/essay-list'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="{{ request()->is('mentor/essay-list') || request()->is('mentor/essay-list/detail') ? '/assets/essay-list-blue.png' : '/assets/essay-list.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('mentor/essay-list') ? 'active' : '' }}">Essay List</h6>
            </div>
        </div> --}}

        <div class="row w-100" id="essay" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="{{ request()->is('mentor/essay-list') || request()->is('mentor/essay-list/detail') ? '/assets/essay-list-blue.png' : '/assets/essay-list.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('mentor/essay-list') ? 'active' : '' }}">Essay List</h6>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-essay">
                <a class="col d-flex gap-3 align-items-center" href="/mentor/essay-list">
                    <img class="active" src="/assets/ongoing-essay.png" alt="">
                    <h6 class="menu">Ongoing Essay</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/mentor/essay-list/completed">
                    <img class="active" src="/assets/completed-essay.png" alt="">
                    <h6 class="menu">Completed Essay</h6>
                </a>
            </div>
            {{-- End Popup --}}
        </div>

        <div class="row w-100" style="cursor: pointer" onclick="location.href='/mentor/user/student'">
            <div class="col-md-3 ps-lg-1">
                <img class="active user-icon"
                    src="{{ request()->is('mentor/user/student') || request()->is('mentor/user/student/detail/*') ? '/assets/student-blue.png' : '/assets/student.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu {{ request()->is('mentor/user/student') || request()->is('mentor/user/student/detail/*') ? 'active' : '' }} ">
                    Students</h6>
            </div>
        </div>
        <div class="row w-100 align-items-center" style="cursor: pointer" onclick="location.href='/mentor/new-request'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="{{ request()->is('mentor/new-request') ? '/assets/new-request-blue.png' : '/assets/new-request.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('mentor/new-request') ? 'active' : '' }}">New Request</h6>
            </div>
        </div>
        {{-- <div class="row w-100 pointer">
            <div class="col-md-3 ps-lg-1">
                <img class="active" src="/assets/setting.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu">Settings</h6>
            </div>
        </div> --}}
    </div>
    <hr class="smallLine mx-auto mt-4">
    <div style="cursor: pointer"
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-4">
        <div type="button" class="row w-100" data-bs-toggle="modal" data-bs-target="#logout">
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
{{-- Modal Logout --}}
<div class="modal fade" id="logout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header">
                <div class="col d-flex gap-2 align-items-center">
                    <img src="/assets/logout-2.png" alt="">
                    <h6 class="modal-title ms-3">Ready to leave?</h6>
                </div>
                <div type="button" data-bs-dismiss="modal" aria-label="Close">
                    <img src="/assets/close.png" alt="" style="height: 26px">
                </div>
            </div>
            <div class="modal-body text-center px-4 py-4">
                <p>Select "Logout" below if you are ready to end your current session.</p>
            </div>
            <div class="modal-footer d-flex align-items-start justify-content-center border-0 pt-1 pb-4">
                <form action="{{ route('logout-mentor') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
