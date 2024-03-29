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
    <style>
        .file {
            visibility: hidden;
            position: absolute;
        }

        .fs-10 {
            font-size: 10px
        }
    </style>
</head>

<body>
    @if (session()->has('error-reset-password'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast show bg-warning text-dark" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session()->get('error-reset-password') }}
                    </div>
                    <button type="button" class="btn-close btn-close-dark me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <nav class="navbar" style="background-color: var(--bs-white)">
        <div class="container py-2 px-4">
            <a class="navbar-brand" href="/login/admin">
                <img class="img-logo " src="/assets/logo.png" alt="" width="220px" height="40">
            </a>
            <a class="btn btn-warning btnLogin" href="#role">Reset</a>
        </div>
    </nav>

    {{-- Role --}}
    <div class="container text-center mt-4 pt-5" id="role">
        <div class="headline d-flex justify-content-center">
            <div class="col-md-6 col-8 text-center">
                <h5 class="pt-2">Reset Your Password</h5>
            </div>
        </div>
        @if ($errors->any())
            <div class="row">
                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
            </div>
        @endif

        <div class="row mt-4 justify-content-center gap-3">
            <div class="col col-md-5 mt-3">
                <div class="card p-4 shadow">
                    <form class="text-start" autocomplete="off"
                        @if ($request->get('role') == 'editor') action="{{ route('reset-password-editor') }}"
                    @elseif ($request->get('role') == 'admin')
                    action="{{ route('reset-password-admin') }}"
                    @else
                    action="{{ route('reset-password-mentor') }}" @endif
                        method="POST">
                        <input type="hidden" name="reset_token" value="{{ $request->get('token') }}">
                        <input type="hidden" name="email" value="{{ $request->get('email') }}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="d-flex flex-column">
                                    <div class="col">
                                        <label for="password" class="form-label">New Password <i
                                                class="text-danger">*</i></label>
                                        <input type="password" class="form-control" autocomplete="off" name="password"
                                            readonly onfocus="this.removeAttribute('readonly')">
                                        @error('password')
                                            <div class="alert text-danger fs-10">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col mt-3">
                                        <label for="confirmationPassword" class="form-label">Confirmation New Password
                                            <i class="text-danger">*</i></label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            readonly onfocus="this.removeAttribute('readonly')">
                                        @error('password_confirmation')
                                            <div class="alert text-danger fs-10">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center mt-4">
                            <div class="col">
                                <button id="submit-btn" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Role --}}

    {{-- Footer --}}
    <footer class="container-fluid pt-5 footer">
        <div class="row px-md-5 px-3 mb-4 justify-content-evenly">
            <div class="col-md-3 about mb-md-3 mb-4">
                <h5 class="mb-4">About Us</h5>
                <img src="/assets/logo.png" alt="" width="160" height="26" style="filter: saturate(0)">
                <p class="mt-3">We guide students who plan to study at top universities abroad and place them at
                    their best-fit schools.</p>
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
                    <a href="https://www.youtube.com/channel/UCLZ0P-RRdr7k5j2dxhNlObg" target="_blank"
                        style="width: auto">
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
    {{-- End Footer --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
