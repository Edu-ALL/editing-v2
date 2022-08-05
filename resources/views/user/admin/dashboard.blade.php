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
    <div class="row flex-nowrap">

      {{-- Sidenav --}}
      <div class="col-auto col-md-2 sidenav py-md-4 text-center">
        <a class="navbar-brand" href="/">
          <img class="img-logo" src="/assets/admin-logo.png" alt="" width="110">
        </a>
        {{-- Menu --}}
        <div class="container-fluid menu d-flex flex-column align-items-center mt-5 gap-4">
          <div class="row">
            <div class="col-3">
              <img class="active" src="/assets/dashboard.png" alt="">
            </div>
            <div class="col-1 d-none d-md-inline"></div>
            <div class="col-8 pt-1 my-auto d-none d-md-inline">
              <h6 class="active">Dashboard</h6>
            </div>
          </div>
        </div>
      </div>
      {{-- End Sidenav --}}

      {{-- Content --}}
      <div class="col">
        <div class="row content py-4 align-self-center">
          <div class="col-6 ps-5">
            <h4>Admin Dashboard</h4>
          </div>
          <div class="col-6"></div>
        </div>
      </div>
      {{-- End Content --}}
    </div>
  </div>
</body>
</html>