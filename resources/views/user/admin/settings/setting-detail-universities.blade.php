<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/admin/setting-detail-universities.css">
  <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#textarea',
      width: 'auto',
      height: '300'
    });
  </script>
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
              <img class="non-active" src="/assets/users-blue.png" alt="">
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
              <img class="active" src="/assets/setting-blue.png" alt="">
            </div>
            <div class="col-7 pt-1 my-auto d-none d-md-inline">
              <h6 class="menu active">Settings</h6>
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
          <div class="row gap-2">
            <div class="col-md col-12 p-0 userCard profile">
              <div class="headline d-flex align-items-center gap-3">
                <img src="/assets/pic.png" alt="">
                <h6>Profile Picture</h6>
              </div>
              <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                <div class="pic-profile d-flex align-items-center justify-content-center">
                  <img class="img-fluid" id="img-profile" src="/assets/editor-bg.png" alt="">
                </div>
              </div>
              <div class="col d-none px-md-4 px-3" id="chooseFile">
                <div class="mb-4">
                  <input class="form-control form-control-sm" id="formFileSm" type="file" onchange="previewImage()">
                </div>
              </div>
            </div>
            
            <div class="col-md-8 col-12 p-0 userCard">
              <div class="headline d-flex justify-content-between" style="padding: 21px 24px !important;">
                <div class="col-md-6 col-8 d-flex align-items-center gap-md-3 gap-2">
                  <img src="/assets/university.png" alt="">
                  <h6>University</h6>
                </div>
                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                  <a href="/admin/setting/universities"><img src="/assets/back.png" alt="" style="width: auto; height: 32px"></a>
                  <button class="btn-edit border-0" onclick="enableEdit()">
                    <img src="/assets/pencil.png" alt="">
                  </button>
                  <button class="btn-delete border-0">
                    <img src="/assets/delete.png" alt="">
                  </button>
                </div>
              </div>
              
              <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
                <form action="" class="p-0">
                  <div class="col-12 d-flex mb-3">
                    <div class="col-6">
                      <h6 class="pb-2">University Name :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" id="university" value="Adelphi University" disabled>
                    </div>
                    <div class="col-6">
                      <h6 class="pb-2">Email :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" id="email" value="adelphi@example.com" disabled>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-3">
                    <div class="col-12">
                      <h6 class="pb-2">Website :</h6>
                      <input type="email" class="form-control inputField py-2 px-3" id="website" style="width: 96.5%;" value="adelphi-university.com" disabled>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-3">
                    <div class="col-6">
                      <h6 class="pb-2">Phone :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" id="phone" value="12345678" disabled>
                    </div>
                    <div class="col-6">
                      <h6 class="pb-2">Country :</h6>
                      <input type="text" class="form-control inputField py-2 px-3" id="country" value="US" disabled>
                    </div>
                  </div>
                  <div class="col-12 d-flex mb-5" style="overflow: auto !important">
                    <div class="col">
                      <h6 class="pb-2">Address :</h6>
                      <textarea name="" id="textarea" placeholder="Address"></textarea>
                    </div>
                  </div>
                  <div class="col-12 d-none d-flex justify-content-center pt-3" id="btnAddUniv" style="border-top: 1px solid var(--light-grey)">
                    <button class="btn btn-create d-flex align-items-center gap-2">
                      <img src="/assets/update.png" alt="">
                      <h6>Update University</h6>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
  <script src="/js/admin/admin.js"></script>
  <script>
    function previewImage(){
      const imgPreview = document.querySelector('#img-profile');
      imgPreview.src = URL.createObjectURL(event.target.files[0]);
    }
    var check = false;
    function enableEdit(){
      var chooseFile = document.getElementById('chooseFile');
      var univ = document.getElementById('university');
      var email = document.getElementById('email');
      var web = document.getElementById('website');
      var phone = document.getElementById('phone');
      var country = document.getElementById('country');
      var btnAddUniv = document.getElementById('btnAddUniv');
      if (check == false){
        chooseFile.classList.remove('d-none');
        univ.disabled = false;
        email.disabled = false;
        web.disabled = false;
        phone.disabled = false;
        country.disabled = false;
        btnAddUniv.classList.remove('d-none');
        check = true;
      } else if (check == true){
        chooseFile.classList.add('d-none');
        univ.disabled = true;
        email.disabled = true;
        web.disabled = true;
        phone.disabled = true;
        country.disabled = true;
        btnAddUniv.classList.add('d-none');
        check = false;
      }
    }
  </script>
</body>
</html>