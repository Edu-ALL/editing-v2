@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/setting-universities.css">
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
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
                    {{-- Detail Student --}}
                    <div class="row">
                        @if (session()->has('delete-successful'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session()->get('delete-successful') }}
                            </div>
                        @endif

                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-5 d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/university.png" alt="">
                                    <h6>Universities</h6>
                                </div>
                                <div class="col-md-4 col-6 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/admin/setting/universities/add"><img src="/assets/add.png" alt=""></a>
                                </div>
                            </div>
                            <div class="container-fluid text-start px-3 py-2">
                                <table class="table" id="listuniversity" style="width: 100%">
                                    <thead class="text-nowrap">
                                        <tr>
                                            <th>No</th>
                                            <th>University Name</th>
                                            <th>Website</th>
                                            <th>Country</th>
                                            <th>Phone</th>
                                            <th>Address</th>
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
            $('#listuniversity').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-list-university') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'university_name',
                        name: 'university_name',
                        // class: 'text-center'
                    },
                    {
                        data: 'website',
                        name: 'website',
                        class: 'text-center'
                    },
                    {
                        data: 'country',
                        name: 'country',
                        class: 'text-center'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        class: 'text-center'
                    },
                    {
                        data: 'address',
                        name: 'address',
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
                            `/admin/setting/universities/detail/${data.id_univ}`;
                    });
                }
            });
        });
    </script>
@stop
