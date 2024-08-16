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
    <link rel="stylesheet" href="/css/editor/utama.css">
    <link rel="stylesheet" href="/css/editor/dashboard.css">
    <link rel="stylesheet" href="/css/editor/user-editor-detail.css">
    {{-- <link rel="stylesheet" href="/css/editor/user-mentor.css"> --}}
    {{-- <link rel="stylesheet" href="/css/editor/user-student-detail.css"> --}}

    {{-- TinyMCE --}}
    <!--<script src="https://cdn.tiny.cloud/1/665k5cso7x9x0errf1h417cn6fgnxs67ayozubvhomg0vony/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>-->
    <!--<script src="https://cdn.tiny.cloud/1/6rtskj4e67x7o5h9g4gu406k5ba49e4fzsjcgw2v5ueihahb/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>-->


    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" defer></script>

    {{-- Selectize --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        #main {
            min-height: 100vh;
        }

        .main-content {
            max-width: 100%;
        }

        /* This selector targets the editable element (excluding comments). */
        .ck-editor__editable_inline:not(.ck-comment__input *) {
            min-height: 200px;
            overflow-y: auto;
        }
    </style>
    @yield('css')
</head>

<body>
    {{-- @include('menu') --}}
    <audio id="myAudio">
        <source src="{{ asset('assets/sound/notify.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    @yield('content')
    <footer class="container-fluid footer">
        <div class="col-md-5 mx-auto text-center py-2 copyright">
            <p>Copyright ©{{ date('Y') }}. <b>{{ env('COMPANY_NAME') }}</b>. All Rights Reserved</p>
        </div>
    </footer>
    {{-- End Footer --}}

    {{-- <script src="{{ asset('js/bootstrap.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="/js/editor/editor.js"></script>
    <script src="https://kit.fontawesome.com/76ac67da65.js" crossorigin="anonymous"></script>
    {{-- Editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        var myEditor;

        document.querySelectorAll('textarea').forEach(function(element) {
            ClassicEditor
                .create(element, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                        'blockQuote'
                    ],
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading1',
                                view: 'h1',
                                title: 'Heading 1',
                                class: 'ck-heading_heading1'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Heading 2',
                                class: 'ck-heading_heading2'
                            }
                        ]
                    }
                })
                .then(editor => {
                    console.log('Editor was initialized', editor);
                    myEditor = editor;
                })
                .catch(error => {
                    console.error(error);
                });
        })
    </script>
    @yield('js')
    @include('component.loading')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="/js/toast.js"></script>
    <script>
        // Pusher.logToConsole = true;

        var pusher = new Pusher('97a0f1eef16c63cea1ff', {
            cluster: 'ap1',
            encrypted: true
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('managing');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('my-event', function(data) {
            Notif(data.message)
            var x = document.getElementById("myAudio");
            x.play();
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channelEditor = pusher.subscribe('editor');

        // Bind a function to a Event (the full Laravel class)
        channelEditor.bind('my-event', function(data) {
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
