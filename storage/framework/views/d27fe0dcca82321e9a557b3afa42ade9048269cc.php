<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href=<?php echo e(asset('css/bootstrap.css')); ?>>
  <link rel="stylesheet" href="/css/home/home.css">
</head>
<body>
  <nav class="navbar" style="background-color: var(--bs-white)">
    <div class="container py-2 px-4">
      <a class="navbar-brand" href="/login/admin">
        <img class="img-logo " src="/assets/logo.png" alt="" width="220" height="40">
      </a>
      <a class="btn btn-warning btnLogin" href="#role">Login</a>
    </div>
  </nav>

  
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
    
    <div class="custom-shape-divider-bottom-1659594623" style="margin-bottom: -1px;">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
      </svg>
    </div>
  </div>
  

  
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
  

  
  <footer class="container-fluid pt-5 footer">
    <div class="row px-md-5 px-3 mb-4 justify-content-evenly">
      <div class="col-md-3 about mb-md-3 mb-4">
        <h5 class="mb-4">About Us</h5>
        <img src="/assets/logo.png" alt="" width="160" height="26" style="filter: saturate(0)">
        <p class="mt-3">We guide students who plan to study at top universities abroad and place them at their best-fit schools.</p>
        <div class="row">
          <a href="https://www.instagram.com/allineduspace/" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/instagram.png" alt="">
          </a>
          <a href="https://www.linkedin.com/company/all-in-eduspace/" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/linkedin.png" alt="">
          </a>
          <a href="https://www.facebook.com/allineduspace/" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/facebook.png" alt="">
          </a>
          <a href="https://www.youtube.com/channel/UCLZ0P-RRdr7k5j2dxhNlObg" target="_blank" style="width: auto">
            <img class="img-fluid sosmed" src="/assets/youtube.png" alt="">
          </a>
        </div>
      </div>
      <div class="col-md-3 opening mb-3">
        <h5 class="mb-4">Opening Times</h5>
        <p>Monday - Saturday</p>
        <p>08.00 - 17.00</p>
        <p>Address : Jl. Panjang No. 36 Kebon Jeruk Jakarta Barat</p>
      </div>
      <div class="col-md-3 contact">
        <h5 class="mb-4">Contact Us</h5>
        <ul>
          <li>Tel : +62 818 0808 1363</li>
          <li>Tel : +62 878 6081 1413</li>
          <li>Email : info@all-inedu.com</li>
        </ul>
      </div>
    </div>
    <hr style="margin: 0;">
    <div class="col-md-5 mx-auto text-center mt-3 copyright">
      <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
    </div>
  </footer>
  

  
</body>
</html><?php /**PATH E:\ALL-in\PLATFORM\editing-v2\resources\views/home/home.blade.php ENDPATH**/ ?>