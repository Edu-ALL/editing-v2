@extends('user.admin.utama.utama')
@section('css')
    @if ($essay->status_essay_clients == 7)
        <link rel="stylesheet" href="/css/admin/essay-completed-detail.css">
    @else
        <link rel="stylesheet" href="/css/admin/essay-ongoing-detail.css">
    @endif
    <style>
        .pagination {
            margin: 0
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
                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard profile">
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
                            @if ($essay->status_essay_clients == 1 || $essay->status_essay_clients == 2 || $essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 7 || $essay->status_essay_clients == 8)
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/assign.png" alt="">
                                    <h6>Assignment</h6>
                                </div>
                                <div class="col d-flex flex-column px-3 pt-md-4 pt-4 pb-4 text-center justify-content-center"
                                    style="color: var(--black)">
                                    <h6 style="font-size: 14px; font-weight: 400">
                                        {{ $essay->essay_editors->editor->first_name . ' ' . $essay->essay_editors->editor->last_name }}
                                    </h6>
                                </div>
                            @endif
                            @if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8 || $essay->status_essay_clients == 7)
                                <div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
                                    <img src="/assets/file.png" alt="">
                                    <h6>Download Editor Essay</h6>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                    <img class="img-word" src="/assets/logo-word.png" alt="">
                                </div>
                                <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                    @if ($essay->status_essay_clients == 8)
                                        <a class="btn btn-download d-flex align-items-center gap-2"
                                            href={{ asset('uploaded_files/program/essay/revised/' . $essay->essay_editors->attached_of_editors) }}>
                                            <img src="/assets/download.png" alt="">
                                            <h6>Download</h6>
                                        </a>
                                    @else
                                        <a class="btn btn-download d-flex align-items-center gap-2"
                                            href={{ asset('uploaded_files/program/essay/editors/' . $essay->essay_editors->attached_of_editors) }}>
                                            <img src="/assets/download.png" alt="">
                                            <h6>Download</h6>
                                        </a>
                                    @endif
                                </div>
                            @endif
                            @if ($essay->status_essay_clients == 7)
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/tags.png" alt="">
                                    <h6>Tags</h6>
                                </div>
                                <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center"
                                    style="color: var(--black)">
                                    <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center">
                                        @foreach ($tags as $tag)
                                            <div class="tags py-2 px-3 list-tags">
                                                <h6 style="font-size: 12px; font-weight: 400">#{{ $tag->tags->topic_name }}</h6>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @include('user.admin.essay-list.notes.index')
                            @include('user.admin.essay-list.essay-tracking.index')
                        </div>

                        <div class="col-md-8 col-12 p-0 userCard">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Student Detail</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href={{ $essay->status_essay_clients == 7 ? "/admin/essay-list/completed" : "/admin/essay-list/ongoing" }} ><img src="/assets/back.png" alt=""></a>
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
                                <div class="p-0">
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
                                            <div style="font-size: 12px">
                                                {!! $essay->essay_notes !!}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Deadline & Status Essay --}}
                                    @if ($essay->status_essay_clients == 7)
                                        <div class="col-12 d-flex flex-lg-row flex-column mb-3">
                                            <div class="col-lg-6 col d-flex mb-3">
                                                <div class="col-6">
                                                    <h6 class="pb-2">Essay Deadline :</h6>
                                                    <input type="text" class="form-control inputField py-2 px-3" disabled
                                                        value="{{ date('D, d M Y', strtotime($essay_editor->essay_clients->essay_deadline)) }}">
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="pb-2">Application Deadline :</h6>
                                                    <input type="text" class="form-control inputField py-2 px-3" disabled
                                                        value="{{ date('D, d M Y', strtotime($essay_editor->essay_clients->application_deadline)) }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col d-flex mb-3">
                                                <div class="col-6">
                                                    <h6 class="pb-2">Editor Upload :</h6>
                                                    <input type="text" class="form-control inputField py-2 px-3" disabled
                                                        value="{{ date('D, d M Y', strtotime($essay_editor->uploaded_at)) }}">
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="pb-2">Status Essay :</h6>
                                                    <input type="text" class="form-control inputField py-2 px-3" disabled
                                                        value="{{ $status_essay }}">
                                                </div>
                                            </div>
                                        </div>
                                    @else 
                                        <div class="col-12 d-flex mb-3">
                                            <div class="col-6">
                                                <h6 class="pb-2">Essay Deadline :</h6>
                                                <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ date('D, d M Y', strtotime($essay->essay_deadline)) }}">
                                            </div>
                                            <div class="col-6">
                                                <h6 class="pb-2">Application Deadline :</h6>
                                                <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ date('D, d M Y', strtotime($essay->application_deadline)) }}">
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Tags --}}
                                    @if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8)
                                    <div class="col-12 d-flex flex-lg-row flex-column mb-3">
                                        <div class="col">
                                            <div class="row flex-md-row flex-column-reverse">
                                                <div class="col p-0 mb-3">
                                                    <h6 class="pb-2">Tags :</h6>
                                                    <div class="col d-flex flex-wrap gap-1 list-tags pe-2">
                                                        @foreach ($tags as $tag)
                                                            <div class="tags py-2 px-3">
                                                                <h6 style="font-size: 12px; font-weight: 500">
                                                                    #{{ $tag->tags->topic_name }}</h6>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            {{-- Alert & Feedback Completed Essay --}}
                            @if ($essay->status_essay_clients == 7)
                                <div class="col d-flex flex-row alert-complete py-3 px-4" id="alertComplete">
                                    <div class="col d-flex align-items-center gap-2">
                                        <img src="/assets/thumbsup.png" alt="">
                                        <h6><b>Congratulations</b>, editor essay has been completed</h6>
                                    </div>
                                    <img src="/assets/exit.png" alt="" onclick="closeAlert()"
                                        style="cursor: pointer">
                                </div>
                                @include('user.admin.essay-list.essay-completed-feedback.index')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection