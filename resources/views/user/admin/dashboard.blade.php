<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/admin/dashboard.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row flex-nowrap main">

      {{-- Sidenav --}}
      <div class="col-md-2 col-2 sidenav py-4 px-md-0 px-2 text-center">
        <a class="navbar-brand mb-3" href="/">
          <img class="img-logo img-fluid" src="/assets/admin-logo.png" alt="">
        </a>
        <hr class="smallLine mx-auto mt-4">
        {{-- Menu --}}
        <div class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-5">
          <div class="row w-100">
            <div class="col-md-3">
              <img class="active" src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu active">Dashboard</h6>
            </div>
          </div>
          <div class="row w-100">
            <div class="col-md-3 ps-lg-1">
              <img class="active" src="/assets/users.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu">Users</h6>
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
        <div class="container ps-lg-5 ps-md-4 menuList d-flex flex-column text-md-start align-items-md-start align-items-center mt-5 mb-5 gap-4">
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

      {{-- Content --}}
      <div class="col">
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
        <div class="container main-content">
          {{-- User List --}}
          <div class="row gap-2">
            <a class="col-md col-12 userCard" href="/admin/user/student">
              <div class="headline text-center">
                <h6>Students</h6>
              </div>
              <div class="row px-3 countUser align-items-center text-center">
                <div class="col">
                  <img class="img-fluid" src="/assets/student-bg.png" alt="">
                </div>
                <div class="col">
                  <h4>1</h4>
                  <h4>Students</h4>
                </div>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Students</h6>
              </div>
            </a>
            <a class="col-md col-12 userCard">
              <div class="headline text-center">
                <h6>Mentors</h6>
              </div>
              <div class="row px-3 countUser align-items-center text-center">
                <div class="col">
                  <img class="img-fluid" src="/assets/mentor-bg.png" alt="">
                </div>
                <div class="col">
                  <h4>1</h4>
                  <h4>Mentors</h4>
                </div>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Mentors</h6>
              </div>
            </a>
            <a class="col-md col-12 userCard">
              <div class="headline text-center">
                <h6>Editors</h6>
              </div>
              <div class="row px-3 countUser align-items-center text-center">
                <div class="col">
                  <img class="img-fluid" src="/assets/editor-bg.png" alt="">
                </div>
                <div class="col">
                  <h4>1</h4>
                  <h4>Editors</h4>
                </div>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Editors</h6>
              </div>
            </a>
          </div>
          {{-- End User List --}}

          {{-- Essay --}}
          <div class="row gap-2 my-2">
            <a class="col-md col-12 userCard">
              <div class="headline d-flex align-items-center gap-3">
                <img src="/assets/ongoing-essay.png" alt="">
                <h6>Ongoing Essay</h6>
              </div>
              <div class="col d-flex flex-column px-3 countUser text-center justify-content-center">
                <h4>1</h4>
                <h4>Essay</h4>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Students</h6>
              </div>
            </a>
            <a class="col-md col-12 userCard" href="">
              <div class="headline d-flex align-items-center gap-3" style="background-color: var(--green)">
                <img src="/assets/completed-essay.png" alt="">
                <h6>Completed Essay</h6>
              </div>
              <div class="col d-flex flex-column px-3 countUser text-center justify-content-center" style="color: var(--green)">
                <h4>1</h4>
                <h4>Essay</h4>
              </div>
              <hr>
              <div class="detailCard ps-3 mt-2">
                <h6>See the list of Students</h6>
              </div>
            </a>
          </div>
          {{-- End Essay --}}
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
</body>
</html>