<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
    <title>Essay Editing Portal</title>
    <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>
    <link rel="stylesheet" href="/css/per-editor/utama.css">
    <link rel="stylesheet" href="/css/per-editor/dashboard.css">

    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" defer></script>


    {{-- Selectize --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://kit.fontawesome.com/76ac67da65.js" crossorigin="anonymous"></script>

    @yield('css')

</head>

<body>
    <audio id="myAudio">
        <source src="{{ asset('assets/sound/notify.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    @yield('content')
    {{-- Footer --}}
    <footer class="container-fluid footer">
        <div class="col-md-5 mx-auto text-center py-2 copyright">
            <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
        </div>
    </footer>
    {{-- End Footer --}}

    {{-- <script src={{ asset('js/bootstrap.js') }}></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="/js/per-editor/per-editor.js"></script>
    <script>
        var main = document.getElementById('main');
        let height = window.innerHeight;
        main.style.minHeight = height + "px";
    </script>
    @yield('js')
    @include('component.loading')

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="/js/toast.js"></script>
    <script>
        // Pusher.logToConsole = true;

        var pusher = new Pusher('174254d6ea94361b0744', {
            cluster: 'ap1',
            encrypted: true
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('editor');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('my-event', function(data) {
            let authEmail = '{{ Auth::guard('web-editor')->user()->email }}'
            if (data.email == authEmail) {
                Notif(data.message)
                var x = document.getElementById("myAudio");
                x.play();
            }
        });
    </script>
</body>

</html>
