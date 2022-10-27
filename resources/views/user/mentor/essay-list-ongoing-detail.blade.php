@extends('user.mentor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/essay-ongoing-detail.css">
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.mentor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.mentor.utama.head')
                <div class="container main-content m-0">
                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard profile">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/status.png" alt="">
                                <h6>Status</h6>
                            </div>
                            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center"
                                style="color: var(--black)">
                                <img class="img-status" src="/assets/status-edit.png" alt="">
                                <h6>{{ $essay->status->status_title }}</h6>
                                @if ($essay->status_essay_clients == '1' ||
                                    $essay->status_essay_clients == '2' ||
                                    $essay->status_essay_clients == '6' ||
                                    $essay->status_essay_clients == '8')
                                    <h6>Mentor : {{ $essay->editor->first_name . ' ' . $essay->editor->last_name }}
                                    </h6>
                                @else
                                @endif
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
                        </div>

                        <div class="col-md-8 col-12 p-0 userCard profile">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Student Detail</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/mentor/essay-list/ongoing"><img src="/assets/back.png" alt=""></a>
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
                                            <p>{{ $essay->client_by_id->address ? $essay->client_by_id->address : '-' }}</p>
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
                            <div class="row profile-editor px-md-4 py-md-4 px-3 py-4 mb-2"
                                style="overflow: auto !important">
                                <div
                                    class="col-md student-desc d-flex flex-column justify-content-center gap-lg-3 gap-2 ps-lg-3 px-2 border-0">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-3 col-4">
                                            <h6>Essay Title</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{{ $essay->program->program_name . ' (' . $essay->program->minimum_word . ' - ' . $essay->program->maximum_word . ' Words)' }}
                                            </p>
                                        </div>
                                    </div>
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
                                            <h6>Request (Editor)</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>
                                                @if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 5)
                                                    @if ($essay->editor != null)
                                                        {{ $essay->editor->first_name.' '.$essay->editor->last_name }}
                                                    @else
                                                        -
                                                    @endif
                                                @else
                                                    {{ $essay->editor->first_name.' '.$essay->editor->last_name }}
                                                @endif
                                            </p>
                                            {{-- <p>{{ $essay->editor->first_name . ' ' . $essay->editor->last_name }}</p> --}}
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
                                            <h6>Essay Prompt</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{!! $essay->essay_prompt ? $essay->essay_prompt : '-' !!}</p>
                                        </div>
                                    </div>
                                    <div class="row d-flex">
                                        <div class="col-md-3 col-4">
                                            <h6>Date</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7 ps-3">
                                            <ul class="d-flex flex-column gap-2">
                                                <li>
                                                    <p><b>Essay Deadline</b> :
                                                        {{ date('D, d M Y', strtotime($essay->essay_deadline)) }}</p>
                                                </li>
                                                <li>
                                                    <p><b>Application Deadline</b> :
                                                        {{ date('D, d M Y', strtotime($essay->application_deadline)) }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex py-3 mt-4" style="border-top: 1px solid var(--light-grey)">
                                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                    @if ($essay->status_essay_clients == '0' ||
                                        $essay->status_essay_clients == '4' ||
                                        $essay->status_essay_clients == '5')
                                        <form
                                            action="{{ route('mentor-essay-delete', ['id' => $essay->id_essay_clients]) }}"
                                            method="POST" class="p-0">
                                            @csrf
                                            <button class="btn btn-download d-flex align-items-center gap-2"
                                                style="background-color: var(--red)">
                                                <img src="/assets/exit.png" alt="">
                                                <h6>Delete</h6>
                                            </button>
                                        </form>
                                    @else
                                    @endif
                                    {{-- data-bs-toggle="modal" data-bs-target="#reject" --}}
                                    {{-- <button class="btn btn-download d-flex align-items-center gap-2" data-bs-toggle="modal"
                                        data-bs-target="#reject" style="background-color: var(--red)">
                                        <img src="/assets/exit.png" alt="">
                                        <h6>Reject</h6>
                                    </button> --}}
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
    <div class="modal fade" id="reject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog d-flex align-items-center justify-content-center">
            <div class="modal-content border-0 w-100">
                <div class="modal-header" style="background-color: var(--blue)">
                    <div class="col d-flex gap-1 align-items-center">
                        <img src="/assets/danger.png" alt="">
                        <h6 class="modal-title ms-3">Reject</h6>
                    </div>
                    <div type="button" data-bs-dismiss="modal" aria-label="Close">
                        <img src="/assets/close.png" alt="" style="height: 26px">
                    </div>
                </div>
                <div class="modal-body px-4 py-4">
                    <form action="{{ route('reject-essay', ['id_essay' => $essay->id_essay_clients]) }}" method="POST"
                        class="p-0">
                        @csrf
                        <h6 style="font-size: 14px">Notes :</h6>
                        <textarea name="notes" class="textarea" style="overflow: auto !important"></textarea>
                        <div class="col d-flex align-items-center justify-content-center mt-3">
                            <button class="btn btn-download d-flex align-items-center justify-content-center gap-2"
                                style="background-color: var(--red)">
                                <img src="/assets/exit.png" alt="">
                                <h6 class="mb-0">Reject</h6>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
