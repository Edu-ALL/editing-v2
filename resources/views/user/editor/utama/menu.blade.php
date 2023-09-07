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
        <div class="row w-100 pointer" onclick="location.href='/editor/dashboard'">
            <div class="col-md-3">
                <img class=" {{ request()->is('editor/dashboard') ? 'active' : 'non-active' }}"
                    src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('editor/dashboard') ? 'active' : '' }}">
                    Dashboard</h6>
            </div>
        </div>
        <div class="row w-100 pointer" onclick="location.href='/editor/list'">
            <div class="col-md-3">
                <img class="active"
                    src="{{ request()->is('editor/list*') || request()->is('editor/invite*') ? '/assets/editor-blue.png' : '/assets/editor.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu {{ request()->is('editor/list*') || request()->is('editor/invite*') ? 'active' : '' }}">
                    Editor List</h6>
            </div>
        </div>
        <div class="row w-100 pointer" onclick="location.href='/editor/all-essays'">
            <div class="col-md-3 ps-lg-1">
                <img class="active user-icon"
                    src="{{ request()->is('editor/all-essays*')
                        ? '/assets/all-essay-blue.png'
                        : '/assets/all-essay.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu {{ request()->is('editor/all-essays*') ? 'active' : '' }} ">
                    All Essays</h6>
            </div>
        </div>
        <div class="row w-100 align-items-center pointer" onclick="location.href='/editor/essay-list'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="{{ request()->is('editor/essay-list*') || request()->is('editor/essay-list-detail') || request()->is('editor/essay-list-due-tommorow') || request()->is('editor/essay-list-due-within-three') || request()->is('editor/essay-list-due-within-five') ? '/assets/essay-list-blue.png' : '/assets/essay-list.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6
                    class="menu {{ request()->is('editor/essay-list*') || request()->is('editor/essay-list-detail') || request()->is('editor/essay-list-due-tommorow') || request()->is('editor/essay-list-due-within-three') || request()->is('editor/essay-list-due-within-five') ? 'active' : '' }}">
                    Essay List</h6>
            </div>
        </div>


        <div class="row w-100 pointer" onclick="location.href='/editor/report-list'">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="{{ request()->is('editor/report-list*') ? '/assets/report-blue.png' : '/assets/report.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('editor/report-list*') ? 'active' : '' }}">Report List</h6>
            </div>
        </div>

        <div class="row w-100" id="setting" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
                <img class="active"
                    src="{{ request()->is('editor/setting/*') ? '/assets/setting-blue.png' : '/assets/setting.png' }}"
                    alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
                <h6 class="menu {{ request()->is('editor/setting/*') ? 'active' : '' }}">Settings</h6>
            </div>
            {{-- Popup --}}
            <div class="col-auto d-none d-flex flex-column gap-4 popup-menu ps-4 pe-5 py-3" id="menu-setting">
                <a class="col d-flex gap-3 align-items-center" href="/editor/setting/universities">
                    <img class="active" src="/assets/university.png" alt="">
                    <h6 class="menu">Universities</h6>
                </a>
                <a class="col d-flex gap-3 align-items-center" href="/editor/setting/categories-tags">
                    <img class="active" src="/assets/tags.png" alt="">
                    <h6 class="menu">Categories/Tags</h6>
                </a>
            </div>
            {{-- End Popup --}}
        </div>

    </div>
    <hr class="smallLine mx-auto mt-4">
    <div
        class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-4 pointer">
        <div class="row w-100" data-bs-toggle="modal" data-bs-target="#logout">
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

{{-- Modal Logout --}}
<div class="modal fade" id="logout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                <form action="{{ route('editor-logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
