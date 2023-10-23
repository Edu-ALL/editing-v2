@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/user-editor.css">
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
        }

        .alert {
            font-size: 14px;
            margin: 0 -12px 16px -12px
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.admin.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.admin.utama.head')
                <div class="container main-content m-0">

                    @if (session()->has('add-editor-successful'))
                        <div class="alert alert-success fade show d-flex justify-content-between" role="alert">
                            {{ session()->get('add-editor-successful') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-5 col-4 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/editor.png" alt="">
                                    <h6>Editors</h6>
                                </div>
                                <div class="col-md-5 col-7 d-flex align-items-center justify-content-end gap-md-2 gap-2">
                                    <a class="btn-add-editor" href="/admin/user/editor/add">
                                        <img src="/assets/add-people.png" alt="">
                                    </a>
                                    <a class="btn-invite" href="/admin/user/editor/invite">
                                        <img src="/assets/letter.png" alt="">
                                    </a>
                                    {{-- <div class="input-group">
                                        <form id="form-editor-searching" action="{{ route('list-editor') }}" method="GET"
                                            role="search" class="w-100">
                                            <input type="text" class="form-control inputField py-2 px-3" name="keyword"
                                                id="search-editor" placeholder="Search" required>
                                        </form>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table" id="listeditor" style="width: 100%">
                                    <thead class="text-nowrap">
                                        <tr>
                                            <th>No</th>
                                            <th>Editor Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Position</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End Table Student --}}
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        // List Editor
        $(document).ready(function() {
            $('#listeditor').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-editor') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'fullname',
                        name: 'fullname'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        window.location.href = `/admin/user/editor/detail/${data.id_editors}`;
                    });
                }
            });
        });
        // $("#search-editor").keypress(function(e) {
        //     if (e.keyCode === 13) {
        //         swal.showLoading();
        //         e.preventDefault();
        //         $("#form-editor-searching").submit();
        //     }
        // });
    </script>
@stop
