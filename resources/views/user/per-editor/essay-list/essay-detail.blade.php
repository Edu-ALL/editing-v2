@extends('user.per-editor.utama.utama')

@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.per-editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                @include('user.per-editor.utama.head')
                <div class="container main-content m-0">
                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard profile">
                            {{-- Start Section: Status --}}
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/status.png" alt="">
                                <h6>Status</h6>
                            </div>
                            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center"
                                style="color: var(--black)">
                                <img class="img-status" src="/assets/status-ongoing.png" alt="">
                                <h6>{{ $essay->status->status_title }}</h6>
                            </div>
                            {{-- End Section: Status --}}

                            {{-- Start Section: Deadline --}}
                            <div class="card border-0">
                                <div
                                    class="card-header p-3 d-flex justify-content-between align-items-center bg-secondary text-white">
                                    Deadline
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>
                                <div class="card-body p-3 text-dark">
                                    <div class="row" style="font-size: 14px;">
                                        <div class="col-md-7">
                                            <i class="fa-solid fa-calendar-day me-1 text-primary"></i> Essay Deadline:
                                        </div>
                                        <div class="col-md-5 text-md-end">
                                            {{ date('D, d M Y', strtotime($editors_deadline)) }}
                                        </div>
                                        <div class="col-md-7">
                                            <i class="fa-solid fa-calendar-check me-1 text-primary"></i>
                                            Application Deadline:
                                        </div>
                                        <div class="col-md-5 text-md-end">
                                            {{ date('D, d M Y', strtotime($essay->application_deadline)) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Section: Deadline --}}

                            {{-- Start Section: Download Student Essay --}}
                            @if ($essay_status != 'assigned')
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
                            @endif
                            {{-- End Section: Download Student Essay --}}

                            @if ($essay_status == 'completed')
                                {{-- Start Section : Download Your File --}}
                                <div class="headline d-flex align-items-center gap-3"
                                    style="background-color: var(--yellow)">
                                    <img src="/assets/file.png" alt="">
                                    <h6>Download Your File</h6>
                                </div>
                                <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                    <img class="img-word" src="/assets/logo-word.png" alt="">
                                </div>
                                <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                    @if ($essay_editor->managing_file)
                                        <a class="btn btn-download d-flex align-items-center gap-2"
                                            href={{ asset('uploaded_files/program/essay/revised/' . $essay_editor->managing_file) }}>
                                            <img src="/assets/download.png" alt="">
                                            <h6>Download</h6>
                                        </a>
                                    @else
                                        @if (str_contains($essay_editor->attached_of_editors, 'Revised'))
                                            <a class="btn btn-download d-flex align-items-center gap-2"
                                                href={{ asset('uploaded_files/program/essay/revised/' . $essay_editor->attached_of_editors) }}>
                                                <img src="/assets/download.png" alt="">
                                                <h6>Download</h6>
                                            </a>
                                        @else
                                            <a class="btn btn-download d-flex align-items-center gap-2"
                                                href={{ asset('uploaded_files/program/essay/editors/' . $essay_editor->attached_of_editors) }}>
                                                <img src="/assets/download.png" alt="">
                                                <h6>Download</h6>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                {{-- END Section : Download Your File --}}

                                {{-- Start Section : Tags --}}
                                <div class="headline d-flex align-items-center gap-3">
                                    <img src="/assets/tags.png" alt="">
                                    <h6>Tags</h6>
                                </div>
                                <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center"
                                    style="color: var(--black)">
                                    <div class="col d-flex flex-row flex-wrap gap-2 justify-content-center">
                                        @foreach ($tags as $tag)
                                            <div class="tags py-2 px-3 list-tags">
                                                <h6 style="font-size: 12px; font-weight: 500">#{{ $tag->tags->topic_name }}
                                                </h6>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- END Section : Tags --}}
                            @endif

                        </div>
                        <div class="col-md-8 col-12 p-0 userCard profile">
                            {{-- Start Section: Student Detail --}}
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Student Detail</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/editors/essay-list"><img src="/assets/back.png" alt=""></a>
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
                            {{-- End Section: Student Detail --}}

                            {{-- Start Section: Essay Detail --}}
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
                                            <h6>Essay Prompt</h6>
                                        </div>
                                        <div class="col-1 titik2">
                                            <p>:</p>
                                        </div>
                                        <div class="col-7">
                                            <p>{!! $essay->essay_prompt !!}</p>
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
                                    {{-- <div class="row d-flex">
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
                                    </div> --}}
                                </div>
                            </div>
                            {{-- End Section: Essay Detail --}}

                            @if ($essay_status == 'assigned')
                                {{-- Start Section: Confirmation Essay --}}
                                <div class="col-12 d-flex py-3 mt-4" style="border-top: 1px solid var(--light-grey)">
                                    <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                        <form
                                            action="{{ route('accept-essay', ['id_essay' => $essay->id_essay_clients]) }}"
                                            method="POST" class="p-0">
                                            @csrf
                                            <button class="btn btn-download d-flex align-items-center gap-2"
                                                style="background-color: var(--green)">
                                                <img src="/assets/assign-list.png" alt="">
                                                <h6>Accept</h6>
                                            </button>
                                        </form>
                                        <button class="btn btn-download d-flex align-items-center gap-2"
                                            data-bs-toggle="modal" data-bs-target="#reject"
                                            style="background-color: var(--red)">
                                            <img src="/assets/exit.png" alt="">
                                            <h6>Reject</h6>
                                        </button>
                                    </div>
                                </div>
                                {{-- End Section: Confirmation Essay --}}
                            @endif

                            @if ($essay_status == 'submitted' || $essay_status == 'revised')
                                {{-- Start Section: Download Your File --}}
                                <div class="headline d-flex justify-content-between">
                                    <div class="col d-flex align-items-center gap-3">
                                        <img src="/assets/file.png" alt="">
                                        <h6>Download Your File</h6>
                                    </div>
                                </div>
                                <div class="row field px-md-3 py-md-4 px-3 py-4" style="overflow: auto !important">
                                    <form action="" class="p-0">
                                        <div class="col-12 d-flex flex-md-row flex-column gap-4 mb-3">
                                            <div class="col-md-4 col px-2">
                                                <div class="col mb-3">
                                                    <h6 class="pb-2">Your Essay :</h6>
                                                    <div
                                                        class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                                        <img class="img-word" src="/assets/logo-word.png" alt="">
                                                    </div>
                                                    <div
                                                        class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
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
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="col pb-3" style="border-bottom: 1px solid var(--light-grey)">
                                                    <h6 class="pb-3">Tags :</h6>
                                                    <div class="col d-flex flex-wrap gap-1 list-tags pe-2">
                                                        @foreach ($tags as $tag)
                                                            <div class="tags py-2 px-3">
                                                                <h6 style="font-size: 12px; font-weight: 500">
                                                                    #{{ $tag->tags->topic_name }}</h6>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col d-flex flex-row alert-complete py-3 px-4 mt-3"
                                                    id="alertComplete"
                                                    style="border-radius: 10px; background-color: var(--yellow)">
                                                    <div class="col d-flex align-items-center gap-2">
                                                        <img src="/assets/danger.png" alt="">
                                                        <h6>Your Essay has being Reviewed</h6>
                                                    </div>
                                                    <img src="/assets/exit.png" alt="" onclick="closeAlert()"
                                                        style="cursor: pointer">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- End Section: Download Your File --}}
                            @endif

                            @if ($essay_status == 'ongoing')
                                {{-- Start Section : Upload Your File --}}
                                <div class="headline d-flex justify-content-between">
                                    <div class="col d-flex align-items-center gap-3">
                                        <img src="/assets/file.png" alt="">
                                        <h6>Upload Your File</h6>
                                    </div>
                                </div>

                                <div>
                                    @if ($errors->any())
                                        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                                    @endif
                                </div>
                                <form action="{{ route('upload-essay', ['id_essay' => $essay->id_essay_clients]) }}"
                                    class="p-0" id="form-essay" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row field px-2 py-md-4 py-4" style="overflow: auto !important">
                                        <div class="col-12 d-flex flex-md-row flex-column mb-md-3 mb-2 gap-md-0 gap-3">
                                            <div class="col-md-6 col">
                                                <h6 class="pb-2">Upload Your File :</h6>
                                                <div class="col" id="chooseFile">
                                                    <div class="h-100">
                                                        <input class="form-control form-control-sm inputField h-100"
                                                            id="formFileSm" name="uploaded_file" form="form-essay"
                                                            type="file">
                                                    </div>
                                                    @error('uploaded_file')
                                                        <div class="pt-1 text-danger" style="font-size: 10px">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <h6 class="pt-2" style="font-size: 10px; color: var(--red)">* Upload
                                                        your
                                                        essay with the '.docx' format</h6>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col">
                                                <h6 class="pb-2">Work Duration (Time spent on editing essay) :</h6>
                                                <div class="input-group">
                                                    <input type="number" name="work_duration"
                                                        class="form-control py-2 px-3" aria-describedby="basic-addon1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text py-2 px-2"
                                                            id="basic-addon1">Minutes</span>
                                                    </div>
                                                </div>
                                                @error('work_duration')
                                                    <div class="pt-1 text-danger" style="font-size: 10px">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex mb-3">

                                            <div class="col">
                                                <h6 class="pb-2">Tags :</h6>
                                                <select class="select-state" name="tag[]" id="tag">
                                                    <option value=""></option>
                                                    @foreach ($tags as $tags)
                                                        <option value="{{ $tags->id_topic }}">{{ $tags->topic_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tag')
                                                    <div class="pt-1 text-danger" style="font-size: 10px">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex mb-2" style="overflow: auto !important">
                                            <div class="col">
                                                <h6 class="pb-2">Descriptions :</h6>
                                                <textarea name="description" class="textarea" placeholder="Descriptions"></textarea>
                                                @error('description')
                                                    <div class="pt-1 text-danger" style="font-size: 10px">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex py-3 mt-4" style="border-top: 1px solid var(--light-grey)">
                                        <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                            <button class="btn btn-download d-flex align-items-center gap-2"
                                                style="background-color: var(--blue)">
                                                <img src="/assets/upload.png" alt="">
                                                <h6>Upload Your File</h6>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                {{-- End Section : Upload Your File --}}
                            @endif

                            @if ($essay_status == 'revise')
                                {{-- Start Section : Old Essay --}}
                                <div class="headline d-flex justify-content-between">
                                    <div class="col d-flex align-items-center gap-3">
                                        <img src="/assets/file.png" alt="">
                                        <h6>Old Essay</h6>
                                    </div>
                                </div>
                                <div class="row field px-md-3 pt-md-4 px-3 pt-4" style="overflow: auto !important">
                                    <div class="col-12 d-flex flex-lg-row flex-column px-0 gap-2 mb-3">
                                        <div class="col-lg-4 col px-2">
                                            <div class="col pb-4">
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
                                            <div class="col mb-3">
                                                <h6 class="pb-2">Your Old Essay :</h6>
                                                <div
                                                    class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                                    <img class="img-word" src="/assets/logo-word.png" alt="">
                                                </div>
                                                <div
                                                    class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                                    <a class="btn btn-download d-flex align-items-center gap-2"
                                                        href={{ asset('uploaded_files/program/essay/editors/' . $essay->essay_editors->attached_of_editors) }}>
                                                        <img src="/assets/download.png" alt="">
                                                        <h6>Download</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-12 d-flex mb-3" style="overflow: auto !important">
                                                <div class="col w-100">
                                                    <h6 class="pb-2">Notes :</h6>
                                                    <div class="chat-messages p-3 w-100">
                                                        @foreach ($essay_revise->reverse() as $revise)
                                                            @if ($revise->role == 'managing_editor')
                                                                <div class="chat-message-left pb-3">
                                                                    <div>
                                                                        <div
                                                                            class="text-muted d-none small text-nowrap mt-2">
                                                                            2:33 am</div>
                                                                    </div>
                                                                    <div
                                                                        class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3 mt-2">
                                                                        <p><b>{{ $revise->managing_editor->first_name . ' ' . $revise->managing_editor->last_name }}</b>
                                                                        </p>
                                                                        <p class="mb-2" style="font-size: 12px">Managing
                                                                            Editor</p>
                                                                        <p>{!! $revise->notes !!}</p>
                                                                        @if ($revise->role == 'managing_editor' && $revise->file)
                                                                            <p style="margin-top: -4px">
                                                                                <a class="d-block mt-2"
                                                                                    href="{{ asset('uploaded_files/program/essay/revise/' . $revise->file) }}"
                                                                                    style="color: var(--blue)"><img
                                                                                        src="/assets/download-blue.png"
                                                                                        alt="" width="14"
                                                                                        height="14"
                                                                                        style="margin-right: 2px"> Download
                                                                                    Attachment</a>
                                                                            </p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @elseif ($revise->role == 'editor')
                                                                <div class="chat-message-right pb-3">
                                                                    <div class="text-end">
                                                                        <div
                                                                            class="text-muted d-none small text-nowrap mt-2">
                                                                            2:34 am</div>
                                                                    </div>
                                                                    <div
                                                                        class="flex-shrink-1 text-end bg-light rounded py-2 px-3 ml-3 mt-2">
                                                                        <p><b>{{ $revise->editor->first_name . ' ' . $revise->editor->last_name }}</b>
                                                                        </p>
                                                                        <p class="mb-2" style="font-size: 12px">Editor
                                                                        </p>
                                                                        <p>{!! $revise->notes !!}</p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <form
                                                        action="{{ route('add-comment', ['id_essay' => $essay->id_essay_clients]) }}"
                                                        method="POST" class="p-0">
                                                        @csrf
                                                        <textarea name="comment" class="textarea" style="overflow: auto !important"></textarea>
                                                        <div
                                                            class="col d-flex align-items-center justify-content-center pt-3">
                                                            <button type="submit"
                                                                class="btn btn-download d-flex align-items-center gap-2"
                                                                style="background-color: var(--yellow)">
                                                                <img src="/assets/comment.png" alt="">
                                                                <h6>Comments</h6>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Section : Old Essay --}}

                                {{-- Start Section : Upload Your Revision --}}
                                <div class="headline d-flex justify-content-between">
                                    <div class="col d-flex align-items-center gap-3">
                                        <img src="/assets/file.png" alt="">
                                        <h6>Upload Your Revision</h6>
                                    </div>
                                </div>
                                <form action="{{ route('upload-revise', ['id_essay' => $essay->id_essay_clients]) }}"
                                    class="p-0" id="form-revise" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row field px-2 py-md-4 py-4" style="overflow: auto !important">
                                        <div class="col-12 d-flex flex-md-row flex-column mb-md-3 mb-2 gap-md-0 gap-3">
                                            <div class="col-md-6 col">
                                                <h6 class="pb-2">Upload Your File :</h6>
                                                <div class="col" id="chooseFile">
                                                    <div class="h-100">
                                                        <input class="form-control form-control-sm inputField h-100"
                                                            id="formFileSm" name="uploaded_file" form="form-revise"
                                                            type="file">
                                                    </div>
                                                    @error('uploaded_file')
                                                        <div class="pt-1 text-danger" style="font-size: 10px">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <h6 class="pt-2" style="font-size: 10px; color: var(--red)">* Upload
                                                        your essay with the '.docx' format</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col">
                                                <h6 class="pb-2">Work Duration (Time spent on editing essay) :</h6>
                                                <div class="input-group">
                                                    <input type="number" name="work_duration"
                                                        class="form-control py-2 px-3" aria-describedby="basic-addon1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text py-2 px-2"
                                                            id="basic-addon1">Minutes</span>
                                                    </div>
                                                </div>
                                                @error('work_duration')
                                                    <div class="pt-1 text-danger" style="font-size: 10px">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex mb-3">
                                            <div class="col">
                                                <h6 class="pb-2">Tags :</h6>
                                                <select class="select-state" name="tag[]" id="tag">
                                                    <option value=""></option>
                                                    @foreach ($list_tags as $tags)
                                                        <option value="{{ $tags->id_topic }}">{{ $tags->topic_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tag')
                                                    <div class="pt-1 text-danger" style="font-size: 10px">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex mb-2" style="overflow: auto !important">
                                            <div class="col">
                                                <h6 class="pb-2">Descriptions :</h6>
                                                <textarea name="description" class="textarea" placeholder="Descriptions"></textarea>
                                                @error('description')
                                                    <div class="pt-1 text-danger" style="font-size: 10px">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex py-3 mt-4" style="border-top: 1px solid var(--light-grey)">
                                        <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                            <button class="btn btn-download d-flex align-items-center gap-2"
                                                style="background-color: var(--blue)">
                                                <img src="/assets/upload.png" alt="">
                                                <h6>Upload Your File</h6>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                {{-- End Section : Upload Your Revision --}}
                            @endif

                            @if ($essay_status == 'completed')
                                {{-- Start Section : Alert Congratulation --}}
                                <div class="col d-flex flex-row alert-complete py-3 px-4" id="alertComplete">
                                    <div class="col d-flex align-items-center gap-2">
                                        <img src="/assets/thumbsup.png" alt="">
                                        <h6><b>Congratulations</b>, {{ $essay_editor->essay_clients->status->status_desc }}
                                        </h6>
                                    </div>
                                    <img src="/assets/exit.png" alt="" onclick="closeAlert()"
                                        style="cursor: pointer">
                                </div>
                                {{-- End Section : Alert Congratulation --}}
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>

    {{-- Modal Reject --}}
    <div class="modal fade" id="reject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                    <form action="{{ route('reject-your-essay', ['id_essay' => $essay->id_essay_clients]) }}"
                        method="POST" class="p-0">
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

@section('js')
@endsection
