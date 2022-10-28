@extends('user.editor.utama.utama')
@section('css')
    <link rel="stylesheet" href="/css/admin/essay-ongoing-detail.css">
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
                        <div class="col-md col-12 p-0 userCard profile">
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/status.png" alt="">
                                <h6>Status</h6>
                            </div>
                            <div class="col d-flex flex-column align-items-center px-3 py-md-5 py-4 gap-3 text-center justify-content-center"
                                style="color: var(--black)">
                                <img class="img-status" src="/assets/status-ongoing.png" alt="">
                                <h6>{{ $essay->status->status_title }}</h6>
                                {{-- <h6>Assigned to editor</h6> --}}
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
                            <div class="headline d-flex align-items-center gap-3">
                                <img src="/assets/assign.png" alt="">
                                <h6>Assignment</h6>
                            </div>
                            <div class="col d-flex flex-column px-3 pt-md-4 pt-4 pb-4 text-center justify-content-center"
                                style="color: var(--black)">
                                <h6 style="font-size: 14px; font-weight: 400">
                                    {{ $essay->editor->first_name . ' ' . $essay->editor->last_name }}</h6>
                            </div>
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
                                {{-- <a class="btn btn-download d-flex align-items-center gap-2" href={{ asset('uploaded_files/program/essay/editors/'.$essay->essay_editors->attached_of_editors) }}>
                <img src="/assets/download.png" alt="">
                <h6>Download</h6>
              </a> --}}
                            </div>
                        </div>

                        <div class="col-md-8 col-12 p-0 userCard">
                            <div class="headline d-flex justify-content-between">
                                <div class="col-md-6 col-8 d-flex align-items-center gap-3">
                                    <img src="/assets/student.png" alt="">
                                    <h6>Student Detail</h6>
                                </div>
                                <div class="col-md-4 col-4 d-flex align-items-center justify-content-end gap-md-3 gap-2">
                                    <a href="/admin/essay-list/ongoing"><img src="/assets/back.png" alt=""></a>
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
                                            <p>{{ $essay->client_by_id->email }}</p>
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
                                            <p>{{ $essay->client_by_id->address }}</p>
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
                            <div class="row profile-editor px-md-2 py-md-4 px-2 py-4">
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
                                        <h6 class="pb-2">Essay Prompt :</h6>
                                        <textarea name="" class="textarea" style="overflow: auto !important">{{ $essay->essay_prompt }}</textarea>
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
                                <div class="col-12 d-flex flex-lg-row flex-column mb-3">
                                    <div class="col">
                                        {{-- <div class="col mb-3">
                    <h6 class="pb-2">Assign to Editor :</h6>
                    <input type="text" class="form-control inputField py-2 px-3" disabled value="{{ $essay->editor->first_name.' '.$essay->editor->last_name }}" style="width: 97%">
                  </div> --}}
                                        <div class="row flex-md-row flex-column-reverse">
                                            {{-- <div class="col-md-5 col mb-3">
                      <h6 class="pb-2">Editor Essay :</h6>
                      <div class="col d-flex align-items-center justify-content-center pb-md-4 pt-md-2 pb-4 pt-2">
                        <img class="img-word" src="/assets/logo-word.png" alt="">
                      </div>
                      <div class="col d-flex align-items-center justify-content-center pb-md-0 pb-3">
                        <a class="btn btn-download d-flex align-items-center gap-2" href={{ asset('uploaded_files/program/essay/editors/'.$essay->essay_editors->attached_of_editors) }}>
                          <img src="/assets/download.png" alt="">
                          <h6>Download</h6>
                        </a>
                      </div>
                    </div> --}}
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
                                    {{-- <div class="col-lg-7 col">
                  <div class="col">
                    <h6 class="pb-2">Notes :</h6>
                    <textarea name="notes" class="textarea" form="form-revise" style="overflow: auto !important"></textarea>
                  </div>
                  <div class="col d-flex align-items-center justify-content-center py-3">
                    <form action="{{ route('revise-essay', ['id_essay' => $essay->id_essay_clients]) }}" method="POST" class="p-0" id="form-revise" onsubmit="swal.showLoading()">
                      @csrf
                      <button class="btn btn-download d-flex align-items-center gap-2" style="background-color: var(--red)">
                        <img src="/assets/danger.png" alt="">
                        <h6>Revise</h6>
                      </button>
                    </form>
                  </div>
                </div> --}}
                                </div>
                                {{-- <div class="col-12 d-flex justify-content-center pt-3" style="border-top: 1px solid var(--light-grey)">
                <form action="{{ route('verify-essay', ['id_essay' => $essay->id_essay_clients]) }}" method="POST" class="p-0" onsubmit="swal.showLoading()">
                  @csrf
                  <button class="btn btn-create d-flex align-items-center gap-2" style="background-color: var(--green)">
                    <img src="/assets/assign-list.png" alt="">
                    <h6>Accept</h6>
                  </button>
                </form>
              </div> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- End Content --}}
        </div>
    </div>
@endsection
