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
    <link rel="stylesheet" href="/css/editor/dashboard.css">
    <link rel="stylesheet" href="/css/editor/user-mentor.css">
    <link rel="stylesheet" href="/css/editor/user-student-detail.css">
    <link rel="stylesheet" href="/css/editor/user-editor-detail.css">
    @yield('css')
</head>

<body>
    {{-- @include('menu') --}}
    @yield('content')
    <footer class="container-fluid footer">
        <div class="col-md-5 mx-auto text-center py-2 copyright">
            <p>Copyright ©2022. <b>All-in Eduspace</b>. All Rights Reserved</p>
        </div>
    </footer>
    {{-- End Footer --}}
    
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="/js/editor/editor.js"></script>
    <script>
        var main = document.getElementById('main');
        let height = window.innerHeight;
        main.style.minHeight = height + "px";
    </script>
    @yield('js')
</body>

</html>
