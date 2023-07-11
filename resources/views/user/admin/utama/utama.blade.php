<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/favicon.png" type="image/x-icon">
    <title>Essay Editing Portal</title>
    <link rel="stylesheet" href={{ asset('css/bootstrap.css') }}>

    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/h7t62ozvqkx2ifkeh051fsy3k9irz7axx1g2zitzpbaqfo8m/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" defer></script>

    {{-- Selectize --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')

</head>

<body>
    @yield('content')
    {{-- Footer --}}
    <footer class="container-fluid footer">
        <div class="col-md-5 mx-auto text-center py-2 copyright">
            <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
        </div>
    </footer>
    {{-- End Footer --}}

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="/js/admin/admin.js"></script>
    <script src="https://kit.fontawesome.com/76ac67da65.js" crossorigin="anonymous"></script>
    <script>
        var main = document.getElementById('main');
        let height = window.innerHeight;
        main.style.minHeight = height + "px";
    </script>
    @yield('js')
    @include('component.loading')
</body>

</html>
