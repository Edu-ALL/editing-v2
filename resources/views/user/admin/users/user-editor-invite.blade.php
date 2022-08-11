<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/admin/user-editor-invite.css">
  <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '.textarea',
      width: 'auto'
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
          <div class="row justify-content-center mt-md-5">
            <div class="col-lg-7 col-12 p-0 invite-card">
              <div class="headline d-flex justify-content-between">
                <div class="col-lg col d-flex align-items-center gap-md-3 gap-2">
                  <img src="/assets/letter.png" alt="">
                  <h6>Send invitation to the essay editor</h6>
                </div>
                <div class="col-md-4 col-2 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                  <a href="/admin/user/editor"><img src="/assets/back.png" alt=""></a>
                </div>
              </div>
              <form action="">
                <div class="col d-flex flex-column align-items-center justify-content-center field-content p-3 my-4">
                  <div class="col-md-8 col-10 mb-md-4 mb-3">
                    <h6 class="pb-2">Email</h6>
                    <input type="email" class="form-control inputField py-2 px-3">
                  </div>
                  <button class="btn btn-create d-flex align-items-center gap-2">
                    <img src="/assets/send.png" alt="">
                    <h6>Send Email</h6>
                  </button>
                </div>
              </form>
            </div>
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