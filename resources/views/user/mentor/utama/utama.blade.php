<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
    <title>Essay Editing Portal</title>
    <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
    {{-- <link rel="stylesheet" href="/css/mentor/dashboard.css"> --}}

    {{-- <link rel="stylesheet" href="/css/admin/user-editor-detail.css"> --}}
    {{-- <link rel="stylesheet" href="/css/admin/essay-ongoing-detail.css"> --}}
    @yield('css')
    {{-- Selectize --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.min.js"></script>

    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .fs-10 {
            font-size: 10px;
        }
    </style>
</head>

<body>
    @if (session()->has('delete-essay-successful') || session()->has('message'))
        <div class="modal fade" id="notif" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog d-flex align-items-center justify-content-center">
                <div class="modal-content border-0 w-75">
                    <div class="modal-header">
                        <div class="col d-flex gap-1 align-items-center">
                            <img src="/assets/info.png" alt="">
                            <h6 class="modal-title ms-3">Notification</h6>
                        </div>
                        <div type="button" data-bs-dismiss="modal" aria-label="Close">
                            <img src="/assets/close.png" alt="" style="height: 26px">
                        </div>
                    </div>
                    <div class="modal-body text-center px-4 py-4 my-md-3">
                        <p> {{ session()->get('delete-essay-successful') !== NULL ? session()->get('delete-essay-successful') : session()->get('message') }} <span style="color: var(--red)">*</span></p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- @include('menu') --}}
    <audio id="myAudio">
        <source src="{{ asset('assets/sound/notify.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    @yield('content')
    <footer class="container-fluid footer">
        <div class="col-md-5 mx-auto text-center py-2 copyright">
            <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
        </div>
    </footer>
    {{-- End Footer --}}

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="/js/mentor/mentor.js"></script>
    <script src="https://kit.fontawesome.com/76ac67da65.js" crossorigin="anonymous"></script>
    <script>
        var main = document.getElementById('main');
        let height = window.innerHeight;
        main.style.minHeight = height + "px";            
    </script>
    @if (session()->has('delete-essay-successful') || session()->has('message'))
    <script>
        $(document).ready(function(){
            $("#notif").modal('show');
        });
    </script>
    @endif
    @yield('js')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="/js/toast.js"></script>
    <script>
        // Pusher.logToConsole = true;
        var pusher = new Pusher('174254d6ea94361b0744', {
            cluster: 'ap1',
            encrypted: true
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('mentor');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('my-event', function(data) {
            let authEmail = '{{ Auth::guard('web-mentor')->user()->email }}'
            if (data.email == authEmail) {
                Notif(data.message)
                var x = document.getElementById("myAudio");
                x.play();
            }
        });
    </script>

</body>

</html>
