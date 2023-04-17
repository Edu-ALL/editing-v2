<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
    <title>Essay Editing Portal</title>
    <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
    <link rel="stylesheet" href="/css/login/login-editor.css">
</head>

<body>

    @if (session()->has('send-email-success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast show bg-warning text-dark" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session()->get('send-email-success') }}

                    </div>
                    <button type="button" class="btn-close btn-close-dark me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('send-email-error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast show bg-danger text-dark" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session()->get('send-email-error') }}

                    </div>
                    <button type="button" class="btn-close btn-close-dark me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('success-reset-password'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast show bg-success text-white" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session()->get('success-reset-password') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('token-not-found'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast show bg-danger text-white" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session()->get('token-not-found') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

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
                <img class="img-content" src="/assets/editor-bg.png" alt="" width="450">
            </div>
            <div class="col-md-6 cardLogin">
                <h4>Login as Editor</h4>
                <hr>
                @if ($errors->get('token-not-found'))
                    {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                @elseif ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                @endif
                <form action="{{ route('editor-login') }}" method="POST">
                    @csrf
                    <div class="field-email mt-5">
                        <h6>Email</h6>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control inputField py-3 px-4" name="email"
                                placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="field-password mt-4">
                        <h6>Password</h6>
                        <div class="input-group mb-2">
                            <input type="password" class="form-control inputField py-3 px-4" name="password"
                                placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="container text-end forgotps">
                        <a href="/forgot/editor">Forgot Password?</a>
                    </div>
                    <button type="submit" class="container-fluid btn btn-warning btnLogin">Login</button>
                </form>
            </div>
        </div>
    </div>
    {{-- End Content --}}
    @include('component.loading')
</body>

</html>
