<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  @yield('title')
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/admin/dashboard.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row flex-nowrap main">

      {{-- Sidenav --}}
      @include('user.admin.templates.components.sidenav')
      {{-- End Sidenav --}}

      {{-- Content --}}
      <div class="col">
        @include('user.admin.templates.components.header')
        <div class="container main-content m-0">
          @if(session()->has('login-successful'))
            <div class="row alert alert-success fade show" role="alert">
              {{ session()->get('login-successful') }}
            </div>
          @endif
          
          @yield('content')
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @if(session()->has('login-successful'))
  <script>
    $(document).ready(function() {
      setTimeout(() => {
        $(".alert-success").alert('close');
      }, 3000);
    });
  </script>
  @endif
</body>
</html>