@extends('user.per-editor.utama.utama')
@section('css')
    <style>
        .pagination {
            margin: 15px 0
        }

        .pagination .page-item .page-link {
            padding: 10px 15px;
            font-size: 12px;
        }

        .unread {
            font-weight: 600
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.per-editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow-x: auto !important">
                @include('user.per-editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row flex-column gap-4">
                        <div class="col p-0">
                            <div class="col-md col-12 p-0 userCard">
                                <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1">
                                    <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/ongoing-essay.png" alt="">
                                        <h6>List of Ongoing Essay</h6>
                                    </div>
                                </div>
                                <div class="container text-start px-3 py-2">
                                    <table class="table table-bordered" id="listessayongoing" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Student Name</th>
                                                <th>Mentor Name</th>
                                                <th>Editor Name</th>
                                                <th>Program Name</th>
                                                <th>Essay Title</th>
                                                <th>Upload Date</th>
                                                <th>Essay Deadline</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col p-0">
                            <div class="col-md col-12 p-0 userCard">
                                <div class="headline d-flex align-items-center px-md-4 px-3 py-3 gap-md-3 gap-1"
                                    style="background-color: var(--green);">
                                    <div class="col-md col-7 d-flex align-items-center gap-md-3 gap-2">
                                        <img src="/assets/completed-essay.png" alt="">
                                        <h6>List of Completed Essay</h6>
                                    </div>
                                </div>
                                <div class="container text-start px-3 py-2">
                                    <table class="table table-bordered" id="listessaycompleted" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Student Name</th>
                                                <th>Mentor Name</th>
                                                <th>Editor Name</th>
                                                <th>Program Name</th>
                                                <th>Essay Title</th>
                                                <th>Upload Date</th>
                                                <th>Essay Deadline</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#listessayongoing').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-essay-ongoing-editor') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                    },
                    {
                        data: 'student_name',
                        name: 'student_name',
                        class: 'text-center'
                    },
                    {
                        data: 'mentor_name',
                        name: 'mentor_name',
                        class: 'text-center'
                    },
                    {
                        data: 'editor_name',
                        name: 'editor_name',
                        class: 'text-center'
                    },
                    {
                        data: 'program',
                        name: 'program',
                        class: 'text-center'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        class: 'text-center'
                    },
                    {
                        data: 'upload_date',
                        name: 'upload_date',
                        class: 'text-center'
                    },
                    {
                        data: 'essay_deadline',
                        name: 'essay_deadline',
                        class: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        window.location.href =
                            `/editors/essay-list/ongoing/detail/${ data.id_essay_clients }`;
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#listessaycompleted').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('data-essay-completed-editor') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                    },
                    {
                        data: 'student_name',
                        name: 'student_name',
                        class: 'text-center'
                    },
                    {
                        data: 'mentor_name',
                        name: 'mentor_name',
                        class: 'text-center'
                    },
                    {
                        data: 'editor_name',
                        name: 'editor_name',
                        class: 'text-center'
                    },
                    {
                        data: 'program',
                        name: 'program',
                        class: 'text-center'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        class: 'text-center'
                    },
                    {
                        data: 'upload_date',
                        name: 'upload_date',
                        class: 'text-center'
                    },
                    {
                        data: 'essay_deadline',
                        name: 'essay_deadline',
                        class: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    },
                ],
                rowCallback: function(row, data) {
                    $(row).on('click', function() {
                        window.location.href =
                            `/editors/essay-list/completed/detail/${ data.id_essay_clients }`;
                    });
                }
            });
        });


        $("#form-ongoing-essay-searching").keypress(function(e) {
            if (e.keyCode === 13) {
                swal.showLoading();
                e.preventDefault();
                $("#form-ongoing-essay-searching").submit();
            }
        });
        $("#form-completed-essay-searching").keypress(function(e) {
            if (e.keyCode === 13) {
                swal.showLoading();
                e.preventDefault();
                $("#form-completed-essay-searching").submit();
            }
        });
        $(document).ready(function() {
            $("#info-essay").modal('show');
        });
    </script>
@stop
