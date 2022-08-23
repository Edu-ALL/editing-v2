<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href=<?php echo e(asset('css/bootstrap.css')); ?>>
  <link rel="stylesheet" href="/css/login/login-admin.css">
</head>
<body>
  <nav class="navbar">
    <div class="container py-2 px-4">
      <a class="navbar-brand" href="/">
        <img src="/assets/logo.png" alt="" width="220" height="40">
      </a>
    </div>
  </nav>

  
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 d-flex justify-content-center">
        <img class="img-content" src="/assets/admin-bg.png" alt="" height="450">
      </div>
      <div class="col-md-6 cardLogin">
        <h4>Login as Administrator</h4>
        <hr>
        <form action="/admin/dashboard">
          <div class="field-email mt-5">
            <h6>Email</h6>
            <div class="input-group mb-3">
              <input type="email" class="form-control inputField py-3 px-4" placeholder="Enter your email">
            </div>
          </div>
          <div class="field-password mt-4">
            <h6>Password</h6>
            <div class="input-group mb-2">
              <input type="password" class="form-control inputField py-3 px-4" placeholder="Enter your password">
            </div>
          </div>
          <div class="container text-end forgotps">
            <a href="/forgot/admin">Forgot Password?</a>
          </div>
          <button class="container-fluid btn btn-warning btnLogin">Login</button>
        </form>
      </div>
    </div>
  </div>
  
</body>
</html><?php /**PATH E:\ALL-in\PLATFORM\editing-v2\resources\views/login/login-admin.blade.php ENDPATH**/ ?>