{{-- Sidenav --}}
<div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
    <a class="navbar-brand mb-3" href="/">
        <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
    </a>
    <hr class="smallLine mx-auto mt-4">
    {{-- Menu --}}
    <div
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
        {{-- Dashboard --}}
        <a class="row w-100" href="/admin/dashboard" style="cursor: pointer">
            <div class="col-md-3">
                <img class="{{ request()->is('admin/dashboard') ? 'active' : 'non-active' }}"
                    src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('admin/dashboard') ? 'active' : '' }}">Dashboard</h6>
            </div>
        </a>

        {{-- Users --}}
        <div class="row w-100" id="users" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
                <img class="{{ request()->is('admin/user/student') || request()->is('admin/user/student/detail') || request()->is('admin/user/mentor') || request()->is('admin/user/editor') || request()->is('admin/user/editor/detail') || request()->is('admin/user/editor/add') || request()->is('admin/user/editor/invite') ? 'active' : 'non-active' }}"
                    src="/assets/users-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu {{ request()->is('admin/user/student') || request()->is('admin/user/student/detail') || request()->is('admin/user/mentor') || request()->is('admin/user/editor') || request()->is('admin/user/editor/detail') || request()->is('admin/user/editor/add') || request()->is('admin/user/editor/invite') ? 'active' : '' }}">
                    Users</h6>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-users">
                <a class="col d-flex gap-3 align-items-center" href="/admin/user/student">
                    <img class="active" src="/assets/student.png" alt="">
                    <h6 class="menu">Students</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/admin/user/mentor">
                    <img class="active" src="/assets/mentor.png" alt="">
                    <h6 class="menu">Mentors</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/admin/user/editor">
                    <img class="active" src="/assets/editor.png" alt="">
                    <h6 class="menu">Editors</h6>
                </a>
            </div>
            {{-- End Popup --}}
        </div>

        {{-- Essay List --}}
        <div class="row w-100" id="essay" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
                <img class="{{ request()->is('admin/essay-list/ongoing') || request()->is('admin/essay-list/ongoing/detail') || request()->is('admin/essay-list/ongoing/assign') || request()->is('admin/essay-list/ongoing/submitted') || request()->is('admin/essay-list/ongoing/accepted') || request()->is('admin/essay-list/completed') || request()->is('admin/essay-list/completed/detail') ? 'active' : 'non-active' }}"
                    src="/assets/essay-list-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu {{ request()->is('admin/essay-list/ongoing') || request()->is('admin/essay-list/ongoing/detail') || request()->is('admin/essay-list/ongoing/assign') || request()->is('admin/essay-list/ongoing/submitted') || request()->is('admin/essay-list/ongoing/accepted') || request()->is('admin/essay-list/completed') || request()->is('admin/essay-list/completed/detail') ? 'active' : '' }}">
                    Essay List</h6>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-essay">
                <a class="col d-flex gap-3 align-items-center" href="/admin/essay-list/ongoing">
                    <img class="active" src="/assets/ongoing-essay.png" alt="">
                    <h6 class="menu">Ongoing Essay</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/admin/essay-list/completed">
                    <img class="active" src="/assets/completed-essay.png" alt="">
                    <h6 class="menu">Completed Essay</h6>
                </a>
            </div>
            {{-- End Popup --}}
        </div>

        {{-- Export to Excel --}}
        <div class="row w-100" id="export" style="cursor: pointer">
            <div class="col w-100 d-flex flex-row align-items-center justify-content-md-start justify-content-center">
                <div class="col-md-3 ps-lg-1">
                    <img class="{{ request()->is('admin/export-excel/student') || request()->is('admin/export-excel/editor') ? 'active' : 'non-active' }}"
                        src="/assets/excel-blue.png" alt="">
                </div>
                <div class="col-7 pt-1 my-auto d-none d-md-inline">
                    <h6
                        class="menu {{ request()->is('admin/export-excel/student') || request()->is('admin/export-excel/editor') ? 'active' : '' }}">
                        Export to Excel</h6>
                </div>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-export">
                <a class="col d-flex gap-3 align-items-center" href="/admin/export-excel/student">
                    <img class="active" src="/assets/student.png" alt="">
                    <h6 class="menu">Students Essay</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/admin/export-excel/editor">
                    <img class="active" src="/assets/editor.png" alt="">
                    <h6 class="menu">Editors Essay</h6>
                </a>
            </div>
            {{-- End Popup --}}
        </div>

        {{-- Settings --}}
        <div class="row w-100" id="setting" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
                <img class="{{ request()->is('admin/setting/universities') || request()->is('admin/setting/universities/add') || request()->is('admin/setting/universities/detail') || request()->is('admin/setting/essay-prompt') || request()->is('admin/setting/essay-prompt/add') || request()->is('admin/setting/essay-prompt/detail') || request()->is('admin/setting/programs') || request()->is('admin/setting/programs/add') || request()->is('admin/setting/programs/detail') || request()->is('admin/setting/categories-tags') || request()->is('admin/setting/categories-tags/detail') ? 'active' : 'non-active' }}"
                    src="/assets/setting-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu {{ request()->is('admin/setting/universities') || request()->is('admin/setting/universities/add') || request()->is('admin/setting/universities/detail') || request()->is('admin/setting/essay-prompt') || request()->is('admin/setting/essay-prompt/add') || request()->is('admin/setting/essay-prompt/detail') || request()->is('admin/setting/programs') || request()->is('admin/setting/programs/add') || request()->is('admin/setting/programs/detail') || request()->is('admin/setting/categories-tags') || request()->is('admin/setting/categories-tags/detail') ? 'active' : '' }}">
                    Settings</h6>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-setting">
                <a class="col d-flex gap-3 align-items-center" href="/admin/setting/universities">
                    <img class="active" src="/assets/university.png" alt="">
                    <h6 class="menu">Universities</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/admin/setting/essay-prompt">
                    <img class="active" src="/assets/essay-prompt.png" alt="">
                    <h6 class="menu">Essay Prompt</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/admin/setting/programs">
                    <img class="active" src="/assets/program.png" alt="">
                    <h6 class="menu">Programs</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/admin/setting/categories-tags">
                    <img class="active" src="/assets/tags.png" alt="">
                    <h6 class="menu">Categories/Tags</h6>
                </a>
            </div>
            {{-- End Popup --}}
        </div>
    </div>

    <hr class="smallLine mx-auto mt-4">
    <div
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
                <form action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
