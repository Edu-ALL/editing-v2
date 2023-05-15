@extends('user.admin.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/setting-essay-prompt.css">
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

                    @if (session()->has('add-prompt-successful'))
                        <div class="alert alert-success fade show d-flex justify-content-between" role="alert">
                            {{ session()->get('add-prompt-successful') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('delete-prompt-successful'))
                        <div class="alert alert-success fade show d-flex justify-content-between" role="alert">
                            {{ session()->get('delete-prompt-successful') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Detail Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col d-flex align-items-center gap-md-3 gap-2">
                                    <img src="/assets/essay-prompt.png" alt="">
                                    <h6>Essay Prompt</h6>
                                </div>
                                <div class="col-md-4 col-auto d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/admin/setting/essay-prompt/add"><img src="/assets/add.png" alt=""></a>

                                </div>
                            </div>
                            <div class="container text-start px-3 py-2" style="overflow-x: auto !important">
                                <table class="table table-bordered" id="listessayprompt" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>University Name</th>
                                            <th>Description</th>
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
            $('#listessayprompt').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-list-essay-prompt') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        class: 'text-center'
                    },
                    {
                        data: 'university_name',
                        name: 'university_name',
                        class: 'text-center'
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        window.location.href =
                            `/admin/setting/essay-prompt/detail/${data.id_essay_prompt}`;
                    });
                }
            });
        });
    </script>
@stop
