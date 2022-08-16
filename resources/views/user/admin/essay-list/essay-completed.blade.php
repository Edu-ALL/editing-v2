<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/admin/essay-completed.css">
</head>
<body>
  <div class="container-fluid" style="padding: 0">
    <div class="row flex-nowrap main">

      {{-- Sidenav --}}
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
              <img class="non-active" src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu">Dashboard</h6>
            </div>
          </a>

          {{-- Users --}}
          <div class="row w-100" id="users" style="cursor: pointer">
            <div class="col-md-3 ps-lg-1">
              <img class="non-active" src="/assets/users.png" alt="">
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
              <img class="active" src="/assets/essay-list-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu active">Essay List</h6>
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
              <h6 class="menu">Logout</h6>
            </div>
          </div>
        </div>
      </div>
      {{-- End Sidenav --}}

      {{-- Content --}}
      <div class="col" style="overflow: auto !important">
        <div class="row head py-4 align-items-center">
          <div class="col-md-6 col-10 ps-md-5 ps-3">
            <h4 class="">Admin Dashboard</h4>
          </div>
          <div class="col-md-6 col-2 pe-md-5 pe-3">
            <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-2">
              <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="">
                <img class="img-fluid" src="/assets/help-grey.png" alt="">
                <h6 class="d-none d-md-inline">Help</h6>
              </a>
              <a href="">
                <h6 class="pt-1 d-none d-md-inline">Admin Name</h6>
              </a>
            </div>
          </div>
        </div>
        <div class="container main-content m-0">
          {{-- Table Student --}}
          <div class="row">
            <div class="col-md col-12 p-0 studentList">
              <div class="headline d-flex justify-content-between" style="background-color: var(--green)">
                <div class="col-md-6 col-7 d-flex align-items-center gap-md-3 gap-2">
                  <img src="/assets/completed-essay.png" alt="">
                  <h6>List of Completed Essay</h6>
                </div>
                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end">
                  <div class="input-group">
                    <input type="email" class="form-control inputField py-2 px-3" placeholder="Search">
                  </div>
                </div>
              </div>
              <div class="container text-center" style="overflow-x: auto !important">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Student Name</th>
                      <th>Mentor Name</th>
                      <th>Editor Name</th>
                      <th>Essay Title</th>
                      <th>Essay Deadline</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr onclick="window.location='/admin/essay-list/completed/detail'">
                      <th scope="row">1</th>
                      <td>Student Dummy</td>
                      <td>Mentor Dummy</td>
                      <td>Senior Editor Dummy</td>
                      <td>Supplemental Essay</td>
                      <td>Thu, 28 Jul 2022</td>
                      <td style="color: var(--green)">Completed</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          {{-- End Table Student --}}
        </div>
      </div>
      {{-- End Content --}}
    </div>
  </div>
  {{-- Footer --}}
  <footer class="container-fluid footer">
    <div class="col-md-5 mx-auto text-center py-2 copyright">
      <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
    </div>
  </footer>
  {{-- End Footer --}}

  <script src={{ asset('js/bootstrap.js') }}></script>
  <script src="/js/admin/admin.js"></script>
</body>
</html>