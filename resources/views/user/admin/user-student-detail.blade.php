<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/admin/user-student-detail.css">
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
          <a class="row w-100" href="/admin/dashboard">
            <div class="col-md-3">
              <img class="non-active" src="/assets/dashboard-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu">Dashboard</h6>
            </div>
          </a>
          <div class="row w-100">
            <div class="col-md-3 ps-lg-1">
              <img class="active" src="/assets/users-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu active">Users</h6>
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
          {{-- Detail Student --}}
          <div class="row">
            <div class="col-md col-12 p-0 studentList">
              <div class="headline d-flex justify-content-between">
                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                  <img src="/assets/student.png" alt="">
                  <h6>Students</h6>
                </div>
                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                  <a href="/admin/user/student"><img src="/assets/back.png" alt=""></a>
                </div>
              </div>
              <div class="row student-info pb-md-0 pb-4">
                <div class="col-md-4 d-flex align-items-center justify-content-center py-md-0 py-4">
                  <div class="pic-profile">
                    <img class="img-fluid" src="/assets/student-bg.png" alt="">
                  </div>
                </div>
                <div class="col-md-8 student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-md-5 px-4">
                  <div class="row d-flex align-items-center">
                    <div class="col-md-3 col-4">
                      <h6>Full Name</h6>
                    </div>
                    <div class="col-1 titik2"><p>:</p></div>
                    <div class="col-7">
                      <p>Student Dummy</p>
                    </div>
                  </div>
                  <div class="row d-flex align-items-center">
                    <div class="col-md-3 col-4">
                      <h6>Phone Number</h6>
                    </div>
                    <div class="col-1 titik2"><p>:</p></div>
                    <div class="col-7">
                      <p>12345678</p>
                    </div>
                  </div>
                  <div class="row d-flex align-items-center">
                    <div class="col-md-3 col-4">
                      <h6>Email</h6>
                    </div>
                    <div class="col-1 titik2"><p>:</p></div>
                    <div class="col-7">
                      <p>student.dummy@gmail.com</p>
                    </div>
                  </div>
                  <div class="row d-flex align-items-center">
                    <div class="col-md-3 col-4">
                      <h6>Address</h6>
                    </div>
                    <div class="col-1 titik2"><p>:</p></div>
                    <div class="col-7">
                      <p>Jl Jeruk Kembar blok Q9 no.15</p>
                    </div>
                  </div>
                  <div class="row d-flex align-items-center">
                    <div class="col-md-3 col-4">
                      <h6>Mentor Name</h6>
                    </div>
                    <div class="col-1 titik2"><p>:</p></div>
                    <div class="col-7">
                      <div class="dropdown">
                        <button class="btn dropdown-toggle w-100 text-start" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          <p class="d-inline-block">Mentor</p>
                        </button>
                        <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                          <li class="mt-1 mb-2">
                            <input type="email" class="form-control inputField py-1 px-2" placeholder="Search">
                          </li>
                          <li><a class="dropdown-item ps-2 my-1" href="">Action</a></li>
                          <li><a class="dropdown-item ps-2 my-1" href="">Another action</a></li>
                          <li><a class="dropdown-item ps-2 my-1" href="">Something else here</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row student-addition p-md-5 p-3">
                {{-- Text Area --}}
                <div class="text-area p-md-1 mb-3">
                  <h6 class="pb-3">Personal Brand Statement :</h6>
                  <textarea name="" id=""></textarea>
                </div>
                <div class="text-area p-md-1 mb-3">
                  <h6 class="pb-3">Academic Goals & Interest :</h6>
                  <textarea name="" id=""></textarea>
                </div>
                <div class="text-area p-md-1 mb-3">
                  <h6 class="pb-3">Life Philosophy (Values) & Personalities :</h6>
                  <textarea name="" id=""></textarea>
                </div>
                {{-- End Text Area --}}
                {{-- Attachment --}}
                <div class="col-lg-2 col-3 mb-lg-4 mb-3 attachment d-flex align-items-center justify-content-center">
                  <h6 class="text-center">Attachment</h6>
                </div>
                <div class="row d-flex flex-lg-row flex-column attachment-status gap-lg-0 gap-2 ps-lg-0 ps-2 mb-3">
                  <div class="col-lg-4 me-2">
                    <h6>Activities Resume<span class="px-2">:</span><span style="color: var(--red)">Not Available</span></h6>
                  </div>
                  <div class="col-lg">
                    <h6>Questionnaire<span class="px-2">:</span><span style="color: var(--red)">Not Available</span></h6>
                  </div>
                  <div class="col-lg">
                    <h6>Others<span class="px-2">:</span><span style="color: var(--red)">Not Available</span></h6>
                  </div>
                </div>
                {{-- End Attachment --}}
              </div>
            </a>
          </div>
          {{-- End Detail Student --}}
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

  <script src={{ asset('js/bootstrap.bundle.js') }}></script>
</body>
</html>