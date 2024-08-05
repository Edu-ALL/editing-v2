@extends('user.admin.utama.utama')
@section('css')
    {{-- <link rel="stylesheet" href="/css/admin/essay-ongoing.css"> --}}
    <link rel="stylesheet" href="/css/admin/user-editor.css">
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
                    {{-- Table Student --}}
                    <div class="row">
                        <div class="col-md col-12 p-0 studentList">
                            <div class="headline d-flex justify-content-between"
                            @if (request()->is('admin/essay-list/completed'))
                                style="background-color: var(--green)"
                            @endif
                            >
                                <div class="col-md-6 col-7 d-flex align-items-center gap-md-3 gap-2">
                                    @if (request()->is('admin/essay-list/ongoing'))
                                        <img src="/assets/ongoing-essay.png" alt="">
                                        <h6>List of Ongoing Essay</h6>
                                    @elseif (request()->is('admin/essay-list/completed'))
                                        <img src="/assets/completed-essay.png" alt="">
                                        <h6>List of Completed Essay</h6>
                                    @endif
                                </div>
                            </div>
                            <div class="container-fluid text-start px-3 py-2">
                                <table class="table" id="listessay" style="width: 100%">
                                    <thead class="text-nowrap">
                                        <tr>
                                            <th>No</th>
                                            <th>Student Name</th>
                                            <th>Mentor Name</th>
                                            <th>Editor Name</th>
                                            <th>Essay Title</th>
                                            <th>Essay Deadline</th>
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

    {{-- Modal Info --}}
    @if (session()->has('isEssay'))
        <div class="modal fade" id="info-essay" tabindex="-1" show>
            <div class="modal-dialog d-flex align-items-center justify-content-center">
                <div class="modal-content border-0 w-75">
                    <div class="modal-header" style="background-color: var(--red)">
                        <div class="col d-flex gap-1 align-items-center">
                            <img src="/assets/info.png" alt="">
                            <h6 class="modal-title ms-3">Alert</h6>
                        </div>
                        <div type="button" data-bs-dismiss="modal" aria-label="Close">
                            <img src="/assets/close.png" alt="" style="height: 26px">
                        </div>
                    </div>
                    <div class="modal-body text-center px-4 py-4 my-md-3">
                        <p>{{ session()->get('isEssay') }} <span style="color: var(--red)">*</span></p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var pathname = window.location.pathname;
        var route;
        if (pathname == '/admin/essay-list/ongoing') {
            route = '{{ route('data-ongoing-essay') }}'
        } else if (pathname == '/admin/essay-list/completed'){
            route = '{{ route('data-completed-essay') }}'
        }
        $('#listessay').DataTable({
            scrollX: true,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: route,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    data: 'student_name',
                    name: 'student_name'
                },
                {
                    data: 'mentor_name',
                    name: 'mentor_name'
                },
                {
                    data: 'editor_name',
                    name: 'editor_name'
                },
                {
                    data: 'essay_title',
                    name: 'essay_title'
                },
                {
                    data: 'essay_deadline',
                    name: 'essay_deadline'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ],
            rowCallback: function(row, data) {
                $(row).on('click', function() {
                    if (pathname == '/admin/essay-list/ongoing') {
                        window.open(`/admin/essay-list/ongoing/detail/${data.id_essay_clients }`, '_blank');
                        // window.location.href = `/admin/essay-list/ongoing/detail/${data.id_essay_clients }`;
                    } else if (pathname == '/admin/essay-list/completed'){
                        window.open(`/admin/essay-list/completed/detail/${data.id_essay_clients }`, '_blank');
                        // window.location.href = `/admin/essay-list/completed/detail/${data.id_essay_clients }`;
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#info-essay").modal('show');
    });
</script>
@stop
