<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/home/home.css">
</head>
<body> 

  @if (session()->has('accept-editor-invitation-error'))
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast show bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          {{ session()->get('accept-editor-invitation-error') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  @endif

  <nav class="navbar" style="background-color: var(--bs-white)">
    <div class="container py-2 px-4">
      <a class="navbar-brand" href="/login/admin">
        <img class="img-logo " src="/assets/logo.webp" alt="" width="150" height="auto">
      </a>
      <a class="btn btn-warning btnLogin" href="#role">Login</a>
    </div>
  </nav>

  {{-- Jumbotron --}}
  <div class="container-fluid jumbotron">
    <div class="row align-items-center pt-4">
      <div class="col-md-5 text-center">
        <img class="jumbotron-logo" src="/assets/essay-actor-bg.png" alt="" width="300">
      </div>
      <div class="col-md-7 px-4">
        <h4 class="jumbotron-title">Editing Your <span style="color: var(--yellow)">Essay</span> Better</h4>
        <p class="jumbotron-desc pb-5">Manage your essay. Engage essay editors. Download your completed essays. Safe. Simple.</p>
      </div>
    </div>
    {{-- shape divider --}}
    <div class="custom-shape-divider-bottom-1659594623" style="margin-bottom: -1px;">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
      </svg>
    </div>
  </div>
  {{-- End Jumbotron --}}

  {{-- Role --}}
  <div class="container text-center mt-4 pt-5" id="role">
    <h2>Select role as a</h2>
    <div class="row mt-4 justify-content-center gap-3">
      <a class="col-md-3 col-9 cardRole pb-3" style="cursor: not-allowed;">
        <img class="img-fluid" src="/assets/student-bg.png" alt="">
        <h4>Student</h4>
      </a>
      <a class="col-md-3 col-9 cardRole pb-3" href="/login/mentor">
        <img class="img-fluid" src="/assets/mentor-bg.png" alt="">
        <h4>Mentor</h4>
      </a>
      <a class="col-md-3 col-9 cardRole pb-3" href="/login/editor">
        <img class="img-fluid" src="/assets/editor-bg.png" alt="">
        <h4>Editor</h4>
      </a>
    </div>
  </div>
  {{-- End Role --}}

  {{-- Footer --}}
  <footer class="container-fluid pt-5 footer">
    <div class="row px-md-5 px-3 mb-4 justify-content-evenly">
      <div class="col-md-3 about mb-md-3 mb-4">
        <h5 class="mb-4">About Us</h5>
        <img src="/assets/logo.webp" alt="" width="150" height="auto" style="filter: saturate(0)">
        <p class="mt-3">We guide students who plan to study at top universities abroad and place them at their best-fit schools.</p>
        <div class="row">
          <a href="https://www.instagram.com/eduall.official/" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/instagram.png" alt="">
          </a>
          <a href="https://id.linkedin.com/company/edu-all-official" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/linkedin.png" alt="">
          </a>
          <a href="https://www.facebook.com/eduall.official/" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/facebook.png" alt="">
          </a>
          <a href="https://www.youtube.com/channel/UCLZ0P-RRdr7k5j2dxhNlObg" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/youtube.png" alt="">
          </a>
        </div>
      </div>
      <div class="col-md-3 opening mb-3">
        <h5 class="mb-4">Opening Times</h5>
        <p>Monday - Friday</p>
        <p>09.00 - 17.00</p>
        <!--<p>Address : Jl. Panjang No. 36 Kebon Jeruk Jakarta Barat</p>-->
      </div>
      <div class="col-md-3 contact">
        <h5 class="mb-4">Contact Us</h5>
        <ul>
          <li>Tel : +62 818 0808 1363</li>
          <li>Tel : +62 878 6081 1413</li>
          <li>Email : info@edu-all.com</li>
        </ul>
      </div>
    </div>
    <hr style="margin: 0;">
    <div class="col-md-5 mx-auto text-center mt-3 copyright">
      <p>Copyright ©{{date('Y')}}. <b>{{env('COMPANY_NAME')}}</b>. All Rights Reserved</p>
    </div>
  </footer>
  {{-- End Footer --}}
</body>
</html>