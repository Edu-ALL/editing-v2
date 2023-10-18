@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/per-editor/dashboard.css">
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard profile" style="cursor: default">
                            {{-- Essay Status --}}
                            <div class="col">
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/status.png" alt="">
                                    <h6>Status</h6>
                                </div>
                                <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center"
                                    style="color: var(--black)">
                                    @if ($essay->status->status_title == 'Assigned' || $essay->status->status_title == 'Revise')
                                        <img class="img-status" src="/assets/status-edit.png" alt="">
                                    @elseif ($essay->status->status_title == 'Ongoing' || $essay->status->status_title == 'Submitted' || $essay->status->status_title == 'Revised')
                                        <img class="img-status" src="/assets/status-ongoing.png" alt="">
                                    @elseif ($essay->status->status_title == 'Completed')
                                        <img class="img-status" src="/assets/status-complete.png" alt="">
                                    @endif
                                    <h6>{{ $essay->status->status_title }}</h6>
                                </div>
                            </div>
                            @include('user.editor.essay-list.editors-deadline.index')
                            {{-- Download Essay --}}
                            <div class="col">
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
                            </div>
                            @if ($essay->status_essay_clients == 7)
                                @include('user.editor.essay-list.completed.index')
                            @endif
                        </div>

                        <div class="col-md-8 col-12 p-0 userCard profile" style="cursor: default">
                            {{-- Student Detail --}}
                            <div class="col">
                                <div class="headline d-flex justify-content-between">
                                    <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                        <img src="/assets/student.png" alt="">
                                        <h6>Student Detail</h6>
                                    </div>
                                    <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                        <a href="/editor/essay-list"><img src="/assets/back.png" alt=""></a>
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
                                        <div class="row d-flex">
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
                            </div>
                            {{-- Essay Detail --}}
                            <div class="col">
                                <div class="headline d-flex justify-content-between">
                                    <div class="col d-flex align-items-center gap-3">
                                        <img src="/assets/detail.png" alt="">
                                        <h6>Essay Detail</h6>
                                    </div>
                                </div>
                                <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-3"
                                    style="overflow: auto !important">
                                    <div
                                        class="col-md student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-lg-3 px-2 border-0">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-3 col-4">
                                                <h6>University Name</h6>
                                            </div>
                                            <div class="col-1 titik2">
                                                <p>:</p>
                                            </div>
                                            <div class="col-7">
                                                <p>{{ $essay->university->university_name }}</p>
                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-3 col-4">
                                                <h6>Essay Type</h6>
                                            </div>
                                            <div class="col-1 titik2">
                                                <p>:</p>
                                            </div>
                                            <div class="col-7">
                                                <p>{{ $essay->essay_title }}</p>
                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-3 col-4">
                                                <h6>Concern</h6>
                                            </div>
                                            <div class="col-1 titik2">
                                                <p>:</p>
                                            </div>
                                            <div class="col-7">
                                                <p>{!! $essay->essay_prompt ? $essay->essay_prompt : '-' !!}</p>
                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-3 col-4">
                                                <h6>Notes</h6>
                                            </div>
                                            <div class="col-1 titik2">
                                                <p>:</p>
                                            </div>
                                            <div class="col-7">
                                                <p>{!! $essay->essay_notes ? $essay->essay_notes : '-' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($essay->status_essay_clients == 1)
                                @include('user.editor.essay-list.accept-reject.index')
                            @elseif ($essay->status_essay_clients == 2)
                                @include('user.editor.essay-list.ongoing.index')
                            @elseif ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 8)
                                @include('user.editor.essay-list.submitted.index')
                            @elseif ($essay->status_essay_clients == 6)
                                @include('user.editor.essay-list.revise.index')
                            @elseif ($essay->status_essay_clients == 7)
                                @include('user.editor.essay-list.completed.alert-complete')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>

    @if ($essay->status_essay_clients == 1)
        @include('user.editor.essay-list.accept-reject.modal-reject')
    @elseif ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 8)
        @include('user.editor.essay-list.submitted.modal-info')
    @endif
@endsection

@section('js')
    @if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 8)
        <script>
            $(document).ready(function() {
                $("#info").modal('show');
            });
        </script>
    @endif
@endsection