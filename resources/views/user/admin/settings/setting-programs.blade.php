@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/setting-programs.css">
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
        }

        .alert {
            font-size: 14px
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

                    @if (session()->has('add-program-successful'))
                        <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                            {{ session()->get('add-program-successful') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(session()->has('delete-program-successful'))
                        <div class="row alert alert-success fade show d-flex justify-content-between" role="alert">
                            {{ session()->get('delete-program-successful') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Detail Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/program.png" alt="">
                                    <h6>Programs</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/admin/setting/programs/add"><img src="/assets/add.png" alt=""></a>

                                </div>
                            </div>
                            <div class="container text-start px-3 py-2">
                                <table class="table table-bordered" id="listcategory" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Program Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Max Word</th>
                                            <th>Completed Within</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End Detail Student --}}
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#listcategory').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-list-program') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'program_name',
                        name: 'program_name',
                        class: 'text-center'
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'price',
                        name: 'price',
                        class: 'text-center'
                    },
                    {
                        data: 'maximum_word',
                        name: 'maximum_word',
                        class: 'text-center'
                    },
                    {
                        data: 'completed_within',
                        name: 'completed_within',
                        class: 'text-center'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        class: 'text-center'
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        window.location.href =
                            `/admin/setting/programs/detail/${data.id_program}`;
                    });
                }
            });
        });
    </script>
@stop
