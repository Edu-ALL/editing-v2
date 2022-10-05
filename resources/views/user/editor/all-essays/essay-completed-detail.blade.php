@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/editor/essay-completed-detail.css">
@endsection

@section('content')
    <div class="container-fluid" style="padding: 0">
        <div class="row flex-nowrap main" id="main">

            {{-- Sidenav --}}
            @include('user.editor.utama.menu')

            {{-- Content --}}
            <div class="col" style="overflow: auto !important">
                <div class="row head py-4 align-items-center">
                    <div class="col-md-6 col-10 ps-md-5 ps-3">
                        <h4 class="">Editor Dashboard</h4>
                    </div>
                    <div class="col-md-6 col-2 pe-md-5 pe-3">
                        <div class="head-content d-flex flex-row align-items-center justify-content-end gap-md-4 gap-2">
                            <a class="help d-flex flex-row align-items-center gap-md-2 gap-1" href="">
                                <img class="img-fluid" src="/assets/help-grey.png" alt="">
                                <h6 class="d-none d-md-inline">Help</h6>
                            </a>
                            <a href="">
                                <h6 class="pt-1 d-none d-md-inline">Editor Name</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container main-content m-0">
                    <div class="row gap-2">
                        <div class="col-md col-12 p-0 userCard profile">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/status.png" alt="">
                                <h6>Status</h6>
                            </div>
                            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center"
                                style="color: var(--black)">
                                <img class="img-status" src="/assets/status-complete.png" alt="">
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
                                    href={{ asset('uploaded_files/program/essay/students/' . $essay->essay_clients->attached_of_clients) }}>
                                    <img src="/assets/download.png" alt="">
                                    <h6>Download</h6>
                                </a>
                            </div>
                            <div class="headline d-flex align-items-center gap-3" style="background-color: var(--yellow)">
                                <img src="/assets/file.png" alt="">
                                <h6>Download Your File</h6>
                            </div>
                            <div class="col d-flex align-items-center justify-content-center py-md-4 py-4">
                                <img class="img-word" src="/assets/logo-word.png" alt="">
                            </div>
                            <div class="col d-flex align-items-center justify-content-center pb-md-3 pb-3">
                                <a class="btn btn-download d-flex align-items-center gap-2"
                                    href={{ asset('uploaded_files/program/essay/editors/' . $essay->attached_of_editors) }}>
                                    <img src="/assets/download.png" alt="">
                                    <h6>Download</h6>
                                </a>
                            </div>
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/assign.png" alt="">
                                <h6>Assignment</h6>
                            </div>
                            <div class="col d-flex flex-column px-3 py-md-4 py-4 my-md-1 countEssay text-center justify-content-center"
                                style="color: var(--black)">
                                <h6 style="font-size: 14px; font-weight: 400">
                                    {{ $essay->editor->first_name . ' ' . $essay->editor->last_name }}</h6>
                            </div>
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
                                    {{-- <div class="tags py-2 px-3">
                  <h6 style="font-size: 14px; font-weight: 400">{{ $essay->essay_tags->tags->topic_name }}</h6>
                </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-12 p-0 userCard">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Student Detail</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/admin/essay-list/completed"><img src="/assets/back.png" alt=""></a>
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
                                            <p>{{ $essay->essay_clients->client_by_id->first_name . ' ' . $essay->essay_clients->client_by_id->last_name }}
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
                                            <p>{{ $essay->essay_clients->client_by_id->email }}</p>
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
                                            <p>{{ $essay->essay_clients->client_by_id->address }}</p>
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
                                                value="{{ $essay->essay_clients->university->university_name }}">
                                        </div>
                                        <div class="col-6">
                                            <h6 class="pb-2">Essay Title :</h6>
                                            <input type="text" class="form-control inputField py-2 px-3" disabled
                                                value="{{ $essay->essay_clients->essay_title }}">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex mb-4" style="overflow: auto !important">
                                        <div class="col">
                                            <h6 class="pb-2">Essay Prompt :</h6>
                                            <textarea name="" class="textarea" style="overflow: auto !important">{{ $essay->essay_clients->essay_prompt }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-lg-row flex-column mb-3">
                                        <div class="col-lg-6 col d-flex mb-3">
                                            <div class="col-6">
                                                <h6 class="pb-2">Essay Deadline :</h6>
                                                <input type="text" class="form-control inputField py-2 px-3" disabled
                                                    value="{{ date('D, d M Y', strtotime($essay->essay_clients->essay_deadline)) }}">
                                            </div>
                                            <div class="col-6">
                                                <h6 class="pb-2">Application Deadline :</h6>
                                                <input type="text" class="form-control inputField py-2 px-3" disabled
                                                    value="{{ date('D, d M Y', strtotime($essay->essay_clients->application_deadline)) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col d-flex mb-3">
                                            <div class="col-6">
                                                <h6 class="pb-2">Editor Upload :</h6>
                                                <input type="text" class="form-control inputField py-2 px-3" disabled
                                                    value="{{ date('D, d M Y', strtotime($essay->uploaded_at)) }}">
                                            </div>
                                            <div class="col-6">
                                                <h6 class="pb-2">Status Essay :</h6>
                                                <input type="text" class="form-control inputField py-2 px-3" disabled
                                                    value="{{ $status_essay }}">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 d-flex pt-3" style="border-top: 1px solid var(--light-grey)">
                  <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                    <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--green)">
                      <img src="/assets/letter.png" alt="">
                      <h6>Send to Student / Mentor</h6>
                    </button>
                    <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--red)">
                      <img src="/assets/danger.png" alt="">
                      <h6>Cancel, Revise</h6>
                    </button>
                  </div>
                </div> --}}
                                </form>
                            </div>
                            <div class="col d-flex flex-row alert-complete py-3 px-4" id="alertComplete">
                                <div class="col d-flex align-items-center gap-2">
                                    <img src="/assets/thumbsup.png" alt="">
                                    <h6><b>Congratulations</b>, editor essay has been completed</h6>
                                </div>
                                <img src="/assets/exit.png" alt="" onclick="closeAlert()"
                                    style="cursor: pointer">
                            </div>
                            <div class="headline d-flex justify-content-between mt-1">
                                <div class="col d-flex align-items-center gap-3">
                                    <img src="/assets/feedback.png" alt="">
                                    <h6>Feedback</h6>
                                </div>
                            </div>
                            <div class="col-12 d-flex px-3 py-3 feedback">
                                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                    <div class="col d-flex flex-column gap-2">
                                        <h6>Turn Around Time</h6>
                                        <p>How long does it take for the editors to edit and then return the essays</p>
                                    </div>
                                    <div class="col-auto d-flex align-self-center">
                                        @if ($feedback != null)
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 1 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 2 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 3 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 4 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 5 ? 'checked' : '' }}"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                    <div class="col d-flex flex-column gap-2">
                                        <h6>Specificity of feedback</h6>
                                        <p>How helpful is the feedback</p>
                                    </div>
                                    <div class="col-auto d-flex align-self-center">
                                        @if ($feedback != null)
                                            <span
                                                class="fa fa-star {{ $feedback->option2 >= 1 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option2 >= 2 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option2 >= 3 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option2 >= 4 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option2 == 5 ? 'checked' : '' }}"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                    <div class="col d-flex flex-column gap-2">
                                        <h6>Clarity of feedback</h6>
                                    </div>
                                    <div class="col-auto d-flex align-self-center">
                                        @if ($feedback != null)
                                            <span
                                                class="fa fa-star {{ $feedback->option3 >= 1 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option3 >= 2 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option3 >= 3 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option3 >= 4 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option3 == 5 ? 'checked' : '' }}"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                    <div class="col d-flex flex-column gap-2">
                                        <h6>How encouraged do you feel from the feedback</h6>
                                        <p>How the editor speaks with the client AKA customer service</p>
                                    </div>
                                    <div class="col-auto d-flex align-self-center">
                                        @if ($feedback != null)
                                            <span
                                                class="fa fa-star {{ $feedback->option4 >= 1 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option4 >= 2 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option4 >= 3 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option4 >= 4 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option4 == 5 ? 'checked' : '' }}"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                    <div class="col d-flex flex-column gap-2">
                                        <h6>Do they help you grow as a writer/did you learn anything new</h6>
                                    </div>
                                    <div class="col-auto d-flex align-self-center">
                                        @if ($feedback != null)
                                            <span
                                                class="fa fa-star {{ $feedback->option5 >= 1 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option5 >= 2 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option5 >= 3 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option5 >= 4 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option5 == 5 ? 'checked' : '' }}"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                                <div class="col d-flex flex-row align-items-center justify-content-center gap-3">
                                    <div class="col d-flex flex-column gap-2">
                                        <h6>How likely would you recommend this editor to others?</h6>
                                    </div>
                                    <div class="col-auto d-flex align-self-center">
                                        @if ($feedback != null)
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 1 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 2 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 3 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option1 >= 4 ? 'checked' : '' }}"></span>
                                            <span
                                                class="fa fa-star {{ $feedback->option1 == 5 ? 'checked' : '' }}"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex px-3 py-3 feedback" style="border-top: 1px solid var(--light-grey)">
                                <div class="col-12 d-flex mb-2" style="overflow: auto !important">
                                    <div class="col">
                                        <h6 class="pb-2">Comment :</h6>
                                        {{-- <textarea name="" class="textarea" style="overflow: auto !important"></textarea> --}}
                                        <textarea name="" class="textarea" style="overflow: auto !important">
                    @if ($feedback != null)
{{ $essay->essay_clients->feedback->add_comments ? $essay->essay_clients->feedback->add_comments : '-' }}
@endif
                  </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection
