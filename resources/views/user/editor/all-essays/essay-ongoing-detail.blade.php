@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/essay-ongoing-detail.css">
    @if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8)
        <link rel="stylesheet" href="/css/per-editor/dashboard.css">
    @endif
    <style>
        .dataTables_scroll .dataTables_scrollHeadInner {
            width: auto !important;
        }
        .dataTables_scroll .dataTables_scrollHeadInner .table.m-0.dataTable.no-footer {
            width: 100% !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard profile" style="cursor: default">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/status.png" alt="">
                                <h6>Status</h6>
                            </div>
                            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center"
                                style="color: var(--black)">
                                @if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8)
                                    <img class="img-status" src="/assets/status-ongoing.png" alt="">
                                @else
                                    <img class="img-status" src="/assets/status-edit.png" alt="">
                                @endif
                                <h6>{{ $essay->status->status_title }}</h6>
                            </div>
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/file.png" alt="">
                                <h6>Download Student Essay</h6>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                <img class="img-word" src="/assets/logo-word.png" alt="">
                            </div>
                            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                <a class="btn btn-download d-flex align-items-center gap-2"
                                    href={{ asset('uploaded_files/program/essay/students/' . $essay->attached_of_clients) }}>
                                    <img src="/assets/download.png" alt="">
                                    <h6>Download</h6>
                                </a>
                            </div>

                            {{-- Info Editor --}}
                            @if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5)
                                @include('user.editor.all-essays.not-assigned.info-editor')
                            @elseif ($essay->status_essay_clients == 1 || $essay->status_essay_clients == 2)
                                @include('user.editor.all-essays.assigned.info-editor')
                            @endif

                            {{-- Notes --}}
                            @include('user.editor.all-essays.notes.index')

                            @include('user.editor.all-essays.essay-tracking.index')
                        </div>

                        <div class="col-md-8 col-12 p-0 userCard" style="cursor: default">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Student Detail</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/editor/all-essays/not-assign-essay-list"><img src="/assets/back.png"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-2"
                                style="overflow: auto !important">
                                <div
                                    class="col-md student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-lg-3 px-2 border-0">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Full Name</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $essay->client_by_id->first_name . ' ' . $essay->client_by_id->last_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Email</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $essay->client_by_id->email ? $essay->client_by_id->email : '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Address</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{!! $essay->client_by_id->address ? $essay->client_by_id->address : '-' !!}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="headline d-flex justify-content-between">
                                <div class="col d-flex align-items-center gap-3">
                                    <img src="/assets/detail.png" alt="">
                                    <h6>Essay Detail</h6>
                                </div>
                            </div>
                            <div class="row profile-editor px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
                                <form action="" class="p-0">
                                    <div class="col-12 d-flex mb-3">
                                        <div class="col-6">
                                            <h6 class="pb-2">University Name :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $essay->university->university_name }}">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Essay Title :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $essay->essay_title }}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                                        <div class="col">
                                            <h6 class="pb-2">Concern :</h6>
                                            <textarea name="" class="textarea" style="overflow: auto !important">{{ $essay->essay_prompt }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                                        <div class="col">
                                            <h6 class="pb-2">Notes :</h6>
                                            <div style="font-size:12px">{!! $essay->essay_notes !!}</div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-3">
                                        <div class="col-6">
                                            <h6 class="pb-2">Essay Deadline :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Application Deadline :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ date('D, d M Y', strtotime($essay->application_deadline)) }}">
                                        </div>
                                    </div>
                                    @if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8)
                                        @include('user.editor.all-essays.submitted-revise-revised.index')
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>

    {{-- Modal --}}
    @if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5)
        @include('user.editor.all-essays.not-assigned.select-editor')
    @elseif ($essay->status_essay_clients == 1)
        @include('user.editor.all-essays.assigned.modal-info')
    @endif
@endsection

@section('js')
    @if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5)
    <script>
        // List Editor
        $(document).ready(function() {
            $('#listeditor').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('managing-data-list-editor') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        data: 'editor_name',
                        name: 'editor_name'
                    },
                    {
                        data: 'graduated_from',
                        name: 'graduated_from'
                    },
                    {
                        data: 'dueTomorrow',
                        name: 'dueTomorrow'
                    },
                    {
                        data: 'dueThree',
                        name: 'dueThree'
                    },
                    {
                        data: 'dueFive',
                        name: 'dueFive'
                    },
                    {
                        data: 'completed_essay',
                        name: 'completed_essay'
                    },
                    {
                        data: 'assign',
                        name: 'assign',
                        class: 'text-center'
                    },
                ]
            });
        });
        function select_row(cb) {
            $(cb).find('input[type=radio]').prop("checked", true)
        }
    </script>
    @endif

    @if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8)
    <script>
        function checkUpload() {
            var check = document.getElementById('myCheck');
            var input = document.getElementById('inputField');
            var notes = document.getElementById('notesField');
            var upload = document.getElementById('uploadAcc');
            if (check.checked == true) {
                input.classList.remove("d-none");
                notes.classList.remove("d-none");
                upload.required = true;
            } else {
                input.classList.add("d-none");
                notes.classList.add("d-none");
                upload.required = false;
            }
        }
    </script>
    @endif

    <script>
        $(document).ready(function() {
            $("#info").modal('show');
        });
    </script>
@endsection
