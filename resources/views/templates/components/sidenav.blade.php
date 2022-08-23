<div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
    <a class="navbar-brand mb-3" href="/">
      <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
    </a>
    <hr class="smallLine mx-auto mt-4">
    {{-- Menu --}}
    <div class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
      {{-- Dashboard --}}
      <a class="row w-100" href="/admin/dashboard" style="cursor: pointer">
        <div class="col-md-3">
          <img class="active" src="/assets/dashboard-blue.png" alt="">
        </div>
        <div class="col-7 pt-1 my-auto d-none d-md-inline">
          <h6 class="menu active">Dashboard</h6>
        </div>
      </a>

      {{-- Users --}}
      <div class="row w-100" id="users" style="cursor: pointer">
        <div class="col-md-3 ps-lg-1">
          <img class="active" src="/assets/users.png" alt="">
        </div>
        <div class="col-7 pt-1 my-auto d-none d-md-inline">
          <h6 class="menu">Users</h6>
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
          <img class="active" src="/assets/essay-list.png" alt="">
        </div>
        <div class="col-7 pt-1 my-auto d-none d-md-inline">
          <h6 class="menu">Essay List</h6>
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
            <img class="active" src="/assets/excel.png" alt="">
          </div>
          <div class="col-7 pt-1 my-auto d-none d-md-inline">
            <h6 class="menu">Export to Excel</h6>
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
          <img class="active" src="/assets/setting.png" alt="">
        </div>
        <div class="col-7 pt-1 my-auto d-none d-md-inline">
          <h6 class="menu">Settings</h6>
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
    <div class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-4">
      <div class="row w-100" style="cursor: pointer">
        <div class="col-md-3 ps-lg-1">
          <img class="active" src="/assets/logout.png" alt="">
        </div>
        <div class="col-8 pt-1 my-auto d-none d-md-inline">
          <h6 class="menu">
            <form action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="border-0 bg-transparent">Logout</button>
            </form>
          </h6>
        </div>
      </div>
    </div>
  </div>