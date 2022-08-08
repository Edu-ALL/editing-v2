<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
  <title>Essay Editing Portal</title>
  <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
  <link rel="stylesheet" href="/css/forgot-password/editor-forgot-password.css">
</head>
<body>
  <nav class="navbar">
    <div class="container py-2 px-4">
      <a class="navbar-brand" href="/">
        <img src="/assets/logo.png" alt="" width="220" height="40">
      </a>
    </div>
  </nav>

  {{-- Content --}}
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 d-flex justify-content-center">
        <img class="img-content" src="/assets/forgot-pass-bg.png" alt="" width="450">
      </div>
      <div class="col-md-6 cardLogin mt-3">
        <h4>Forgot Password</h4>
        <hr>
        <div class="field-email mt-5 text-center">
          <h6>We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</h6>
          <div class="input-group mb-2 mt-3">
            <input type="email" class="form-control inputField py-3 px-4" placeholder="Enter your email">
          </div>
        </div>
        <button class="container-fluid btn btn-warning btnLogin">Reset Password</button>
        <div class="container text-center mt-3 mb-2 backLogin">
          <a href="/login/editor">Back to Login</a>
        </div>
      </div>
    </div>
  </div>
  {{-- End Content --}}
</body>
</html>